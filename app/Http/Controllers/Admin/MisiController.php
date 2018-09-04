<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Misi;
use App\Admin\Visi;
use App\Http\Requests\Admin\StoreMisiPost;
use App\Http\Requests\Admin\UpdateMisiPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MisiController extends Controller
{
    public function index()
    {
        $items = Misi::all();

        return view('admin.misi.index', compact('search', 'items'));
    }

    public function create()
    {
        $visi = Visi::active()->pluck('nama', 'id');

        return view('admin.misi.create', compact('visi'));
    }

    public function store(StoreMisiPost $request)
    {
        $item          = New Misi();
        $item->nama    = $request->input('nama');
        $item->urutan  = $request->input('urutan');
        $item->visi_id = $request->input('visi_id');
        $item->save();

        return redirect()->route('misi.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Misi berhasil disimpan.'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Misi::findOrFail($id);
        $visi = Visi::active()->pluck('nama', 'id');

        return view('admin.misi.edit', compact('item', 'visi'));
    }

    public function update(UpdateMisiPost $request, $id)
    {
        $item          = Misi::findOrFail($id);
        $item->nama    = $request->input('nama');
        $item->urutan  = $request->input('urutan');
        $item->visi_id = $request->input('visi_id');
        $item->save();

        return redirect()->route('misi.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Misi berhasil diperbarui.'
            ]);
    }

    public function destroy($id)
    {
        Misi::find($id)->delete();

        return redirect()->route('misi.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Misi berhasil dihapus.',
            ]);
    }
}
