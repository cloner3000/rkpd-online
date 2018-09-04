<?php

namespace App\Http\Controllers\kuappas;

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

class RancanganController extends Controller
{
    protected $musrenbang_service;
    protected $tahapan;

    public function __construct(MusrenbangService $musrenbang_service)
    {
        $this->middleware('bidang')->only('edit', 'update', 'destroy', 'transfer');
        $this->musrenbang_service = $musrenbang_service;
        $this->tahapan = \App\Enum\Tahapan::KUA_PPAS;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $canEntry = can_entry($this->tahapan);
        $canManage = true;
        $canTransfer = true;
        $user = auth()->user();
        $tahapan = Tahapan::whereNama($this->tahapan)->firstOrFail();
        $items = new Anggaran();
        $items = $items->whereTahapanId($tahapan->id);

        if ($user->hasRole(Roles::BPMM) || $user->hasRole(Roles::BPE) || $user->hasRole(Roles::BIPW) ||
            $user->hasRole(Roles::BES)) {
            $items = $items->whereUserId($request->user()->id);
            $canManage = true;
            $canTransfer = true;
        }

        $search = $request->get('search');
        $items  = $items->search($search)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return view('kuappas.index', compact(
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

        return view('kuappas.create', compact(
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

        return redirect(route('kuappas.index'))->with('alert', [
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
        return view('kuappas.show', compact(
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
        return view('kuappas.edit', compact(
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
            'lokasi_kegiatan' => 'required'

        ]);

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $this->musrenbang_service->update($request, $id);

        return redirect(route('kuappas.index'))->with('alert', [
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
        return redirect(route('kuappas.index'))->with('alert', [
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
        $anggaran = Anggaran::find($request->input('id_transfer'));
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KUA_PPAS)->first();

        if (!$tahapan)
        {
            return error_pages(400, 'Tahapan ' . \App\Enum\Tahapan::KUA_PPAS . ' tidak ditemukan, silahkan hubungi Administrator!');
        }

        if (!empty($tahapan)) {
            $anggaran_transfer = $this->musrenbang_service->transfer($anggaran, $tahapan->id);
            $this->musrenbang_service->transferTargetAnggaran($anggaran, $anggaran_transfer);
            $anggaran->is_transfer = true;
            $anggaran->save();
        }

        return redirect(route('kuappas.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil Transfer data.',
        ]);
    }
}
