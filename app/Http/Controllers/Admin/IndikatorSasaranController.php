<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Sasaran;
use App\Admin\IndikatorSasaran;
use App\Http\Requests\Admin\StoreIndikatorSasaranPost;
use App\Http\Requests\Admin\UpdateIndikatorSasaranPost;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;

class IndikatorSasaranController extends Controller
{
    public function index()
    {
        $items  = IndikatorSasaran::orderBy('nama', 'ASC')->get();

        return view('admin.indikator_sasaran.index', compact('items'));
    }

    public function create()
    {
        $sasaran = Sasaran::pluck('nama', 'id');

        return view('admin.indikator_sasaran.create', compact('sasaran'));
    }

    public function store(StoreIndikatorSasaranPost $request)
    {
        $item             = New IndikatorSasaran();
        $item->nama       = $request->input('nama');
        $item->sasaran_id = $request->input('sasaran_id');
        $item->save();

        return redirect()->route('indikator-sasaran.index')
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
        $item    = IndikatorSasaran::findOrFail($id);
        $sasaran = Sasaran::pluck('nama', 'id');

        return view('admin.indikator_sasaran.edit', compact('item', 'sasaran'));
    }

    public function update(UpdateIndikatorSasaranPost $request, $id)
    {
        $item             = IndikatorSasaran::findOrFail($id);
        $item->nama       = $request->input('nama');
        $item->sasaran_id = $request->input('sasaran_id');
        $item->save();

        return redirect()->route('indikator-sasaran.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data sasaran berhasil diperbarui.'
            ]);
    }

    public function destroy($id)
    {
        $item = IndikatorSasaran::find($id);
        $item->delete();

        return redirect()->route('indikator-sasaran.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data sasaran berhasil dihapus.',
            ]);
    }
}
