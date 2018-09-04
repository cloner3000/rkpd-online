<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tahapan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TahapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Tahapan::orderBy('created_at', 'ASC')->get();

        return view('admin.tahapan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tahapan.create');
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
            'nama'    => 'required',
            'mulai'   => 'required',
            'selesai' => 'required'
        ]);

        $item          = new Tahapan();
        $item->nama    = $request->input('nama');
        $item->mulai   = Carbon::createFromFormat('d-m-Y H:i', $request->input('mulai'));
        $item->selesai = Carbon::createFromFormat('d-m-Y H:i', $request->input('selesai'));
        $item->save();

        return redirect()->route('tahapan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Tahapan berhasil disimpan.'
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
        $item      = Tahapan::FindOrFail($id);

        return view('admin.tahapan.edit', compact('item'));
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
            'nama'    => 'required',
            'mulai'   => 'required',
            'selesai' => 'required'
        ]);

        $item          = Tahapan::find($request->route('tahapan'));
        $item->nama    = $request->input('nama');
        $item->mulai   = Carbon::createFromFormat('d-m-Y H:i', $request->input('mulai'));
        $item->selesai = Carbon::createFromFormat('d-m-Y H:i', $request->input('selesai'));
        $item->save();

        return redirect()->route('tahapan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Tahapan berhasil diperbarui.'
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
        Tahapan::find($request->route('tahapan'))->delete();

        return redirect()->route('opd.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Tahapan berhasil dihapus.',
            ]);

    }
}
