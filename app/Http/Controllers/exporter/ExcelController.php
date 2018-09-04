<?php

namespace App\Http\Controllers\exporter;

use App\Anggaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function show(Request $request)
    {
        $district = $request->get('district', null);
        $village = $request->get('village', null);
        $items = new Anggaran();
        $items = $items->withLaporan()->whereTahapanId($this->tahapan->id);
        $showKecamatan = false;

        $kecamatan = Districts::find($district);
        $desa = Villages::find($village);

        $where = 'Kecamatan: ';

        if ($kecamatan) {
            $where .= $kecamatan->name;
        }

        if ($desa) {
            $where .= ', Desa/Kelurahan: ' . $desa->name;
        }

        $items = $items->where('lokasi', 'LIKE' ,$where . '%');
        $showKecamatan = true;

        if ($request->user()->hasRole(Roles::KELURAHAN)) {
            $items = $items->where('is_kelurahan', true);
        }

        if ($request->user()->hasRole(Roles::DESA)) {
            $items = $items->where('is_kelurahan', false);
        }

        $items = $items->get();

        $anggaran = $items->first();

        $items = $items->toJson();
        Excel::create('New file', function($excel) use ($anggaran, $showKecamatan, $items) {
            $excel->sheet('New sheet', function($sheet) use ($anggaran, $showKecamatan, $items) {
                $sheet->loadView('laporan.desa._table', compact('items', 'anggaran', 'showKecamatan'));
            });
        })->download('xlsx');
    }
}
