<?php

namespace App\Http\Controllers\kecamatan;

use App\Admin\Visi;
use App\Anggaran;
use App\Enum\ErrorMessages;
use App\Enum\Roles;
use App\JenisLokasi;
use App\Kegiatan;
use App\location\Districts;
use App\location\Villages;
use App\Services\MusrenbangService;
use App\SumberAnggaran;
use App\Tahapan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use File;
use Storage;

class MusrenbangController extends Controller
{
    protected $musrenbang_service;
    protected $tahapan;

    public function __construct(MusrenbangService $musrenbang_service)
    {
        $this->middleware('kecamatan', ['only' => ['create', 'update', 'destroy', 'edit', 'store']]);
        $this->middleware('opd', ['only' => ['transfer', 'doTransfer']]);
        $this->musrenbang_service = $musrenbang_service;
        $this->tahapan = \App\Enum\Tahapan::KECAMATAN;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $canEntry = can_entry($this->tahapan);
        $user = auth()->user();
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KECAMATAN)->firstOrFail();
        $canManage = false;
        $canTransfer = false;

        $items = new Anggaran();
        if ($user->hasRole(Roles::KECAMATAN)) {
            $canManage = true;
            $items = $items->allByUser();
        }

        if ($user->hasRole(Roles::OPD)) {
            $canTransfer = true;
            $items = $items->whereOpdId($user->opd()->first()->id);
        }

        // fungsi search
        $search = $request->get('search');
        $items = $items->whereTahapanId($tahapan->id)
            ->search($search)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return view('kecamatan.musrenbang.index',
            compact('items',
                'canEntry',
                'canManage',
                'canTransfer',
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

        $user = auth()->user();
        $opd = $user->opd()->first();

        if (!$opd) {
            return error_pages(400, 'Akun anda tidak memiliki OPD! </br> Silahkan Hubungi Administrator');
        }

        $district = Districts::find($opd->kode);

        if (! $district) {
            return error_pages(400, 'Anda Tidak terdaftar di OPD KECAMATAN!');
        }

        $villages = Villages::whereDistrictId($opd->kode)->get();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();


        return view('kecamatan.musrenbang.create', compact(
            'district',
            'villages',
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

        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KECAMATAN)->firstOrFail();

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $path_proposal = null;
        if ($request->file('proposal')) {
            $file_proposal = $request->file('proposal');
            $ext = $file_proposal->extension();
            $path_proposal = "proposal".'/'.rand()." - ".$request->file('proposal')->getClientOriginalName().'.'.$ext;
            // echo $path_proposal;
            $upload_proposal = Storage::put($path_proposal, file_get_contents($file_proposal->getRealPath()));
        }

        $this->musrenbang_service->store($request, $tahapan);

        return redirect(route('musrenbang-kecamatan.index'))->with('alert', [
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
        return view('kecamatan.musrenbang.show', compact(
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

        $user = auth()->user();
        $item = Anggaran::findOrFail($id);
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        $opd = $user->opd()->first();

        if (!$opd) {
            return error_pages(400, 'Akun anda tidak memiliki OPD! </br> Silahkan Hubungi Administrator');
        }

        $district = Districts::find($opd->kode);

        if (! $district) {
            return error_pages(400, 'Anda Tidak terdaftar di OPD KECAMATAN!');
        }

        $villages = Villages::whereDistrictId($opd->kode)->get();

        $visi = Visi::active();
        return view('kecamatan.musrenbang.edit', compact(
            'villages',
            'item',
            'district',
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

        return redirect(route('musrenbang-kecamatan.index'))->with('alert', [
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

        // coding tambahan utk menghapus catatan
        $data = Anggaran::find($id);
        $data->catatan = null;
        if ($data->proposal) {
            Storage::delete($data->proposal);
        }
        $data->proposal = null;
        $data->save();
        // end

        $musrenbang = Anggaran::findOrFail($id);
        $this->musrenbang_service->updateTransferStatus($musrenbang);
        $musrenbang->delete();

        return redirect()->back()->with('alert', [
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

    public function transfer($id)
    {
        $item = Anggaran::findOrFail($id);
        $districts = Districts::all();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('kecamatan.musrenbang.transfer', compact(
            'item',
            'districts',
            'visi',
            'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif'));
    }

    public function doTransfer(Request $request, $id)
    {
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
        else {
            $this->validate($request, [
                'catatan' => 'required'
            ]);
        }

        $path_proposal = null;
        $anggaran = Anggaran::find($id);
        if ($request->hasFile('proposal')) {
            $file_proposal = $request->file('proposal');
            $path_proposal = "proposal".'/'.$request->id." - ".$anggaran->kegiatan->nama.'.'.'pdf';
            // echo $path_proposal;
            $upload_proposal = Storage::put($path_proposal, file_get_contents($file_proposal->getRealPath()));
        }
        
        if ($request->pilihan) {
            $anggaran->is_verifikasi = 1;
            $message = 'Berhasil Transfer data.';
        }
        else {
            $anggaran->is_verifikasi = 2;
            $message = 'Data telah ditolak.';
        }
        
        $anggaran->catatan = $request->catatan;
        $anggaran->proposal = $path_proposal;
        $anggaran->save();

        $anggaran = Anggaran::find($id);
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::RANCANGAN_RENJA)->firstOrFail();
        if (!empty($tahapan) && $request->pilihan) {
            $newAnggaran = $this->musrenbang_service->transfer($anggaran, $tahapan->id);
            $anggaran->is_transfer = true;
            $anggaran->save();

            $this->musrenbang_service->storeTargetAnggaran($request, $newAnggaran);
        }

        return redirect(route('musrenbang-kecamatan.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => $message,
        ]);
    }
}
