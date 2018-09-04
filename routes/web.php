<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'user\ProfileController@index')->name('profile');
    Route::post('/profile/update/', 'user\ProfileController@update')->name('profile.user.update');
    Route::post('/profile/update/kata-sandi/',
        'user\ProfileController@updatePassword')->name('profile.update.kata_sandi');

    Route::group(['prefix' => 'laporan'], function () {
        Route::get('desa', 'laporan\desa\LaporanController@index')->name('laporan.desa');
        Route::post('desa/preview', 'laporan\desa\LaporanController@preview')->name('laporan.desa.preview');
        Route::get('desa/preview', 'laporan\desa\LaporanController@show')->name('laporan.preview');


        Route::get('kecamatan', 'laporan\kecamatan\LaporanController@index')->name('laporan.kecamatan');
        Route::post('kecamatan/preview',
            'laporan\kecamatan\LaporanController@preview')->name('laporan.kecamatan.preview');
        Route::get('kecamatan/preview', 'laporan\kecamatan\LaporanController@show')->name('laporan.kecamatan.review');

        /** Laporan Renja*/
        Route::get('renja', 'laporan\renja\LaporanController@index')->name('laporan.renja');
        Route::get('renja/preview',
            'laporan\renja\LaporanController@show')->name('laporan.renja.preview');
        Route::get('renja/pdf',
        'laporan\renja\LaporanController@htmltopdfview')->name('laporan.renja.exportpdf');
        Route::post('renja/preview',
            'laporan\renja\LaporanController@store')->name('laporan.renja.store');

        /** Laporan Kabupaten*/
        Route::get('kabupaten', 'laporan\kabupaten\LaporanController@index')->name('laporan.kabupaten');
        Route::get('kabupaten/preview',
            'laporan\kabupaten\LaporanController@show')->name('laporan.kabupaten.preview');
        Route::post('kabupaten/preview',
            'laporan\kabupaten\LaporanController@store')->name('laporan.kabupaten.store');

        /** Laporan Akhir*/
        Route::get('akhir', 'laporan\akhir\LaporanController@index')->name('laporan.akhir');
        Route::get('akhir/preview',
            'laporan\akhir\LaporanController@show')->name('laporan.akhir.preview');
        Route::post('akhir/preview',
            'laporan\akhir\LaporanController@store')->name('laporan.akhir.store');

        /** Laporan Rancangan Kuappas*/
        Route::get('rancangan-kuappas',
            'laporan\rancangankuappas\LaporanController@index')->name('laporan.rancangankuappas');
        Route::get('rancangan-kuappas/preview',
            'laporan\rancangankuappas\LaporanController@show')->name('laporan.rancangankuappas.preview');
        Route::post('rancangan-kuappas/preview',
            'laporan\rancangankuappas\LaporanController@store')->name('laporan.rancangankuappas.store');

        /** Laporan Kuappas*/
        Route::get('kuappas', 'laporan\kuappas\LaporanController@index')->name('laporan.kuappas');
        Route::get('kuappas/preview',
            'laporan\kuappas\LaporanController@show')->name('laporan.kuappas.preview');
        Route::post('kuappas/preview',
            'laporan\kuappas\LaporanController@store')->name('laporan.kuappas.store');


        Route::get('dewan', 'laporan\dewan\LaporanController@index')->name('laporan.dewan');
        Route::post('dewan/preview', 'laporan\dewan\LaporanController@preview')->name('laporan.dewan.preview');
        Route::get('dewan/preview', 'laporan\dewan\LaporanController@show')->name('laporan.dewan.review');


        Route::get('awal', 'laporan\awal\LaporanController@index')->name('laporan.awal');
        Route::post('awal/preview', 'laporan\awal\LaporanController@preview')->name('laporan.awal.preview');
        Route::get('awal/preview', 'laporan\awal\LaporanController@show')->name('laporan.awal.review');
    });

    /* admin */
    include('admin/admin-route.php');

    Route::group(['prefix' => 'usulan', 'middleware' => 'auth'], function () {
        Route::resource('masyarakat', 'masyarakat\UsulanController');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
        Route::resource('profile', 'user\ProfileController');
    });

    Route::group(['prefix' => 'file'], function () {
        Route::post('upload', 'UploadController@upload')->name('file.upload');
    });

    Route::get('districts/{id}/villages', 'LocationController@villages')->name('location.villagegs');

    include('desa/musrenbang.php');

    Route::get('/layout', function () {
        return view('layouts.laporan._desa');
    });
    Route::get('htmltopdfview',array('as'=>'htmltopdfview','uses'=>'laporan\kecamatan\LaporanController@htmltopdfview'));
      Route::group(['prefix' => 'export'], function () {
        Route::post('excel/desa', 'laporan\desa\LaporanController@exportExcel')->name('export.excel.desa');
        Route::post('excel/kecamatan',
            'laporan\kecamatan\LaporanController@exportExcel')->name('export.excel.kecamatan');

        Route::post('excel/dewan',
            'laporan\dewan\LaporanController@exportExcel')->name('export.excel.dewan');
        Route::post('excel/awal',
            'laporan\awal\LaporanController@exportExcel')->name('export.excel.awal');
        Route::post('excel/renja',
            'laporan\renja\LaporanController@exportExcel')->name('export.excel.renja');
        Route::post('excel/kabupaten',
            'laporan\kabupaten\LaporanController@exportExcel')->name('export.excel.kabupaten');
        Route::post('excel/rancangankuappas',
            'laporan\rancangankuappas\LaporanController@exportExcel')->name('export.excel.rancangankuappas');
        Route::post('excel/akhir',
            'laporan\akhir\LaporanController@exportExcel')->name('export.excel.akhir');
        Route::post('excel/kuappas',
            'laporan\kuappas\LaporanController@exportExcel')->name('export.excel.kuappas');

        Route::post('pdf/renja',
            'laporan\renja\LaporanController@htmltopdfview')->name('export.pdf.renja');
    });

    Route::group(['prefix' => 'rancangan', 'middleware' => 'auth'], function () {
        Route::resource('awal', 'awal\RancanganController');
        Route::get('awal/{id}/transfer', 'awal\RancanganController@transfer')->name('awal.transfer.view');
        Route::post('awal/{id}/transfer', 'awal\RancanganController@doTransfer')->name('awal.transfer.store');

        Route::resource('kerja', 'kerja\RancanganController')->except('create');
        Route::post('kerja/transfer', 'kerja\RancanganController@transfer')->name('kerja.transfer');

        Route::resource('akhir', 'akhir\RancanganController')->except('create');
        Route::post('akhir/transfer', 'akhir\RancanganController@transfer')->name('akhir.transfer');

        //tambahan
        Route::post('rancangan-kuappas', 'rancangankuappas\RancanganController@update')->name('rancangan-kuappas.update');
        Route::post('rancangan-kuappas', 'rancangankuappas\RancanganController@index')->name('rancangan-kuappas.filter');
        Route::resource('rancangan-kuappas', 'rancangankuappas\RancanganController', ['except' => ['store']])->names('rancangan-kuappas');
        Route::post('rancangan-kuappas/{id}/transfer', 'rancangankuappas\RancanganController@transfer')->name('rancangan-kuappas.transfer');
        Route::post('rancangan-kuappas/{id}/kegiatan', 'rancangankuappas\RancanganController@kegiatan')->name('rancangan-kuappas.kegiatan');

        Route::resource('kuappas', 'kuappas\RancanganController')->names('kuappas');
        Route::post('kuappas/{id}/transfer', 'kuappas\RancanganController@transfer')->name('kuappas.transfer');
        Route::post('kuappas/{id}/kegiatan', 'kuappas\RancanganController@kegiatan')->name('kuappas.kegiatan');

        // route tambahan
        Route::get('rancangan-kuappas/{id}/transfer', 'rancangankuappas\RancanganController@transferView')->name('rancangan-kuappas.transfer.view');
        Route::post('rancangan-kuappas/{id}/transfer',
            'rancangankuappas\RancanganController@transfer')->name('rancangan-kuappas.transfer.store');
    });



    Route::group(['prefix' => 'api', 'middleware' => 'auth'], function () {
        Route::get('kegiatan', 'desa\MusrenbangController@lookupKegiatanByName')->name('kegiatan.lookup');
        Route::post('kegiatan', 'desa\MusrenbangController@fetchKegiatanData')->name('kegiatan.lookup.data');
        Route::post('transfer_desa', 'desa\MusrenbangController@transfer')->name('musrenbang-desa.transfer');
        Route::post('transfer_kelurahan',
            'kelurahan\MusrenbangController@transfer')->name('musrenbang-kelurahan.transfer');

        Route::get('kegiatan/opd', 'awal\RancanganController@lookupKegiatanByName')->name('kegiatan.lookup.opd');

        Route::group(['prefix' => 'admin'], function () {
            Route::get('kegiatan', 'Admin\KegiatanController@apiKegiatan')->name('api.kegiatan');
        });
    });
});
