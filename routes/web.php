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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::prefix('dashboard')
    ->group(function () {
        Route::get('/', 'DashbaordController@index')
            ->name('dashboard');
        Route::get('landing', 'DashbaordController@landing')
            ->name('landing');

        // permission
        Route::get('permission', 'PermissionController@index')
            ->name('permission');
        Route::get('permission.data', 'PermissionController@data')
            ->name('permission.data');
        Route::get('permission/tambahdata', 'PermissionController@create')
            ->name('permission.create');
        Route::post('permission.store', 'PermissionController@store')
            ->name('permission.store');
        Route::get('permission/edit/{id}', 'PermissionController@edit')
            ->name('permission.edit');
        Route::post('permission.update', 'PermissionController@update')
            ->name('permission.update');
        Route::post('permission.destroy', 'PermissionController@destroy')
            ->name('permission.destroy');


        // role
        Route::get('role', 'RoleController@index')
            ->name('role');
        Route::get('role.data', 'RoleController@data')
            ->name('role.data');
        Route::get('role/tambahdata', 'RoleController@create')
            ->name('role.create');
        Route::post('role.store', 'RoleController@store')
            ->name('role.store');
        Route::get('role/edit/{id}', 'RoleController@edit')
            ->name('role.edit');
        Route::post('role.update', 'RoleController@update')
            ->name('role.update');
        Route::post('role.destroy', 'RoleController@destroy')
            ->name('role.destroy');
        Route::get('role.permissions', 'RoleController@permissions')
            ->name('role.permissions');
        Route::get('role.permissionsByRole', 'RoleController@permissionsByRole')
            ->name('role.permissionsByRole');
        Route::post('role.destroyPermissionByRole', 'RoleController@destroyPermissionByRole')
            ->name('role.destroyPermissionByRole');
        // Route::get('role.tambahpermission/{id}', 'role')

        // users
        Route::get('users', 'UserController@index')
            ->name('users');
        Route::get('users.data', 'UserController@data')
            ->name('users.data');
        Route::get('users/tambahdata', 'UserController@create')
            ->name('users.create');
        Route::get('users.role', 'UserController@role')
            ->name('users.role');
        Route::get('users.roleByUser', 'UserController@roleByUser')
            ->name('user.roleByUser');
        Route::post('users.store', 'UserController@store')
            ->name('users.store');
        Route::get('users/edit/{id}', 'UserController@edit')
            ->name('user.edit');
        Route::get('users.roleByUser', 'UserController@roleByUser')
            ->name('users.roleByUser');
        Route::post('users.update', 'UserController@update')
            ->name('users.update');

        // tahun
        Route::get('tahun', 'TahunController@index')
            ->name('tahun');
        Route::get('tahun.data', 'TahunController@data')
            ->name('tahun.data');
        Route::get('/tahun/tambahdata', 'TahunController@create')
            ->name('tahun.create');
        Route::get('tahun/edit/{id}', 'TahunController@edit')
            ->name('tahun.edit');
        Route::post('tahun.store', 'TahunController@store')
            ->name('tahun.store');
        Route::post('tahun.update', 'TahunController@update')
            ->name('tahun.update');
        Route::post('tahun.destroy', 'TahunController@destroy')
            ->name('tahun.destroy');

        // unit
        Route::get('unit', 'UnitController@index')
            ->name('unit');
        Route::get('unit.data', 'UnitController@data')
            ->name('unit.data');
        Route::get('unit/tambahdata', 'UnitController@create')
            ->name('unit.create');
        Route::post('unit.store', 'UnitController@store')
            ->name('unit.store');
        Route::get('unit/edit/{id}', 'UnitController@edit')
            ->name('unit.edit');
        Route::get('unit.users', 'UnitController@users')
            ->name('unit.users');
        Route::post('unit.destroy', 'UnitController@destroy')
            ->name('unit.destroy');
        Route::get('unit.usersByUnit', 'UnitController@userByUnit')
            ->name('unit.userByUnit');
        Route::post('unit.update', 'UnitController@update')
            ->name('unit.update');

        Route::get('barang', 'BarangController@index')
            ->name('barang');
        Route::get('barang.data', 'BarangController@data')
            ->name('barang.data');
        Route::get('barang/tambahdata', 'BarangController@create')
            ->name('barang.create');
        Route::post('barang.store', 'BarangController@store')
            ->name('barang.store');
        Route::get('barang/edit/{slug}', 'BarangController@edit')
            ->name('barang.edit');
        Route::get('barang/detail/{id}', 'BarangController@detail')
            ->name('barang.detail');
        Route::post('barang.update', 'BarangController@update')
            ->name('barang.update');
        Route::post('hapus.barang', 'BarangController@hapus_barang')
            ->name('hapus.barang');

        Route::get('barang/tambahsubbarang/{slug}', 'BarangController@create_sub_barang')
            ->name('barang.create_sub_barang');
        Route::post('sub_barang.store', 'BarangController@store_sub_barang')
            ->name('sub_barang.store');
        Route::get('subbarang/edit/{slug}', 'BarangController@edit_sub_barang')
            ->name('sub_barang.edit');
        Route::post('sub_barang.destroy', 'BarangController@hapus_sub_barang')
            ->name('sub_barang.hapus');
        Route::get('barang/tambahparameter/{slug}', 'BarangController@create_parameter_barang')
            ->name('barang.createparameter');
        Route::post('parameter_barang.store', 'BarangController@store_parameter_barang')
            ->name('parameter_barang.store');
        Route::get('parameter/create_spesifikasi_parameter/{slug}', 'BarangController@create_spesifikasi_parameter')
            ->name('paramter.create_spesifikasi_parameter');
        Route::post('parameter.destroy', 'BarangController@hapus_parameter')
            ->name('hapus_parameter');

        Route::post('spesifikasi_parameter.store', 'BarangController@store_spesifikasi_parameter')
            ->name('spesifikasi_parameter.store');
        Route::get('spesifikasi_parameter/edit/{slug}', 'BarangController@edit_spesifikasi_paremeter')
            ->name('spesfiikasi_parameter.edit');
        Route::post('spesifikasi_parameter.update', 'BarangController@update_spesfikasi_parameter')
            ->name('spesifikasi_parameter.update');
        Route::post('spesifikasi_parameter.destroy', 'BarangController@hapus_spesifikasi_parameter')
            ->name('hapus_spesifikasi_parameter');
        Route::get('paramater/edit/{slug}', 'BarangController@edit_parameter_barang')
            ->name('edit_parameter_barang');
        Route::post('paramater.update', 'BarangController@updateParameterBarang')
            ->name('paramater.update');

        // pengadaan
        Route::get('pengadaan', 'PengadaanController@index')
            ->name('pengadaan');
        Route::get('pengadaan.data', 'PengadaanController@data')
            ->name('pengadaan.data');
        Route::get('pengadaan.create', 'PengadaanController@create')
            ->name('pengadaan.create');
        Route::get('list_unit.pengadaan', 'PengadaanController@list_unit')
            ->name('list_unit.pengadaan');
        Route::get('list_tahun.pengadaan', 'PengadaanController@list_tahun')
            ->name('list_tahun.pengadaan');
        Route::post('pengadan.store', 'PengadaanController@store_pengadaan')
            ->name('pengadaan.store');
        Route::get('pengdaan/detail/{id}', 'PengadaanController@detail')
            ->name('pengdaan.detail');
        Route::post('pengadaan.hapus', 'PengadaanController@hapus_pengadaan')
            ->name('pengadaan.hapus');
        Route::get('pengadaan/download-nota-dinas/{id}',  'PengadaanController@download_file_pengadaan')
            ->name('download_file_nota_dinas');
        Route::get('pengadaan/download-dokumen-direksi/{id}', 'PengadaanController@download_file_direksi')
            ->name('download_dokumen_direksi');
        Route::get('pengadaan.list_barang', 'PengadaanController@list_barang')
            ->name('pengadaan.list_barang');
        Route::get('pengadaan.list_sub_barang', 'PengadaanController@list_sub_barang')
            ->name('pengadaan.list_sub_barang');
        Route::get('form_spesifikasi_sub_barang.pengadaan', 'PengadaanController@form_spesifikasi_sub_barang')
            ->name('form_spesifikasi_sub_barang.pengadaan');
        Route::get('pengadaan.ceklist_direksi', 'PengadaanController@ceklist_direksi')
            ->name('ceklist_direksi');
        Route::post('pengadaa.simpan_pengadaan_detail', 'PengadaanController@simpan_pengadaan_detail')
            ->name('pengadaan.simpan_pengadaan_detail');

        // sortlist
        Route::post('hitung.shortlist', 'PengadaanController@hitung')
            ->name('hitung');
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
