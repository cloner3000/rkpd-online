<?php

namespace App\Http\Controllers\desa;

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
        $this->middleware('desa', ['only' => ['create', 'update', 'destroy', 'edit', 'store']]);
        $this->middleware('kecamatan', ['only' => ['transfer', 'doTransfer']]);
        $this->musrenbang_service = $musrenbang_service;
        $this->tahapan = \App\Enum\Tahapan::DESA;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // get user
        $user = auth()->user();

        // CEK APAKAH USER BISA ENTRY pada tahapan saat ini
        $canEntry = can_entry($this->tahapan);

        // cek apakah user bisa manage tahapan saat ini
        $canManage = $user->hasRole(Roles::DESA);
        $canTransfer = $user->hasRole(Roles::KECAMATAN);

        // get data anggaran berdasarkan tahapan name dan is_kelurahan, is_kelurahan default false
        $items = Anggaran::TahapanAndIsKelurahan(\App\Enum\Tahapan::DESA);

        // jika user role desa tampilkan data yang dia buat
        if ($user->hasRole(Roles::DESA)) {
            $items = $items->AllByUser();
        }

        // jika user role kecamatan tampilkan data sesuai district id user login
        if ($user->hasRole(Roles::KECAMATAN) && $user->opd->first()) {
            $items = $items->whereDistrictId($user->opd->first()->id);
        }

        // fungsi search
        $search = $request->get('search');
        $items  = $items->search($search)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return view('desa.musrenbang.index', compact(
            'items',
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

        $districts = Districts::all();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();

        return view('desa.musrenbang.create', compact(
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

        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::DESA)->firstOrFail();

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $this->musrenbang_service->store($request, $tahapan);

        return redirect(route('musrenbang-desa.index'))->with('alert', [
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
        return view('desa.musrenbang.show', compact(
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

        //cek jika sudah d transfer return error
        if ($item->is_transfer) {
            return error_pages(400, ErrorMessages::IS_TRANSFER);
        }

        $districts = Districts::all();
        $visi = Visi::active();
        $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('desa.musrenbang.edit', compact(
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
            'lokasi_kegiatan' => 'required',
            'lokasi'          => 'required'

        ]);

        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }

        $this->musrenbang_service->update($request, $id);

        return redirect(route('musrenbang-desa.index'))->with('alert', [
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

        $musrenbang = Anggaran::findOrFail($id)->delete();
        return redirect(route('musrenbang-desa.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menghapus data.',
        ]);
    }

    public function lookupKegiatanByName(Request $request)
    {
        $kegiatan = Kegiatan::where('nama', 'like', '%' . $request->input('q') . '%')
            ->orWhere('keyword', 'like', '%' . $request->input('q') . '%')
            ->select('id', 'nama as full_name')
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
        $tahapan = Tahapan::whereNama('Musrenbang Kecamatan')->firstOrFail();

        if (!empty($tahapan)) {
            $anggaran_transfer = $this->musrenbang_service->transfer($anggaran, $tahapan->id);
            $this->musrenbang_service->transferTargetAnggaran($anggaran, $anggaran_transfer);
            $anggaran->is_transfer = true;
            $anggaran->save();
        }

        return redirect(route('musrenbang-desa.index'))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil Transfer data.',
        ]);
    }
}
