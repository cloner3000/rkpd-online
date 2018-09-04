<?php

namespace App\Http\Controllers\laporan\desa;

use App\Anggaran;
use App\Enum\Roles;
use App\location\Districts;
use App\location\Villages;
use App\Services\DashboardService;
use App\Tahapan;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

class LaporanController extends Controller
{

    private $dashboard_service;
    private $tahapan;

    /**
     * LaporanController constructor.
     */
    public function __construct(DashboardService $dashboard_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->tahapan = Tahapan::whereNama(\App\Enum\Tahapan::DESA)->first();
    }

    public function index(Request $request)
    {
        $opd = $request->user()->opd()->first();
        $village = get_village($request->user()->opd->first()->kode ?? null);
        $villages = Villages::pluck('name', 'id');
        if ($request->user()->hasRole(Roles::KECAMATAN)) {
            if ($opd->jenisOpd && $opd->jenisOpd->nama == Roles::KECAMATAN) {
                $district = Districts::find($opd->kode);
                $villages = Villages::whereDistrictId($opd->kode)->pluck('name', 'id');
            }
        }

        if ($request->user()->hasRole(Roles::ADMIN)) {
            $districts = Districts::pluck('name', 'id');
        }

        return view('laporan.desa.index', compact('village', 'villages', 'district', 'districts'));
    }

    public function preview(Request $request)
    {
        $district = Districts::find($request->get('district_id', null));
        $village = Villages::find($request->get('village_id', null));

        return view('laporan.desa.preview', compact('items', 'district', 'village'));
    }

    public function show(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        $showKecamatan = false;

        $kecamatan = Districts::find($district);
        $desa = Villages::find($village);

        $where = 'Kecamatan: ';

        if ($kecamatan) {
            $where .= $kecamatan->name;
        }

        if ($desa) {
            $where .= ', Desa/Kelurahan: ' . $desa->name;
        }

        $items = $items->where('lokasi', 'LIKE', $where . '%');
        $showKecamatan = true;

        if ($request->user()->hasRole(Roles::KELURAHAN)) {
            $items = $items->where('is_kelurahan', true);
        }

        if ($request->user()->hasRole(Roles::DESA)) {
            $items = $items->where('is_kelurahan', false);
        }

        $items = $items->get();

        $anggaran = $items->first();

        $items = $items->toJson();

        return view('laporan.desa._table', compact('items', 'anggaran', 'showKecamatan'));
    }

    public function exportExcel(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);

        $kecamatan = Districts::find($district);
        $desa = Villages::find($village);

        $where = 'Kecamatan: ';

        if ($kecamatan) {
            $where .= $kecamatan->name;
        }

        if ($desa) {
            $where .= ', Desa/Kelurahan: ' . $desa->name;
        }

        $items = $items->where('lokasi', 'LIKE', $where . '%');
        $showKecamatan = true;

        if ($request->user()->hasRole(Roles::KELURAHAN)) {
            $items = $items->where('is_kelurahan', true);
        }

        if ($request->user()->hasRole(Roles::DESA)) {
            $items = $items->where('is_kelurahan', false);
        }

        $items = $items->get();

        $anggaran = $items->first();

        $writer = WriterFactory::create(Type::XLSX); // for XLSX files

        $writer->openToBrowser('Laporan.xlsx'); // stream data directly to the browser

        $style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(12)
            ->setBackgroundColor(Color::YELLOW)
            ->build();

        $styleRow = (new StyleBuilder())
            ->setFontSize(11)
            ->build();

        $header = [
            'No',
            'Kegiatan',
            'Indikator Keluaran Kegiatan',
            'Sumber Anggaran',
            'Lokasi',
            'SKPD Pelaksana',
            'Kecamatan',
            'Desa'
        ];

        $writer->addRowWithStyle($header, $style);

        foreach ($items as $idx => $anggaran) {

            $indikator = '';

            foreach ($anggaran->targetAnggaran as $target) {
                if ($target->indikatorKegiatan->indikator_hasil_id == 2){
                    $indikator .= $target->indikatorKegiatan->tolak_ukur . ' Target: ' . $target->target . ' ' . $target->indikatorKegiatan->satuan->nama . '; ';
                }
            }


            $row = [
                ++$idx,
                $anggaran->kegiatan->nama,
                $indikator,
                $anggaran->sumberAnggaran->nama,
                $anggaran->lokasi,
                $anggaran->opdPelaksana->nama,
                get_kecamatan_from_location($anggaran->lokasi),
                get_desa_from_location($anggaran->lokasi)

            ];

            $writer->addRowWithStyle($row, $styleRow);
        }
        $writer->close();
    }
}
