<?php

namespace App\Http\Controllers\Admin;

use App\Urusan;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DestroyBidangUrusanPost;
use App\Http\Requests\Admin\StoreBidangUrusanPost;
use App\Http\Requests\Admin\UpdateBidangUrusanPost;
use App\BidangUrusan;

class BidangUrusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = BidangUrusan::orderBy('created_at', 'DESC')->get();

        return view('admin.bidang_urusan.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $urusan = Urusan::pluck('nama', 'id');

        return view('admin.bidang_urusan.create', compact('urusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBidangUrusanPost $request)
    {
        $item           = new BidangUrusan();
        $item->kode     = $request->input('kode');
        $item->nama     = $request->input('nama');

        $item->urusan()->associate($request->input('urusan'));
        $item->save();

        return redirect()->route('bidang-urusan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Bidang Urusan berhasil disimpan.'
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
        $item   = BidangUrusan::FindOrFail($id);
        $urusan = Urusan::pluck('nama', 'id');

        return view('admin.bidang_urusan.edit', compact('item', 'urusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBidangUrusanPost $request)
    {
        $item           = BidangUrusan::find($request->route('bidang_urusan'));
        $item->kode     = $request->input('kode');
        $item->nama     = $request->input('nama');

        $item->urusan()->associate($request->input('urusan'));
        $item->save();

        return redirect()->route('bidang-urusan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Bidang Urusan berhasil diperbarui.'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyBidangUrusanPost $request)
    {
        $item = BidangUrusan::find($request->route('bidang_urusan'));
        $item->delete();

        return redirect()->route('bidang-urusan.index')
            ->with('alert', [
                'type'    => 'success',
                'alert'   => 'Berhasil !',
                'message' => 'Data Bidang Urusan berhasil dihapus.',
            ]);

    }
}
