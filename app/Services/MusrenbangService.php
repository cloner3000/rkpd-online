<?php

namespace App\Services;

use App\Anggaran;
use App\IndikatorKegiatan;
use App\JenisLokasi;
use App\Kegiatan;
use App\location\Districts;
use App\location\Villages;
use App\StatusKegiatan;
use App\SumberAnggaran;
use App\Tahapan;
use App\TargetAnggaran;
use App\Opd;

class MusrenbangService
{

    public function store($request, $tahapan, $is_kelurahan = false)
    {
    
        if ($request->input('lokasi')) {
            $lokasi = $request->input('lokasi');
        }

        $status_kegiatan = $request->input('status_kegiatan');

        if (empty($request->input('status_kegiatan'))) {
            $status_kegiatan = 2;
        }

        $statusKegiatan = StatusKegiatan::find($status_kegiatan);

        $opdId = $request->user()->opd->first();
        $jenisLokasi = JenisLokasi::find($request->input('lokasi_kegiatan'));
        $sumberAnggaran = SumberAnggaran::find($request->input('sumber_anggaran'));
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));

        $anggaran = new Anggaran();
        $anggaran->tahun = $request->input('tahun');
        $anggaran->opd()->associate($kegiatan->opd()->first());
        $anggaran->opd_pelaksana_id = $kegiatan->opd()->first()->id ?? null;
        $anggaran->target_hk = $request->input('target_hk');
        $anggaran->lokasi = $lokasi ?? $request->input('lokasi');
        $anggaran->is_kelurahan = $is_kelurahan;

        $anggaran->tahapan()->associate($tahapan);
        $anggaran->statusKegiatan()->associate($statusKegiatan);
        $anggaran->jenisLokasi()->associate($jenisLokasi);
        $anggaran->user()->associate($request->user());
        $anggaran->sumberAnggaran()->associate($sumberAnggaran);
        $anggaran->kegiatan()->associate($kegiatan);
        $anggaran->village_id = $request->input('desa');;
        $anggaran->district_id = $request->input('kecamatan');;

        $anggaran->save();

        $targets = $request->input('target_indikator_kegiatan');

        if ($targets) {
            foreach ($targets as $id => $target) {
                $indikatorKegiatan = IndikatorKegiatan::find($id);
                $ta = new TargetAnggaran();
                $ta->anggaran()->associate($anggaran);
                $ta->indikatorKegiatan()->associate($indikatorKegiatan);
                $ta->target = $target;
                $ta->save();
            }
        }

        $hasil = $request->input('target_indikator_hasil');
        if ($hasil) {
            foreach ($hasil as $id => $target) {
                $indikatorKegiatan = IndikatorKegiatan::find($id);
                $ta = new TargetAnggaran();
                $ta->anggaran()->associate($anggaran);
                $ta->indikatorKegiatan()->associate($indikatorKegiatan);
                $ta->target = $target ?? 0;
                $ta->save();
            }
        }
    }

    public function update($request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        if ($request->input('kecamatan') && $request->input('desa')) {
            $kecamatan = Districts::find($request->input('kecamatan'));
            $desa = Villages::find($request->input('desa'));
            if ($desa && $kecamatan) {
                $lokasi = 'Kecamatan : ' . $kecamatan->name . '; Desa/Kelurahan : ' . $desa->name;
            }
        }


        if ($request->input('lokasi')) {
            $lokasi = $request->input('lokasi');
        }

        $status_kegiatan = $request->input('status_kegiatan');

        if (empty($request->input('status_kegiatan'))) {
            $status_kegiatan = 2;
        }

        $statusKegiatan = StatusKegiatan::find($status_kegiatan);

        $opdId = $request->user()->opd->first();
        $jenisLokasi = JenisLokasi::find($request->input('lokasi_kegiatan'));
        $sumberAnggaran = SumberAnggaran::find($request->input('sumber_anggaran'));
        $kegiatan = Kegiatan::find($request->input('nama_kegiatan'));

        $anggaran->tahun = $request->input('tahun');
        $anggaran->opd()->associate($kegiatan->opd()->first());
        $anggaran->opd_pelaksana_id = $kegiatan->opd()->first()->id ?? null;
        $anggaran->lokasi = $lokasi ?? $request->input('lokasi');
        $anggaran->file_kak = $pathKak ?? null;

        $anggaran->statusKegiatan()->associate($statusKegiatan);
        $anggaran->jenisLokasi()->associate($jenisLokasi);
        $anggaran->user()->associate($request->user());
        $anggaran->sumberAnggaran()->associate($sumberAnggaran);
        $anggaran->kegiatan()->associate($kegiatan);

        $anggaran->save();

        $targets = $request->input('target_indikator_kegiatan');

        TargetAnggaran::whereAnggaranId($anggaran->id)->delete();

        if ($targets) {
            foreach ($targets as $id => $target) {
                $indikatorKegiatan = IndikatorKegiatan::find($id);

                $ta = new TargetAnggaran();
                $ta->anggaran()->associate($anggaran);
                $ta->indikatorKegiatan()->associate($indikatorKegiatan);
                $ta->target = $target;
                $ta->save();
            }
        }

        $hasil = $request->input('target_indikator_hasil');

        if ($hasil) {
            foreach ($hasil as $id => $target) {
                $indikatorKegiatan = IndikatorKegiatan::find($id);
                TargetAnggaran::whereAnggaranId($anggaran->id)->whereIndikatorKegiatanId($indikatorKegiatan->id)->delete();
                $ta = new TargetAnggaran();
                $ta->anggaran()->associate($anggaran);
                $ta->indikatorKegiatan()->associate($indikatorKegiatan);
                $ta->target = $target;
                $ta->save();
            }
        }
    }

    public function transfer($anggaran, $tahapan_id)
    {
        $item                     = New Anggaran();
        $item->tahun              = $anggaran->tahun;
        $item->opd_id             = $anggaran->opd_id;
        $item->opd_pelaksana_id   = $anggaran->opd_pelaksana_id;
        $item->tahapan_id         = $tahapan_id;
        $item->kegiatan_id        = $anggaran->kegiatan_id;
        $item->status_kegiatan_id = $anggaran->status_kegiatan_id;
        $item->sumber_anggaran_id = $anggaran->sumber_anggaran_id;
        $item->jenis_lokasi_id    = $anggaran->jenis_lokasi_id;
        $item->lokasi             = $anggaran->lokasi;
        $item->file_kak           = $anggaran->file_kak;
        $item->file_foto          = $anggaran->file_foto;
        $item->anggaran_id        = $anggaran->id;
        $item->is_transfer        = false;
        $item->is_verifikasi      = false;
        $item->is_kelurahan       = $anggaran->is_kelurahan;
        $item->district_id        = $anggaran->district_id;
        $item->village_id         = $anggaran->village_id;
        $item->pagu               = $anggaran->pagu;
        $item->prioritas          = $anggaran->prioritas;
        $item->proposal           = $anggaran->proposal;
        $item->user()->associate(auth()->user());
        $item->save();

        return $item;
    }

    public function transferTargetAnggaran($anggaran, $anggaran_transfer)
    {
        $targets = TargetAnggaran::whereAnggaranId($anggaran->id)->get();

        foreach ($targets as $key => $target) {
            $indikatorKegiatan = IndikatorKegiatan::find($target->indikator_kegiatan_id);
            $ta = new TargetAnggaran();
            $ta->anggaran()->associate($anggaran_transfer);
            $ta->indikatorKegiatan()->associate($indikatorKegiatan);
            $ta->target = $target->target;
            $ta->save();
        }
    }

    public function storeTargetAnggaran($request, $anggaran)
    {
        $targets = $request->input('target_indikator_kegiatan');

        if ($targets) {
            foreach ($targets as $id => $target) {
                $indikatorKegiatan = IndikatorKegiatan::find($id);
                $ta = new TargetAnggaran();
                $ta->anggaran()->associate($anggaran);
                $ta->indikatorKegiatan()->associate($indikatorKegiatan);
                $ta->target = $target;
                $ta->save();
            }
        }

        $hasil = $request->input('target_indikator_hasil');
        if ($hasil) {
            foreach ($hasil as $id => $target) {
                $indikatorKegiatan = IndikatorKegiatan::find($id);
                $ta = new TargetAnggaran();
                $ta->anggaran()->associate($anggaran);
                $ta->indikatorKegiatan()->associate($indikatorKegiatan);
                $ta->target = $target ?? 0;
                $ta->save();
            }
        }
    }

    protected function storeVillageAndDesa($model, Tahapan $tahapan)
    {
        $user       = auth()->user();
        $user_opd   = $user->opd->first();

        if (!empty($user_opd)) {
            $model->village_id = $user_opd->id ?? null;
            $model->district_id = Opd::whereKode(substr($user_opd->kode, 0, 7))->first()->id ?? null;

            if ($tahapan->nama == \App\Enum\Tahapan::KECAMATAN) {
                $model->village_id = null;
            }
        }

        return $model;
    }

    public function updateTransferStatus(Anggaran $anggaran, $status = false) {
        if ($anggaran->anggaran_id) {
            // Get musrenbang desa/ kelurahan)
            $desa = Anggaran::find($anggaran->anggaran_id);
            if ($desa) {
                // update musrenbang desa
                $desa->is_transfer = $status;
                $desa->save();
            }
        }
    }
}
