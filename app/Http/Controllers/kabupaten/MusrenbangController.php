<?php

namespace App\Http\Controllers\kabupaten;

use App\Admin\Visi;
use App\Anggaran;
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

class MusrenbangController extends Controller
{
    protected $musrenbang_service;
    protected $tahapan;

    public function __construct(MusrenbangService $musrenbang_service)
    {
        $this->middleware(['opd'])->only(['create', 'edit', 'delete', 'update']);
        $this->musrenbang_service = $musrenbang_service;
        $this->tahapan = \App\Enum\Tahapan::KABUPATEN;
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
        $canTransfer = can_transfer('Rancangan Akhir');
        $user = auth()->user();
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KABUPATEN)->firstOrFail();
        $items = new Anggaran();
        $items = $items->whereTahapanId($tahapan->id);

        if ($user->hasRole(Roles::KECAMATAN) || $user->hasRole(Roles::OPD)) {
            $items = $items->whereUserId($request->user()->id);
            // $canManage = true;
            $canTransfer = true;
        }

        $search = $request->get('search');
        $items  = $items->search($search)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return view('kabupaten.musrenbang.index', compact(
            'items',
            'canEntry',
            'user',
            'canTransfer',
            'canManage',
            'search'
        ));
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

        return view('kabupaten.musrenbang.create', compact(
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

        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KABUPATEN)->firstOrFail();

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $this->musrenbang_service->store($request, $tahapan);

        return redirect(route('musrenbang-kabupaten.index'))->with('alert', [
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
        return view('kabupaten.musrenbang.show', compact(
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
    public function edit($id)
    {
        if (! can_entry($this->tahapan)) {
            return error_pages(400, ErrorMessages::CLOSED_ENTRY);
        }

        $item = Anggaran::findOrFail($id);
        $districts = Districts::all();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('kabupaten.musrenbang.edit', compact(
            'item',
            'districts',
            'visi',
            'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif'));
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
            'lokasi_kegiatan' => 'required'

        ]);

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $this->musrenbang_service->update($request, $id);

        return redirect(route('musrenbang-kabupaten.index'))->with('alert', [
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
        return redirect(route('musrenbang-kabupaten.index'))->with('alert', [
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
        // -- adding code
        if (!$request->isViewTransfer) {
            if (empty($request->pilihan)) {
                $this->validate($request, [
                    'pilihan' => 'required'
                ]);
            }
            if ($request->pilihan) {
                $this->validate($request, [
                    'catatan' => 'required'
                ]);
            }
        }
        // -- 

        $anggaran = Anggaran::find($request->input('id_transfer'));
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::RANCANGAN_AKHIR)->firstOrFail();

        // -- adding code
        if (empty($request->pilihan)) {
            $this->validate($request, [
                'pilihan' => 'required'
            ]);
        }
        if ($request->pilihan) {
            $this->validate($request, [
                'catatan' => 'required'
            ]);
        }
        // -- 

        // isViewTransfer = 0 artinya tidak menggunakan view transfer tetapi menggunakan modal
        if ((!empty($tahapan) && $request->pilihan) or ($isViewTransfer == 0)) {
            $anggaran_transfer = $this->musrenbang_service->transfer($anggaran, $tahapan->id);
            $this->musrenbang_service->transferTargetAnggaran($anggaran, $anggaran_transfer);
            $anggaran->is_transfer = true;
            $anggaran->save();
        }

        return redirect(route('musrenbang-kabupaten.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => $message,
        ]);
    }
}
