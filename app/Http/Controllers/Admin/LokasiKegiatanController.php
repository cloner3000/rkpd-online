<?php

namespace App\Http\Controllers\Admin;

use App\LokasiKegiatan;
use App\Kegiatan;
use App\location\Villages;
use App\location\Districts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokasiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = LokasiKegiatan::orderBy('created_at', 'DESC')->get();

        return view('admin.lokasi_kegiatan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kegiatan  = Kegiatan::pluck('nama', 'id');
        $village   = Villages::pluck('name', 'id');
        $district  = Districts::pluck('name', 'id');

        return view('admin.lokasi_kegiatan.create', compact('kegiatan', 'district', 'village'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required|string|max:255',
            'kegiatan' => 'required',
            'village'  => 'required',
            'district' => 'required'
        ]);

        $item        = new LokasiKegiatan();
        $item->nama  = $request->input('nama');

        $item->kegiatan()->associate($request->input('kegiatan'));
        $item->village()->associate($request->input('village'));
        $item->district()->associate($request->input('district'));
        $item->save();

        return redirect()->route('lokasi-kegiatan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Lokasi Kegiatan berhasil disimpan.'
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
        $item      = LokasiKegiatan::FindOrFail($id);
        $kegiatan  = Kegiatan::pluck('nama', 'id');
        $village   = Villages::pluck('name', 'id');
        $district  = Districts::pluck('name', 'id');

        return view('admin.lokasi_kegiatan.edit', compact('item', 'kegiatan', 'village', 'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required|string|max:255',
            'kegiatan' => 'required',
            'village'  => 'required',
            'district' => 'required'
        ]);

        $item        = LokasiKegiatan::find($request->route('lokasi_kegiatan'));
        $item->nama  = $request->input('nama');

        $item->kegiatan()->associate($request->input('kegiatan'));
        $item->village()->associate($request->input('village'));
        $item->district()->associate($request->input('district'));
        $item->save();

        return redirect()->route('lokasi-kegiatan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Lokasi Kegiatan berhasil diperbarui.'
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
        LokasiKegiatan::find($id)->delete();

        return redirect()->route('lokasi-kegiatan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Lokasi Kegiatan berhasil dihapus.',
            ]);

    }
}
