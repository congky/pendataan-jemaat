<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LoginController@viewLogin');
Route::post('/do-login', 'LoginController@doLogin');

Route::group(["middleware" => "login.user"], function() {
    Route::get('/do-logout', 'LoginController@doLogout');
    Route::get('/home', 'DefaultController@viewHome');
    Route::get('/data-jemaat', 'JemaatController@viewIndex');
    Route::get('/data-baptisan', 'JemaatController@viewBaptisan');
    Route::get('/data-usulan-baptisan', 'JemaatController@viewUsulanBaptisan');
    Route::get('/data-konfirmasi-usulan-baptisan', 'JemaatController@konfirmasiUsulan');
    Route::get('/usul-baptis/{anggota_id}', 'JemaatController@usulanBaptisanJemaat');
    Route::get('/usul-baptis/{anggota_id}/{status}', 'JemaatController@usulanBaptisan');
    Route::get('/tambah-jemaat', 'JemaatController@tambahJemaat');
    Route::any('/simpan-daftar-jemaat', 'JemaatController@SimpandaftarJemaat');
    Route::any("/edit-jemaat/{anggota_id}/{action}", "JemaatController@editJemaat");

    Route::any("/edit-daftar-jemaat01", "JemaatController@EditdaftarJemaat");
    Route::any('/simpan-konfirmasi-usulan', 'JemaatController@konfirmasiDataUsulan');
    Route::any('/proses-usul-baptis/{id}', 'JemaatController@prosesDataUsulan');
    Route::any('/konfirmasi-usul-baptis/{id}', 'JemaatController@konfirmasiUsulan');

    Route::get('/data-kematian', 'JemaatController@dataKematian');
    Route::get('/tambah-data-kematian/{id}', 'JemaatController@tambahDataKematian');
    Route::any('/simpan-data-kematian', 'JemaatController@doTambahDataKematian');
    Route::any('/hapus-data-kematian/{id}', 'JemaatController@hapusDataKematian');
    Route::any('/penyerahan-anak/{id}', 'JemaatController@penyerahanAnak');
    Route::any('/simpan-penyerahan-anak', 'JemaatController@doSimapnPenyerahanAnak');
    Route::any('/hapus-penyerahan-anak/{id}', 'JemaatController@hapusSimapnPenyerahanAnak');
    Route::any('/tambah-data-usulan-pernikahan', 'PernikahanController@tambahDataUsulanPernikahan');
    Route::any('/simpan-data-usulan', 'PernikahanController@doTambahDataUsulanPernikahan');
    Route::any('/lihat-data-usulan-pernikahan', 'PernikahanController@lihatDataUsulPernikahan');
    Route::any('/hapus-data-usulan-pernikahan/{id}', 'PernikahanController@doHapusDataUsulanPernikahan');
    Route::get('/prepare-usulan-pernikahan/{id}', 'PernikahanController@prepareProsesDataUsulanPernikahan');
    Route::any('/proses-data-usulan-pernikahan/{id}', 'PernikahanController@doProsesDataUsulanPernikahan');
    Route::any('/lihat-data-pernikahan', 'PernikahanController@lihatDataPernikahan');
    Route::any('/edit-data-kematian/{id}', 'JemaatController@editDataKematin');
    Route::any('/do-simpan-data-kematian', 'JemaatController@doEditDataKematin');
    Route::any('/edit-data-usulan-pernikahan/{id}/{action}', 'PernikahanController@editDataPernikahan');
    Route::any('/do-simpan-data-usulan', 'PernikahanController@doEditDataPernikahan');
    Route::any('/cetak-baptisan/{id}', 'JemaatController@cetak');
    Route::any('/edit-baptisan/{id}', 'JemaatController@editBaptisan');
    Route::any('/edit-data-baptisan', 'JemaatController@doEditBaptisan');
    Route::any('/lihat-data-diri', 'JemaatController@viewLihatDataDiri');
    Route::any('/cetak-all', 'JemaatController@cetakAll');
    Route::any('/cari-pasangan', 'JemaatController@cariPasangan');
    Route::any('/usul-menikah-jemaat/{id}', 'JemaatController@usulMenikahJemaat');
    Route::any('/simpan-data-usulan-jemaat', 'JemaatController@simpanUsulanJemaat');
    Route::any('/simpan-usulan-baptisan-jemaat', 'JemaatController@simpanUsulanBaptisanJemaat');
});
