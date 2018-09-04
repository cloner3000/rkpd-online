<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\IndikatorHasil;
use App\IndikatorKegiatan;
use App\Kegiatan;
use App\Opd;
use App\OpdKegiatan;
use App\Satuan;
use Illuminate\Http\Request;

class OpdKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items = OpdKegiatan::whereOpdId($id)->get();
        $opd   = Opd::findOrFail($id);

        return view ('admin.opd.opd_kegiatan.index', compact('items', 'id', 'opd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $kegiatans = Kegiatan::pluck('nama', 'id');
        $opd       = Opd::findOrFail($id);

        return view ('admin.opd.opd_kegiatan.create', compact('kegiatans', 'id', 'opd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $opd_id)
    {
        $this->validate($request, ['kegiatan' => 'required']);

        $item = New OpdKegiatan();
        $item->opd()->associate($opd_id);
        $item->kegiatan()->associate($request->input('kegiatan'));
        $item->save();

        return redirect(route('opd.opd-kegiatan.index', $opd_id))->with('alert', [
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
    public function edit($id, $opd_id)
    {
        $item      = OpdKegiatan::findOrFail($opd_id);
        $kegiatans = Kegiatan::pluck('nama', 'id');
        $opd       = Opd::findOrFail($id);

        return view ('admin.opd.opd_kegiatan.edit', compact('item', 'kegiatans', 'opd', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $opd_id)
    {
        $this->validate($request, ['kegiatan' => 'required']);

        $item = OpdKegiatan::findOrFail($id);

        $item->opd()->associate($opd_id);
        $item->kegiatan()->associate($request->input('kegiatan'));
        $item->save();

        return redirect(route('opd.opd-kegiatan.index', $opd_id))->with('alert', [
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
    public function destroy($opd_id, $id)
    {
        OpdKegiatan::findOrFail($id)->delete();

        return redirect(route('opd.opd-kegiatan.index', $opd_id))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menghapus data.',
        ]);
    }
}
