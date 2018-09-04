<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Opd;
use App\Tahapan;
use App\TahapanOpd;
use Illuminate\Http\Request;

class TahapanOpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $items   = TahapanOpd::whereTahapanId($id)->get();
        $tahapan = Tahapan::findOrFail($id);

        return view ('admin.tahapan.tahapan_opd.index', compact('items', 'id', 'tahapan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $tahapan = Tahapan::findOrFail($id);
        $opd     = Opd::WhereJenisOpd('OPD')->pluck('nama', 'id');

        return view ('admin.tahapan.tahapan_opd.create', compact('tahapan', 'id', 'opd'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tahapan_id)
    {
        $this->validate($request, ['opd' => 'required']);

        $item = New TahapanOpd();
        $item->tahapan()->associate($tahapan_id);
        $item->opd()->associate($request->input('opd'));
        $item->save();

        return redirect(route('tahapan.opd.index', $tahapan_id))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menyimpan data.',
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
    public function edit($id, $tahapan_id)
    {
        $item    = TahapanOpd::findOrFail($tahapan_id);
        $tahapan = Tahapan::findOrFail($id);
        $opd     = Opd::WhereJenisOpd('OPD')->pluck('nama', 'id');

        return view ('admin.tahapan.tahapan_opd.edit', compact('item', 'tahapan', 'opd', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $tahapan_id)
    {
        $this->validate($request, ['opd' => 'required']);

        $item = TahapanOpd::findOrFail($id);
        $item->tahapan()->associate($tahapan_id);
        $item->opd()->associate($request->input('opd'));
        $item->save();

        return redirect(route('tahapan.opd.index', $tahapan_id))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menyimpan data.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($opd_id, $id)
    {
        TahapanOpd::findOrFail($id)->delete();

        return redirect(route('tahapan.opd.index', $opd_id))->with('alert', [
            'type' => 'success',
            'alert' => 'Berhasil !',
            'message' => 'Berhasil menghapus data.',
        ]);
    }
}
