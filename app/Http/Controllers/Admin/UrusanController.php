<?php

namespace App\Http\Controllers\Admin;

use App\Admin\Visi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestroyUrusanPost;
use App\Http\Requests\Admin\StoreUrusanPost;
use App\Http\Requests\Admin\UpdateUrusanPost;
use App\Urusan;

class UrusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Urusan::all();

        return view('admin.urusan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visi = Visi::pluck('nama', 'id');

        return view('admin.urusan.create', compact('visi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUrusanPost $request)
    {
        $item           = new Urusan();
        $item->kode     = $request->input('kode');
        $item->nama     = $request->input('nama');

        $item->visi()->associate($request->input('visi'));
        $item->save();

        return redirect()->route('urusan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Urusan berhasil disimpan.'
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
        $item = Urusan::FindOrFail($id);
        $visi = Visi::pluck('nama', 'id');

        return view('admin.urusan.edit', compact('item', 'visi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUrusanPost $request, $id)
    {
        $item           = Urusan::find($id);
        $item->kode     = $request->input('kode');
        $item->nama     = $request->input('nama');

        $item->visi()->associate($request->input('visi'));
        $item->save();

        return redirect()->route('urusan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Urusan berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyUrusanPost $request)
    {
        $item = Urusan::find($request->route('urusan'))->delete();

        return redirect()->route('urusan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Urusan berhasil dihapus.',
            ]);

    }
}
