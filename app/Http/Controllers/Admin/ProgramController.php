<?php

namespace App\Http\Controllers\Admin;

use App\BidangUrusan;
use App\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestroyProgramPost;
use App\Http\Requests\Admin\StoreProgramPost;
use App\Http\Requests\Admin\UpdateProgramPost;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Program::orderBy('created_at', 'DESC')->get();

        return view('admin.program.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bidang_urusan = BidangUrusan::pluck('nama', 'id');

        return view('admin.program.create', compact('bidang_urusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramPost $request)
    {
        $item           = new Program();
        $item->kode     = $request->input('kode');
        $item->nama     = $request->input('nama');

        $item->bidangUrusan()->associate($request->input('bidang_urusan'));
        $item->save();

        return redirect()->route('program.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Program berhasil disimpan.'
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
        $item          = Program::FindOrFail($id);
        $bidang_urusan = BidangUrusan::pluck('nama', 'id');

        return view('admin.program.edit', compact('item', 'bidang_urusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramPost $request)
    {
        $item           = Program::find($request->route('program'));
        $item->kode     = $request->input('kode');
        $item->nama     = $request->input('nama');

        $item->bidangUrusan()->associate($request->input('bidang_urusan'));
        $item->save();

        return redirect()->route('program.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Program berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyProgramPost $request)
    {
        Program::find($request->route('program'))->delete();

        return redirect()->route('program.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Program berhasil dihapus.',
            ]);

    }
}
