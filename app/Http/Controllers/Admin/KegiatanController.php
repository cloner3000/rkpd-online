<?php

namespace App\Http\Controllers\Admin;

use App\Admin\IndikatorSasaran;
use App\Kegiatan;
use App\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestroyKegiatanPost;
use App\Http\Requests\Admin\StoreKegiatanPost;
use App\Http\Requests\Admin\UpdateKegiatanPost;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items  = Kegiatan::orderBy('created_at', 'DESC')->get();

        return view('admin.kegiatan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program           = Program::pluck('nama', 'id');
        $indikator_sasaran = IndikatorSasaran::pluck('nama', 'id');

        return view('admin.kegiatan.create', compact('program', 'indikator_sasaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKegiatanPost $request)
    {
        $item            = new Kegiatan();
        $item->kode      = $request->input('kode');
        $item->nama      = $request->input('nama');
        $item->deskripsi = $request->input('deskripsi');
        $item->keyword   = $request->input('keyword');

        $item->program()->associate($request->input('program'));
        $item->indikatorSasaran()->associate($request->input('indikator_sasaran'));
        $item->save();

        return redirect()->route('kegiatan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Kegiatan berhasil disimpan.'
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
        $item   = Kegiatan::FindOrFail($id);
        $program = Program::pluck('nama', 'id');
        $indikator_sasaran = IndikatorSasaran::pluck('nama', 'id');

        return view('admin.kegiatan.edit', compact('item', 'program', 'indikator_sasaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKegiatanPost $request)
    {
        $item            = Kegiatan::find($request->route('kegiatan'));
        $item->kode     = $request->input('kode');
        $item->nama      = $request->input('nama');
        $item->deskripsi = $request->input('deskripsi');
        $item->keyword   = $request->input('keyword');

        $item->program()->associate($request->input('program'));
        $item->indikatorSasaran()->associate($request->input('indikator_sasaran'));
        $item->save();

        return redirect()->route('kegiatan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Kegiatan berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyKegiatanPost $request)
    {
        $item = Kegiatan::find($request->route('kegiatan'));
        $item->delete();

        return redirect()->route('kegiatan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Kegiatan berhasil dihapus.',
            ]);

    }
}
