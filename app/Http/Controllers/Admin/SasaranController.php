<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Sasaran;
use App\Admin\Tujuan;
use App\Http\Requests\Admin\StoreSasaranPost;
use App\Http\Requests\Admin\UpdateSasaranPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SasaranController extends Controller
{
    public function index()
    {
        $items  = Sasaran::orderBy('nama', 'ASC')->get();

        return view('admin.sasaran.index', compact('items'));
    }

    public function create()
    {
        $tujuan = Tujuan::pluck('nama', 'id');

        return view('admin.sasaran.create', compact('tujuan'));
    }

    public function store(StoreSasaranPost $request)
    {
        $item            = New Sasaran();
        $item->nama      = $request->input('nama');
        $item->tujuan_id = $request->input('tujuan_id');
        $item->save();

        return redirect()->route('sasaran.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Sasaran berhasil disimpan.'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item   = Sasaran::findOrFail($id);
        $tujuan = Tujuan::pluck('nama', 'id');

        return view('admin.sasaran.edit', compact('item', 'tujuan'));
    }

    public function update(UpdateSasaranPost $request, $id)
    {
        $item            = Sasaran::findOrFail($id);
        $item->nama      = $request->input('nama');
        $item->tujuan_id = $request->input('tujuan_id');
        $item->save();

        return redirect()->route('sasaran.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data sasaran berhasil diperbarui.'
            ]);
    }

    public function destroy($id)
    {
        Sasaran::find($id)->delete();

        return redirect()->route('sasaran.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data sasaran berhasil dihapus.',
            ]);
    }
}
