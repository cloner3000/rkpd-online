<?php

namespace App\Http\Controllers\kerja;

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

use App\User;
use App\Bidang;
use App\BidangPermission;
use Illuminate\Support\Facades\DB;

class RancanganController extends Controller
{
    protected $musrenbang_service;
    protected $tahapan;
    public function __construct(MusrenbangService $musrenbang_service)
    {
        $this->musrenbang_service = $musrenbang_service;
        $this->tahapan = \App\Enum\Tahapan::RANCANGAN_RENJA;
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
        $canTransfer = can_transfer('Rancangan Renja');
        $user = auth()->user();
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::RANCANGAN_RENJA)->firstOrFail();
        $items = new Anggaran();
        $items = $items->whereTahapanId($tahapan->id);

        $opd = $user->opd()->first();

        if ($user->hasRole(Roles::KECAMATAN) || $user->hasRole(Roles::OPD)) {
            $items = $items->whereUserId($request->user()->id);
            //$items = $items->where('opd_pelaksana_id', '=', $opd->id);
            $canManage = true;
        }

        $search = $request->get('search');
        $items  = $items->search($search)
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        return view('rancangan.kerja.index', compact(
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
        return view('rancangan.kerja.create', compact(
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
        $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::RANCANGAN_RENJA)->firstOrFail();
        // cek opd
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));
        if (!$kegiatan->opd()->first()) {
            return error_pages(400, 'Kegiatan <strong> '. $kegiatan->nama .
                '</strong> Tidak memiliki OPD </br> Silahkan Hubungi Administrator!');
        }
        $this->musrenbang_service->store($request, $tahapan);
        return redirect(route('kerja.index'))->with('alert', [
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
        return view('rancangan.kerja.show', compact(
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
        return view('rancangan.kerja.edit', compact(
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
        return redirect()->back()->with('alert', [
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
        // if ($data->path_proposal) {
        //     Storage::delete($data->path_proposal);
        // }
        // $data->path_proposal = null;
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
        // $districts = Districts::all();
        // $visi = Visi::active();
        // $jenisLokasi = JenisLokasi::all();
        $sumberAnggarans = SumberAnggaran::all();
        $sumberAnggaranPuguIndikatif = SumberAnggaran::whereNama('Pagu Indikatif')->first();
        return view('rancangan.kerja.transfer', compact(
            'item',
            // 'districts',
            // 'visi',
            // 'jenisLokasi',
            'sumberAnggarans',
            'sumberAnggaranPuguIndikatif'));
    }
    public function doTransfer(Request $request, $id)
    {
        $username = auth()->user()->name;

        if (strpos($username, 'bidang') !== false) {
            $anggaran = Anggaran::find($id);
            $anggaran->is_checked = 1;
            $anggaran->save();

            return redirect(route('kerja.index'))->with('alert', [
                'type' => 'success',
                'alert' => 'Berhasil !',
                'message' => 'Berhasil Verifikasi Data.',
            ]);
        }
        else {
            $anggaran = Anggaran::find($id);
            $tahapan = Tahapan::whereNama(\App\Enum\Tahapan::KABUPATEN)->firstOrFail();
            if (!empty($tahapan)) {
                $newAnggaran = $this->musrenbang_service->transfer($anggaran, $tahapan->id);
                $anggaran->is_transfer = true;
                $anggaran->save();
                $this->musrenbang_service->storeTargetAnggaran($request, $newAnggaran);
            }
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'alert' => 'Berhasil !',
                'message' => 'Berhasil Transfer data.',
            ]);
        }
    }
}