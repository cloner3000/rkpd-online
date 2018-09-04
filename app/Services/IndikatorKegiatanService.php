<?php

namespace App\Services;

use App\IndikatorKegiatan;
use App\Kegiatan;

class IndikatorKegiatanService
{
    public function store($request, $id)
    {
        $kegiatan          = Kegiatan::find($id);
        $indikatorKegiatan = new IndikatorKegiatan();
        $indikatorKegiatan->Kegiatan()->associate($kegiatan);
        $indikatorKegiatan->Satuan()->associate($request->satuan);
        $indikatorKegiatan->IndikatorHasil()->associate($request->indikator_hasil);
        $indikatorKegiatan->tolak_ukur = $request->input('tolak_ukur');
        $indikatorKegiatan->kode       = $request->input('kode');
        $indikatorKegiatan->asb        = $request->input('asb');
        return $indikatorKegiatan->save();
    }

    public function update($indikatorKegiatan, $request)
    {
        $indikatorKegiatan->Satuan()->associate($request->satuan);
        $indikatorKegiatan->IndikatorHasil()->associate($request->indikator_hasil);
        $indikatorKegiatan->tolak_ukur = $request->input('tolak_ukur');
        $indikatorKegiatan->kode       = $request->input('kode');
        $indikatorKegiatan->asb        = $request->input('asb');
        return $indikatorKegiatan->save();
    }
}