<?php

Route::group(['prefix' => 'musrenbang', 'middleware' => 'auth'], function () {
    Route::resource('musrenbang-desa', 'desa\MusrenbangController');
    Route::get('musrenbang-desa/{id}/transfer', 'desa\MusrenbangController@transfer')->name('musrenbang-desa.transfer.view');
    Route::post('musrenbang-desa/{id}/transfer', 'desa\MusrenbangController@doTransfer')->name('musrenbang-desa.transfer.store');

    Route::resource('musrenbang-kelurahan', 'kelurahan\MusrenbangController');
    Route::resource('musrenbang-dewan', 'dewan\MusrenbangController');
    Route::get('musrenbang-dewan/{id}/transfer', 'dewan\MusrenbangController@transfer')->name('musrenbang-dewan.transfer.view');
    Route::post('musrenbang-dewan/{id}/transfer', 'dewan\MusrenbangController@doTransfer')->name('musrenbang-dewan.transfer.store');
    Route::resource('musrenbang-kecamatan', 'kecamatan\MusrenbangController');

    Route::resource('musrenbang-kabupaten', 'kabupaten\MusrenbangController')->except('create');
    Route::post('musrenbang-kabupaten/transfer', 'kabupaten\MusrenbangController@transfer')->name('musrenbang-kabupaten.transfer');

    Route::get('musrenbang-kecamatan/{id}/transfer', 'kecamatan\MusrenbangController@transfer')->name('musrenbang-kecamatan.transfer.view');
    Route::post('musrenbang-kecamatan/{id}/transfer', 'kecamatan\MusrenbangController@doTransfer')->name('musrenbang-kecamatan.transfer.store');
});