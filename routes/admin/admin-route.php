<?php

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::resource('menu', 'Admin\MenuController');
    Route::resource('user', 'Admin\UserController');
    Route::resource('role', 'Admin\RoleController');
    Route::resource('pemda', 'Admin\PemdaController');
    Route::resource('visi', 'Admin\VisiController');
    Route::resource('misi', 'Admin\MisiController');
    Route::resource('tujuan', 'Admin\TujuanController');
    Route::resource('sasaran', 'Admin\SasaranController');
    Route::resource('indikator-sasaran', 'Admin\IndikatorSasaranController');
    Route::resource('urusan', 'Admin\UrusanController');
    Route::resource('bidang-urusan', 'Admin\BidangUrusanController');
    Route::resource('program', 'Admin\ProgramController');
    Route::resource('kegiatan', 'Admin\KegiatanController');
    Route::resource('capaian-program', 'Admin\CapaianProgramController');
    Route::resource('lokasi-kegiatan', 'Admin\LokasiKegiatanController');
    Route::resource('role-opd', 'Admin\RoleOpdController');
    Route::resource('opd', 'Admin\OpdController');
    Route::resource('tahapan', 'Admin\TahapanController');
    Route::resource('satuan', 'Admin\SatuanController');

    // Indikator Kegiatan
    Route::get('kegiatan/{kegiatanId}/indikator-kegiatan', 'Admin\IndikatorKegiatanController@index')->name('kegiatan.indikator-kegiatan.index');
    Route::get('kegiatan/{kegiatanId}/indikator-kegiatan/create', 'Admin\IndikatorKegiatanController@create')->name('kegiatan.indikator-kegiatan.create');
    Route::get('kegiatan/{kegiatanId}/indikator-kegiatan/edit/{id}', 'Admin\IndikatorKegiatanController@edit')->name('kegiatan.indikator-kegiatan.edit');
    Route::put('kegiatan/{kegiatanId}/indikator-kegiatan/{id}', 'Admin\IndikatorKegiatanController@update')->name('kegiatan.indikator-kegiatan.update');
    Route::post('kegiatan/{kegiatanId}/indikator-kegiatan/', 'Admin\IndikatorKegiatanController@store')->name('kegiatan.indikator-kegiatan.store');
    Route::delete('kegiatan/{kegiatanId}/indikator-kegiatan/{id}', 'Admin\IndikatorKegiatanController@destroy')->name('kegiatan.indikator-kegiatan.destroy');

    // Kegiatan OPD
    Route::get('opd/{opd_id}/opd-kegiatan', 'Admin\OpdKegiatanController@index')->name('opd.opd-kegiatan.index');
    Route::get('opd/{opd_id}/opd-kegiatan/create', 'Admin\OpdKegiatanController@create')->name('opd.opd-kegiatan.create');
    Route::get('opd/{opd_id}/opd-kegiatan/edit/{id}', 'Admin\OpdKegiatanController@edit')->name('opd.opd-kegiatan.edit');
    Route::put('opd/{opd_id}/opd-kegiatan/{id}', 'Admin\OpdKegiatanController@update')->name('opd.opd-kegiatan.update');
    Route::post('opd/{opd_id}/opd-kegiatan/', 'Admin\OpdKegiatanController@store')->name('opd.opd-kegiatan.store');
    Route::delete('opd/{opd_id}/opd-kegiatan/{id}', 'Admin\OpdKegiatanController@destroy')->name('opd.opd-kegiatan.destroy');

    // Tahapan OPD
    Route::get('tahapan/{tahapan_id}/tahapan-opd', 'Admin\TahapanOpdController@index')->name('tahapan.opd.index');
    Route::get('tahapan/{tahapan_id}/tahapan-opd/create', 'Admin\TahapanOpdController@create')->name('tahapan.opd.create');
    Route::get('tahapan/{tahapan_id}/tahapan-opd/edit/{id}', 'Admin\TahapanOpdController@edit')->name('tahapan.opd.edit');
    Route::put('tahapan/{tahapan_id}/tahapan-opd/{id}', 'Admin\TahapanOpdController@update')->name('tahapan.opd.update');
    Route::post('tahapan/{tahapan_id}/tahapan-opd/', 'Admin\TahapanOpdController@store')->name('tahapan.opd.store');
    Route::delete('tahapan/{tahapan_id}/tahapan-opd/{id}', 'Admin\TahapanOpdController@destroy')->name('tahapan.opd.destroy');

    // Permission
    Route::resource('permission', 'Admin\PermissionController');
        
        // route tambahan
        Route::match(['get', 'post'], '/bidang', [
            'uses' => 'Admin\BidangController@index',
            'as' => 'bidang'
        ]);

    Route::post('permission/attach', 'Admin\PermissionController@attachPermission')->name('permission.attach');

    // JSON response
    Route::post('permission/role/menus', 'Admin\PermissionController@listMenu')->name('api.permission.menus');
    Route::get('/musrenbang/musrenbang-desa/list', 'desa\MusrenbangController@list')->name('api.musrenbang.index');
    Route::post('role-opd/opd', 'Admin\RoleOpdController@listOpd')->name('api.role-opd.opd');
    Route::post('user/opd', 'Admin\UserController@listOpd')->name('api.user.opd');

        //bidang
        Route::post('permission/bidang/opds', 'Admin\BidangController@listOpd')->name('api.bidang.opds');

    // password pengguna
    Route::post('user/password/{id}', 'Admin\UserController@updatePassword')->name('user.update.password');
});