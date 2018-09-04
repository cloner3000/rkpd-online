<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Visi;
use App\Http\Requests\Admin\StoreVisiPost;
use App\Http\Requests\Admin\UpdateVisiPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisiController extends Controller
{
    public function index()
    {
        $items = Visi::all();

        return view('admin.visi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.visi.create');
    }

    public function store(StoreVisiPost $request)
    {
        $item          = New Visi();
        $item->nama    = $request->input('nama');
        $item->mulai   = $request->input('mulai');
        $item->selesai = $request->input('selesai');
        $item->status  = $request->input('status') == 'on' ? true : false;
        $item->save();

        return redirect()->route('visi.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Visi berhasil disimpan.'
            ]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $item = Visi::findOrFail($id);

        return view('admin.visi.edit', compact('item'));
    }

    public function update(UpdateVisiPost $request, $id)
    {
        $item          = Visi::findOrFail($id);
        $item->nama    = $request->input('nama');
        $item->mulai   = $request->input('mulai');
        $item->selesai = $request->input('selesai');
        $item->status  = $request->input('status') == 'on' ? true : false;
        $item->save();

        return redirect()->route('visi.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Visi berhasil diperbarui.'
            ]);
    }

    public function destroy($id)
    {
        $item = Visi::find($id);
        $item->delete();

        return redirect()->route('visi.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Visi berhasil dihapus.',
            ]);
    }
}
