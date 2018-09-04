<?php

namespace App\Http\Controllers\rancangankuappas;

use App\Admin\Visi;
use App\Anggaran;
use App\User;
use App\Enum\ErrorMessages;
use App\Enum\Roles;
use App\JenisLokasi;
use App\Kegiatan;
use App\location\Districts;
use App\Services\MusrenbangService;
use App\SumberAnggaran;
use App\Tahapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Bidang;
use App\BidangPermission;
use Illuminate\Support\Facades\DB;

class RancanganController extends Controller
{
    protected $musrenbang_service;
    protected $tahapan;

    public function __construct(MusrenbangService $musrenbang_service)
    {
        // $this->middleware('bidang')->only('edit', 'update', 'destroy', 'transfer');
        $this->musrenbang_service = $musrenbang_service;
        $this->tahapan = \App\Enum\Tahapan::RANCANGAN_KUA_PPAS;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $canEntry = can_entry($this->tahapan);
        $canManage = false;
        $canTransfer = can_transfer('KUA PPAS');
        $user = auth()->user();
        $tahapan = Tahapan::whereNama($this->tahapan)->firstOrFail();

        $bidang_nama = $user->roles->pluck('name'); //bidang

        if ($bidang_nama[0] == "Administrator") {
            $tahapan = Tahapan::whereNama($this->tahapan)->firstOrFail();
            $items = new Anggaran();
            $items = $items->whereTahapanId($tahapan->id);

            $search = $request->get('search');
            $items  = $items->search($search)
                ->orderBy('created_at', 'ASC')
                ->paginate(10);

            return view('rancangan.kuappas.index', compact(
                'items',
                'canEntry',
                'user',
                'canTransfer',
                'canManage',
                'search',

                'bidang_nama'
            ));
        }

        else {
            $user_id = $user->id;
            $nama_lengkap = User::whereId($user_id)->pluck('nama_lengkap');
            $nama_lengkap_up = strtoupper($nama_lengkap[0]);
            $bidang_id   = Bidang::where('nama', 'like', $nama_lengkap_up)->pluck('id');
            $tahapan = Tahapan::whereNama($this->tahapan)->firstOrFail();
            $bidang_permission = BidangPermission::where('bidang_id', $bidang_id)->get();

            $canManage = true;
            $canTransfer = true;
            $search_keyword = $request->search;

            $opd_bidang = DB::table('bidang_permissions')
                                ->join('opd', 'bidang_permissions.opd_id', 'opd.id')
                                ->where('bidang_permissions.bidang_id', $bidang_id)
                                ->orderBy('opd.nama')
                                ->select('opd.id', 'opd.nama')
                                ->get();

            $dropdown1 = $request->selected_opd;
            $dropdown2 = $request->selected_program;
            $old_dropdown1 = $request->old_dropdown1;

            if ($dropdown1) {
                $program = DB::table('program')
                                ->join('kegiatan', 'program.id', '=', 'kegiatan.program_id')
                                ->join('anggaran', 'kegiatan.id', '=', 'anggaran.kegiatan_id')
                                ->where('anggaran.tahapan_id', 9)
                                ->where('anggaran.opd_pelaksana_id', $dropdown1)
                                ->select('program.id', 'program.nama')
                                ->orderBy('program.nama')
                                ->distinct()
                                ->get();

                if ($dropdown1 == $old_dropdown1) {
                    if ($dropdown2) {
                        if ($search_keyword) {
                            $items = DB::table('anggaran')
                                ->join('bidang_permissions', 'anggaran.opd_id', '=', 'bidang_permissions.opd_id')
                                ->join('kegiatan', 'anggaran.kegiatan_id', '=', 'kegiatan.id')
                                ->join('tahapan', 'anggaran.tahapan_id', '=', 'tahapan.id')
                                ->join('program', 'kegiatan.program_id', 'program.id')
                                ->where('bidang_permissions.bidang_id', $bidang_id)
                                ->where('anggaran.tahapan_id', $tahapan->id)
                                ->where('program.id', $dropdown2)
                                ->select('anggaran.id', 'anggaran.is_transfer', 'anggaran.lokasi', 'anggaran.created_at', 'bidang_permissions.*', 'kegiatan.nama')
                                ->where(function($query) use ($search_keyword){
                                    $query->where('kegiatan.nama', 'like', '%'.$search_keyword.'%')
                                                    ->orWhere('anggaran.lokasi', 'like', '%'.$search_keyword.'%');
                                })
                                ->orderBy('anggaran.created_at', 'ASC')
                                ->paginate(10);

                                $items->appends($request->only('search'));
                        }
                        else {
                            $items = DB::table('anggaran')
                                    ->join('bidang_permissions', 'anggaran.opd_id', 'bidang_permissions.opd_id')
                                    ->join('kegiatan', 'anggaran.kegiatan_id', 'kegiatan.id')
                                    ->join('tahapan', 'anggaran.tahapan_id', 'tahapan.id')
                                    ->join('program', 'kegiatan.program_id', 'program.id')
                                    ->where('bidang_permissions.bidang_id', $bidang_id)
                                    ->where('anggaran.tahapan_id', $tahapan->id)
                                    ->where('program.id', $dropdown2)
                                    ->select('anggaran.id', 'anggaran.is_transfer', 'anggaran.lokasi', 'anggaran.created_at', 'bidang_permissions.*', 'kegiatan.nama')
                                    ->orderBy('anggaran.created_at', 'ASC')
                                    ->paginate(10);
                        }
                    }
                }
            }

            return view('rancangan.kuappas.index', compact(
                'items',
                'canEntry',
                'user',
                'canTransfer',
                'canManage',
                'search',

                'bidang_nama',
                'opd_bidang',
                'program',
                'dropdown1',
                'dropdown2',
                'old_dropdown1'
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! can_entry($this->tahapan)) {
            return error_pages(400, ErrorMessages::CLOSED_ENTRY);
        }

        $districts = Districts::all();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();

        return view('rancangan.akhir.create', compact(
            'districts',
            'visi',
            'opds',
            'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! can_entry($this->tahapan)) {
            return error_pages(400, ErrorMessages::CLOSED_ENTRY);
        }

        $this->validate($request, [
            'tahun' => 'required',
            'sumber_anggaran' => 'required',
            'nama_kegiatan' => 'required|max:255',
            'lokasi_kegiatan' => 'required',
            'lokasi' => 'required'

        ]);

        $tahapan = Tahapan::whereNama($this->tahapan)->firstOrFail();

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $this->musrenbang_service->store($request, $tahapan);

        return redirect(route('akhir.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menyimpan data.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Anggaran::findOrFail($id);
        $districts = Districts::all();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('rancangan.kuappas.show', compact(
            'item',
            'districts',
            'visi',
            'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if (! can_entry($this->tahapan)) {
            return error_pages(400, ErrorMessages::CLOSED_ENTRY);
        }

        $item = Anggaran::findOrFail($id);
        $districts = Districts::all();
        $district  = get_district($request->user()->opd()->first()->kode ?? null);
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('rancangan.kuappas.edit', compact(
            'item',
            'districts',
            'visi',
            'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif',
            'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! can_entry($this->tahapan)) {
            return error_pages(400, ErrorMessages::CLOSED_ENTRY);
        }

        $this->validate($request, [
            'tahun' => 'required',
            'nama_kegiatan' => 'required|max:255',
            'lokasi_kegiatan' => 'required',
            'prioritas' => 'required'
        ]);

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $anggaran = Anggaran::find($id);
        $anggaran->prioritas = $request->prioritas;
        $anggaran->update();

        $this->musrenbang_service->update($request, $id);

        return redirect(route('rancangan-kuappas.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menyimpan data.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! can_entry($this->tahapan)) {
            return error_pages(400, ErrorMessages::CLOSED_ENTRY);
        }

        $musrenbang = Anggaran::findOrFail($id);
        $this->musrenbang_service->updateTransferStatus($musrenbang);
        $musrenbang->delete();
        return redirect(route('rancangan-kuappas.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menghapus data.',
        ]);
    }

    public function lookupKegiatanByName(Request $request)
    {
        $userOpds = auth()->user()->opd->pluck('id');
        $kegiatan = Kegiatan::where('kegiatan.nama', 'like', '%' . $request->input('q') . '%')
            ->orWhere('kegiatan.keyword', 'like', '%' . $request->input('q') . '%')
            ->select('kegiatan.id', 'kegiatan.nama as full_name')
            ->join('opd_kegiatan', 'opd_kegiatan.kegiatan_id', '=', 'kegiatan.id')
            ->join('opd', 'opd.id', '=', 'opd_kegiatan.opd_id')
            ->whereIn('opd.id', $userOpds)
            ->get();

        $result = [
            'total_count' => count($kegiatan),
            'items' => $kegiatan
        ];

        return response()->json($result);
    }

    public function fetchKegiatanData(Request $request)
    {
        $kegiatan = Kegiatan::where('id', '=', $request->input('keyword'))->withAll()->first();
        return response()->json($kegiatan);
    }

    public function transfer(Request $request)
    {
        $anggaran = Anggaran::find($request->id);
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KUA_PPAS)->first();

        if (!$tahapan)
        {
            return error_pages(400, 'Tahapan ' . \App\Enum\Tahapan::KUA_PPAS . ' tidak ditemukan, silahkan hubungi Administrator!');
        }

        if (!empty($tahapan)) {
            $anggaran_transfer = $this->musrenbang_service->transfer($anggaran, $tahapan->id);
            $this->musrenbang_service->transferTargetAnggaran($anggaran, $anggaran_transfer);
            $anggaran->pagu = $request->pagu_usulan;
            $anggaran->is_transfer = true;
            $anggaran->save();
        }

        return redirect(route('rancangan-kuappas.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil Transfer data.',
        ]);
    }

    public function transferView($id)
    {
        $item = Anggaran::findOrFail($id);
        // $districts = Districts::all();
        // $visi = Visi::active();
        // $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('rancangan.kuappas.transfer', compact(
            'item',
            // 'districts',
            // 'visi',
            // 'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif'));
    }
}
