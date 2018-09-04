<?php

namespace App\Http\Controllers\Admin;

use App\JenisOpd;
use App\Opd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items  = Opd::orderBy('nama', 'ASC')->get();

        return view('admin.opd.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis_opd = JenisOpd::pluck('nama', 'id');

        return view('admin.opd.create', compact('jenis_opd'));
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
            'nama'      => 'required',
            'kode'      => 'required|unique:opd',
            'jenis_opd' => 'required'
        ]);

        $item            = new Opd();
        $item->kode      = $request->input('kode');
        $item->nama      = $request->input('nama');

        $item->jenisOpd()->associate($request->input('jenis_opd'));
        $item->save();

        return redirect()->route('opd.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data OPD berhasil disimpan.'
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
        $item      = Opd::FindOrFail($id);
        $jenis_opd = JenisOpd::pluck('nama', 'id');

        return view('admin.opd.edit', compact('item', 'jenis_opd'));
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
            'nama'      => 'required',
            'kode'      => 'required|unique:opd,kode,'.$request->route('opd'),
            'jenis_opd' => 'required'
        ]);

        $item            = Opd::find($request->route('opd'));
        $item->kode      = $request->input('kode');
        $item->nama      = $request->input('nama');

        $item->jenisOpd()->associate($request->input('jenis_opd'));
        $item->save();

        return redirect()->route('opd.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data OPD berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Opd::findOrFail($request->route('opd'))->delete();

        return redirect()->route('opd.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data OPD berhasil dihapus.',
            ]);

    }
}
