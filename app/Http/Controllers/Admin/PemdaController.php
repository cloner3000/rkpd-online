<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Pemda;
use App\Admin\Visi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePemdaPost;
use App\Http\Requests\Admin\UpdatePemdaPost;
use App\Services\ImageService;

class PemdaController extends Controller
{
    protected $image_service;

    public function __construct(ImageService $image_service)
    {
        $this->image_service = $image_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Pemda::all();

        return view('admin.pemda.index', compact( 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visi = Visi::pluck('nama', 'id');

        return view('admin.pemda.create', compact('visi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePemdaPost $request)
    {
        $item                        = New Pemda();
        $item->tahun                 = $request->input('tahun');
        $item->nama                  = $request->input('nama');
        $item->ibu_kota              = $request->input('ibu_kota');
        $item->alamat                = $request->input('alamat');
        $item->nama_kepala_daerah    = $request->input('nama_kepala_daerah');
        $item->jabatan_kepala_daerah = $request->input('jabatan_kepala_daerah');
        $item->nama_sekda            = $request->input('nama_sekda');
        $item->nip_sekda             = $request->input('nip_sekda');
        $item->jabatan_sekda         = $request->input('jabatan_sekda');

        if ($request->file('logo')) {
            $this->image_service->imageUpload($request->file('logo'), $item, 'logo');
        }

        $item->visi()->associate($request->input('visi_id'));
        $item->save();

        return redirect()->route('pemda.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Pemda berhasil disimpan.'
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
    public function edit($id)
    {
        $item = Pemda::findOrFail($id);
        $visi = Visi::pluck('nama', 'id');

        return view('admin.pemda.edit', compact('item', 'visi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePemdaPost $request, $id)
    {
        $item                        = Pemda::findOrFail($id);
        $item->tahun                 = $request->input('tahun');
        $item->nama                  = $request->input('nama');
        $item->ibu_kota              = $request->input('ibu_kota');
        $item->alamat                = $request->input('alamat');
        $item->nama_kepala_daerah    = $request->input('nama_kepala_daerah');
        $item->jabatan_kepala_daerah = $request->input('jabatan_kepala_daerah');
        $item->nama_sekda            = $request->input('nama_sekda');
        $item->nip_sekda             = $request->input('nip_sekda');
        $item->jabatan_sekda         = $request->input('jabatan_sekda');

        if ($request->file('logo')) {
            $this->image_service->imageUpload($request->file('logo'), $item, 'logo');
        }

        $item->visi()->associate($request->input('visi_id'));
        $item->save();

        return redirect()->route('pemda.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Pemda berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pemda::find($id)->delete();

        return redirect()->route('pemda.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Pemda berhasil dihapus.',
            ]);
    }
}
