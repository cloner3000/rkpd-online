<?php

namespace App\Http\Controllers\laporan\akhir;

use App\Anggaran;
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
        $this->tahapan = Tahapan::whereNama(\App\Enum\Tahapan::RANCANGAN_AKHIR)->first();
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

        return view('laporan.akhir.index', compact('village',
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
        $user = User::find($request->get('user_id'), null);

        return view('laporan.akhir.preview', compact('items', 'district', 'village', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $user_id = $request->get('user', null);

        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);

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
//            $user = User::find($user_id);
            $items = $items->whereUserId($user_id);
        }

        $items = $items->get();

        $anggaran = $items->first();

        $items = $items->toJson();
        return view('laporan.akhir._table', compact('items', 'anggaran'));
    }

    public function exportExcel(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $user_id = $request->get('user', null);

        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);

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
            $opd = $user->opd()->first();
            if ($opd) {
                $items = $items->whereHas('opd', function ($q) use ($opd) {
                    $q->where('opd.id', $opd->id);
                });
            }
        }

        $items = $items->get();

        $anggaran = $items->first();

        $writer = WriterFactory::create(Type::XLSX); // for XLSX files

        $writer->openToBrowser('Laporan Rancangan Akhir.xlsx'); // stream data directly to the browser

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
