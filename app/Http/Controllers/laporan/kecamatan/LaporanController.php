<?php

namespace App\Http\Controllers\laporan\kecamatan;

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
        $this->tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KECAMATAN)->first();
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
            $q->whereRoleId(Role::findByName(Roles::KECAMATAN)->id);
        })->pluck('nama_lengkap', 'id');

        return view ('laporan.kecamatan.index', compact('village', 'villages', 'district', 'districts', 'users'));
    }

    public function preview(Request $request)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit','2048M');
        $district = Districts::find($request->get('district_id', null));
        $village = Villages::find($request->get('village_id', null));

        return view ('laporan.kecamatan.preview', compact('district', 'village'));
    }

    public function show(Request $request)
    {   
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $user_id = $request->get('user', null);
        // $program = \App\Program::all();

        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        // $sasaran =\App\Sasaran::all();
        // $indikatorsasaran =\App\IndikatorSasaran::all();
        $kecamatan = Districts::find($district);
        $desa = Villages::find($village);
        $opd = $request->user()->opd()->first();
        $showKecamatan = true;

        $where = '';

        // if ($kecamatan) {
        //     $where .= 'Kecamatan: ' . $kecamatan->name;
        // }

        // if ($desa) {
        //     $where .= ', Desa/Kelurahan: ' . $desa->name;
        // }

        // if ($where){
        //     $items = $items->where('lokasi', 'LIKE', $where . '%');
        // }
        
        if ($request->user()->hasRole(Roles::KECAMATAN)) {
            $query = '%Kecamatan: '.strtoupper($request->user()->name).',%';
            $items = $items->where('lokasi', 'like' , $query);
            // $items = $items->where('sumber_anggaran_id', '=', '2');
            $items = $items->orderBy('village_id', 'ASC');
            $items = $items->orderBy('opd_pelaksana_id', 'ASC');
            $status_kec = true;
        }
        
        if ($request->user()->hasRole(Roles::OPD)) {
            $items = $items->where('opd_pelaksana_id', '=' , $opd->id);
            $items = $items->where('is_verifikasi', '=', '1');
            $items = $items->orderBy('user_id', 'DESC');
            $status_kec = false;
        }

        // if ($user_id && $user_id != 0){
        //     $user = User::find($user_id);
        //     $items = $items->where('user_id', $user_id);
        //     // $counter=0;
        // }
        
        $items = $items->where('is_verifikasi', '=', '1');
        //$items = $items->where('created_at', '>', '2019-02-26');
        $items = $items->get();

        $anggaran = $items->first();

        $time=6000;
        ini_set('max_execution_time', $time);
        
        $items = $items->toJson();
        return view('laporan.kecamatan._table', compact('items', 'anggaran', 'showKecamatan', 'status_kec', 'opd', 'kecamatan'));
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
            'Desa',
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

            ];

            $writer->addRowWithStyle($row, $styleRow);
        }
        $writer->close();
    }
}
