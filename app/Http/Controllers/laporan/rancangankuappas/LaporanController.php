<?php

namespace App\Http\Controllers\laporan\rancangankuappas;
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
     * @param DashboardService $dashboard_service
     */
    public function __construct(DashboardService $dashboard_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->tahapan = Tahapan::whereNama(\App\Enum\Tahapan::RANCANGAN_KUA_PPAS)->first();
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

        return view('laporan.rancangankuappas.index', compact('village',
            'villages',
            'district',
            'districts',
            'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $district = Districts::find($request->get('district_id', null));
        $village = Villages::find($request->get('village_id', null));
        $urusan= \App\BidangUrusan::all();
        $kegiatan =Kegiatan::find($request->get('program_id',null));


        $user = User::find($request->get('user_id'), null);

        return view('laporan.rancangankuappas.preview', compact('items', 'district', 'village', 'user','kegiatan'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        $items = $items->orderBy('lokasi');
        $items = $items->get();

        $anggaran = $items->first();
        $items = $items->toJson();
        // print_r($items);

        $view_table = view('laporan.rancangankuappas._table', compact('items', 'anggaran'));
        //return view('laporan.renja._table', compact('items', 'anggaran', 'program','kegiat','sasaran','indikatorsasaran'));
        return $view_table;
    }

    public function htmltopdfview(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $user_id = $request->get('user', null);
        $program = \App\Program::all();

        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        $sasaran =\App\Sasaran::all();
        $indikatorsasaran =\App\IndikatorSasaran::all();
        $kecamatan = Districts::find($district);
        $desa = Villages::find($village);

        $where = '';

        if ($kecamatan) {
            $where .= 'Kecamatan: ' . $kecamatan->name;
        }

        if ($desa) {
            $where .= ', Desa/Kelurahan: ' . $desa->name;
        }

        if ($where){
            $items = $items->where('lokasi', 'LIKE', $where . '%');
        }

        // if ($user_id && $user_id != 0) {
        //     $user = User::find($user_id);
        //     $items = $items->where('user_id', $user_id);
        // }

        $items = $items->where('opd_pelaksana_id', 35);

        $items = $items->get();

        $anggaran = $items->first();
        $items = $items->toJson();
        $view_table = view('laporan.renja._table', compact('items', 'anggaran', 'program','kegiat','sasaran','indikatorsasaran'));

        // $pdf = PDF::loadView('laporan.renja._table', compact('items', 'anggaran', 'program','kegiat','sasaran','indikatorsasaran')->setPaper('f4', 'landscape')->setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // return $pdf->stream("laporan-renja.pdf");
    }
    public function exportExcel(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $user_id = $request->get('user', null);
        $program = \App\Program::all();

        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        $sasaran =\App\Sasaran::all();
        $indikatorsasaran =\App\IndikatorSasaran::all();
        $kecamatan = Districts::find($district);
        $desa = Villages::find($village);

        $where = '';

        if ($kecamatan) {
            $where .= 'Kecamatan: ' . $kecamatan->name;
        }

        if ($desa) {
            $where .= ', Desa/Kelurahan: ' . $desa->name;
        }

        if ($where){
            $items = $items->where('lokasi', 'LIKE', $where . '%');
        }

        if ($user_id && $user_id != 0) {
            $user = User::find($user_id);
            $items = $items->where('user_id', $user_id);
        }

        $items = $items->get();

        $anggaran = $items->first();

        $items = $items->toJson();
        //$view_table = view('laporan.renja._table', compact('items', 'anggaran', 'program','sasaran','indikatorsasaran'));

        Excel::create('New file', function($excel)  use ($items, $anggaran, $program, $sasaran, $indikatorsasaran){

            $excel->sheet('New sheet', function($sheet) use($items, $anggaran, $program, $sasaran, $indikatorsasaran) {

                $sheet->loadView('laporan.renja._table', compact('items', 'anggaran', 'program', 'sasaran', 'indikatorsasaran'));

            });

        })->download('xlsx');
    }
}
