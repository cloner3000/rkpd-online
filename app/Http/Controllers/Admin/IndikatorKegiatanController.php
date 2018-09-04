<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IndikatorHasil;
use App\IndikatorKegiatan;
use App\Kegiatan;
use App\Satuan;
use App\Services\IndikatorKegiatanService;
use Illuminate\Http\Request;

class IndikatorKegiatanController extends Controller
{
    protected $indikatorKegiatanService;


    public function __construct()
    {
        $this->indikatorKegiatanService = new IndikatorKegiatanService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items = IndikatorKegiatan::whereKegiatanId($id)->get();
        $kegiatan = Kegiatan::findOrFail($id);
        return view ('admin.kegiatan.indikator_kegiatan.index', compact('items', 'id', 'kegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $satuans        = Satuan::all();
        $indikatorHasils = IndikatorHasil::all();
        $kegiatan = Kegiatan::findOrFail($id);

        return view ('admin.kegiatan.indikator_kegiatan.create', compact(
            'satuans',
            'indikatorHasils',
            'id',
            'kegiatan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kegiatanId)
    {
        $this->validate($request, [
            'indikator_hasil'    => 'required',
            'satuan'             => 'required',
            'tolak_ukur'         => 'required',
            'kode'               => 'required',
            'asb'                => 'required|numeric'
        ]);

        $this->indikatorKegiatanService->store($request, $kegiatanId);

        return redirect(route('kegiatan.indikator-kegiatan.index', $kegiatanId))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menyimpan data.',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $indikatorKegiatan)
    {
        $item = IndikatorKegiatan::findOrFail($indikatorKegiatan);
        $satuans        = Satuan::all();
        $indikatorHasils = IndikatorHasil::all();
        $kegiatan = Kegiatan::findOrFail($id);

        return view ('admin.kegiatan.indikator_kegiatan.edit', compact('item',
            'satuans',
            'indikatorHasils',
            'id',
            'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $kegiatanId)
    {
        $item = IndikatorKegiatan::findOrFail($id);
        $this->validate($request, [
            'indikator_hasil'    => 'required',
            'satuan'             => 'required',
            'tolak_ukur'         => 'required',
            'kode'               => 'required',
            'asb'                => 'required|numeric'
        ]);

        $this->indikatorKegiatanService->update($item, $request);

        return redirect(route('kegiatan.indikator-kegiatan.index', $kegiatanId))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menyimpan data.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kegiatanId, $id)
    {
        IndikatorKegiatan::findOrFail($id)->delete();

        return redirect(route('kegiatan.indikator-kegiatan.index', $kegiatanId))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menghapus data.',
        ]);
    }
}
