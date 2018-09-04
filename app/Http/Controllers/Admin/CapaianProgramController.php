<?php

namespace App\Http\Controllers\Admin;

use App\Satuan;
use App\CapaianProgram;
use App\Program;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestroyKegiatanPost;
use App\Http\Requests\Admin\StoreKegiatanPost;
use App\Http\Requests\Admin\UpdateKegiatanPost;
use Illuminate\Http\Request;

class CapaianProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CapaianProgram::orderBy('created_at', 'DESC')->get();

        return view('admin.capaian_program.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program = Program::pluck('nama', 'id');
        $satuan  = Satuan::pluck('nama', 'id');

        return view('admin.capaian_program.create', compact('program', 'satuan'));
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
            'kode'       => 'required|numeric|digits_between:1,2',
            'tolak_ukur' => 'required|string|max:255',
            'target'     => 'required|numeric',
            'program'    => 'required',
            'satuan'     => 'required'
        ]);

        $item             = new CapaianProgram();
        $item->kode       = $request->input('kode');
        $item->tolak_ukur = $request->input('tolak_ukur');
        $item->target     = $request->input('target');

        $item->program()->associate($request->input('program'));
        $item->satuan()->associate($request->input('satuan'));
        $item->save();

        return redirect()->route('capaian-program.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Capaian Program berhasil disimpan.'
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
        $item    = CapaianProgram::FindOrFail($id);
        $program = Program::pluck('nama', 'id');
        $satuan  = Satuan::pluck('nama', 'id');

        return view('admin.capaian_program.edit', compact('item', 'program', 'satuan'));
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
            'kode'       => 'required|numeric|digits_between:1,2',
            'tolak_ukur' => 'required|string|max:255',
            'target'     => 'required|numeric',
            'program'    => 'required',
            'satuan'     => 'required'
        ]);

        $item             = CapaianProgram::find($request->route('capaian_program'));
        $item->kode       = $request->input('kode');
        $item->tolak_ukur = $request->input('tolak_ukur');
        $item->target     = $request->input('target');

        $item->program()->associate($request->input('program'));
        $item->satuan()->associate($request->input('satuan'));
        $item->save();

        return redirect()->route('capaian-program.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Capaian Program berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = CapaianProgram::find($id);
        $item->delete();

        return redirect()->route('capaian-program.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Capaian Program berhasil dihapus.',
            ]);

    }
}
