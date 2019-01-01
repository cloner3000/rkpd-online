<?php

namespace App\Http\Controllers\laporan\dewan;


use App\BidangUrusan;
use App\Anggaran;
use App\Kegiatan;
use App\Sasaran;
use App\Program;
use App\IndikatorSasaran;
use App\Enum\Roles;
use App\location\Districts;
use App\location\Villages;
use App\Services\DashboardService;
use App\Tahapan;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

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
        $this->tahapan = Tahapan::whereNama(\App\Enum\Tahapan::POKOK_PIKIRAN_DEWAN)->first();
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


        $districts = Districts::pluck('name', 'id');

        $users = User::whereHas('roles', function ($q) {
            $q->whereRoleId(Role::findByName(Roles::OPD)->id);
        })->pluck('nama_lengkap', 'id');

        // $users = User::whereHas('roles', function ($q) {
        //     $q->whereRoleId(Role::findByName(Roles::DPRD)->id);
        // })->pluck('nama_lengkap', 'id');

        return view('laporan.dewan.index', compact('village',
            'villages',
            'district',
            'districts',
            'users'));
    }

    public function preview(Request $request)
    {
        $district = Districts::find($request->get('district_id', null));
        $village = Villages::find($request->get('village_id', null));
        $user = User::find($request->get('user_id'), null);

        return view('laporan.dewan.preview', compact('items', 'district', 'village', 'user'));
    }

    public function show(Request $request)
    {
        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        $user_id = $request->user()->id;

        if ($request->user()->hasRole(Roles::DPRD)) {
            $items= $items->where('user_id', $user_id);
            $items = $items->orderBy('district_id', 'ASC');            
        }
        $nama = $request->user()->nama_lengkap;

        $items = $items->get();

        $anggaran = $items->first();

        $items = $items->toJson();

       // print_r($items);
        return view('laporan.dewan._table', compact('items', 'anggaran', 'nama'));
    }

    public function exportExcel(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $user = $request->get('user', null);

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

        if ($user && $user != 0) {
            $items = $items->whereUserId($user);
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
            'Desa',
            'Anggota Dewan'
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
                get_desa_from_location($anggaran->lokasi),
                $anggaran->user->nama_lengkap

            ];

            $writer->addRowWithStyle($row, $styleRow);
        }
        $writer->close();
    }
}
