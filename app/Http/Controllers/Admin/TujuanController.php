<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Misi;
use App\Admin\Tujuan;
use App\Http\Requests\Admin\StoreTujuanPost;
use App\Http\Requests\Admin\UpdateTujuanPost;
use App\Http\Controllers\Controller;

class TujuanController extends Controller
{
    public function index()
    {
        $items = Tujuan::all();

        return view('admin.tujuan.index', compact('search', 'items'));
    }

    public function create()
    {
        $misi = Misi::pluck('nama', 'id');

        return view('admin.tujuan.create', compact('misi'));
    }

    public function store(StoreTujuanPost $request)
    {
        $item          = New Tujuan();
        $item->nama    = $request->input('nama');
        $item->misi_id = $request->input('misi_id');
        $item->save();

        return redirect()->route('tujuan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Tujuan berhasil disimpan.'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Tujuan::findOrFail($id);
        $misi = Misi::pluck('nama', 'id');

        return view('admin.tujuan.edit', compact('item', 'misi'));
    }

    public function update(UpdateTujuanPost $request, $id)
    {
        $item          = Tujuan::findOrFail($id);
        $item->nama    = $request->input('nama');
        $item->misi_id = $request->input('misi_id');
        $item->save();

        return redirect()->route('tujuan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Tujuan berhasil diperbarui.'
            ]);
    }

    public function destroy($id)
    {
        $item = Tujuan::find($id);
        $item->delete();

        return redirect()->route('tujuan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Tujuan berhasil dihapus.',
            ]);
    }
}
