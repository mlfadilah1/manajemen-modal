<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    {
        return redirect()->route('login');
    }
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth','Admin'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    //laporan
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
    Route::get('/tambahlaporan', [App\Http\Controllers\LaporanController::class, 'tambah'])->name('tambahlaporan');
    Route::get('/editlaporan{id}', [App\Http\Controllers\LaporanController::class, 'edit'])->name('editlaporan');
    Route::post('/submitlaporan', [App\Http\Controllers\LaporanController::class, 'submit'])->name('submitlaporan');
    Route::post('/updatelaporan{id}', [App\Http\Controllers\LaporanController::class, 'update'])->name('updatelaporan');
    Route::delete('/deletelaporan{id}', [App\Http\Controllers\LaporanController::class, 'delete'])->name('deletelaporan');
    //modal
    Route::get('/modal', [App\Http\Controllers\ModalController::class, 'index'])->name('modal');
    Route::get('/tambahmodal', [App\Http\Controllers\ModalController::class, 'tambah'])->name('tambahmodal');
    Route::get('/editmodal{id}', [App\Http\Controllers\ModalController::class, 'edit'])->name('editmodal');
    Route::post('/submitmodal', [App\Http\Controllers\ModalController::class, 'submit'])->name('submitmodal');
    Route::post('/updatemodal{id}', [App\Http\Controllers\ModalController::class, 'update'])->name('updatemodal');
    Route::delete('/deletemodal{id}', [App\Http\Controllers\ModalController::class, 'delete'])->name('deletemodal');
    //pendapatan
    Route::get('/pendapatan', [App\Http\Controllers\PendapatanController::class, 'index'])->name('pendapatan');
    Route::get('/tambahpendapatan', [App\Http\Controllers\PendapatanController::class, 'tambah'])->name('tambahpendapatan');
    Route::get('/editpendapatan{id}', [App\Http\Controllers\PendapatanController::class, 'edit'])->name('editpendapatan');
    Route::post('/submitpendapatan', [App\Http\Controllers\PendapatanController::class, 'submit'])->name('submitpendapatan');
    Route::post('/updatependapatan{id}', [App\Http\Controllers\PendapatanController::class, 'update'])->name('updatependapatan');
    Route::delete('/deletependapatan{id}', [App\Http\Controllers\PendapatanController::class, 'delete'])->name('deletependapatan');
    Route::get('/exportpendapatan', [App\Http\Controllers\PendapatanController::class, 'exportPDF'])->name('exportpendapatan');
    //analisis
    Route::get('/analisis', [App\Http\Controllers\BRController::class, 'index'])->name('analisis');
    Route::get('/tambahanalisis', [App\Http\Controllers\BRController::class, 'tambah'])->name('tambahanalisis');
    Route::get('/editanalisis{id}', [App\Http\Controllers\BRController::class, 'edit'])->name('editanalisis');
    Route::post('/submitanalisis', [App\Http\Controllers\BRController::class, 'submit'])->name('submitanalisis');
    Route::post('/updateanalisis{id}', [App\Http\Controllers\BRController::class, 'update'])->name('updateanalisis');
    Route::delete('/deleteanalisis{id}', [App\Http\Controllers\BRController::class, 'delete'])->name('deleteanalisis');
    //produk
    Route::get('/produk', [App\Http\Controllers\ProdukController::class, 'index'])->name('produk');
    Route::get('/tambahproduk', [App\Http\Controllers\ProdukController::class, 'tambah'])->name('tambahproduk');
    Route::get('/editproduk{id}', [App\Http\Controllers\ProdukController::class, 'edit'])->name('editproduk');
    Route::post('/submitproduk', [App\Http\Controllers\ProdukController::class, 'submit'])->name('submitproduk');
    Route::post('/updateproduk{id}', [App\Http\Controllers\ProdukController::class, 'update'])->name('updateproduk');
    Route::delete('/deleteproduk{id}', [App\Http\Controllers\ProdukController::class, 'delete'])->name('deleteproduk');
    //operasional
    Route::get('/operasional', [App\Http\Controllers\OperasionalController::class, 'index'])->name('operasional');
    Route::get('/tambahoperasional', [App\Http\Controllers\OperasionalController::class, 'tambah'])->name('tambahoperasional');
    Route::get('/editoperasional{id}', [App\Http\Controllers\OperasionalController::class, 'edit'])->name('editoperasional');
    Route::post('/submitoperasional', [App\Http\Controllers\OperasionalController::class, 'submit'])->name('submitoperasional');
    Route::post('/updateoperasional{id}', [App\Http\Controllers\OperasionalController::class, 'update'])->name('updateoperasional');
    Route::delete('/deleteoperasional{id}', [App\Http\Controllers\OperasionalController::class, 'delete'])->name('deleteoperasional');
    Route::get('/exportoperasional', [App\Http\Controllers\OperasionalController::class, 'exportPDF'])->name('exportoperasional');
    //user
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
    Route::get('/tambahuser', [App\Http\Controllers\UserController::class, 'tambah'])->name('tambahuser');
    Route::get('/edituser{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edituser');
    Route::post('/submituser', [App\Http\Controllers\UserController::class, 'submituser'])->name('submituser');
    Route::post('/updateuser{id}', [App\Http\Controllers\UserController::class, 'update'])->name('updateuser');
    Route::delete('/deleteuser{id}',[App\Http\Controllers\UserController::class, 'deleteuser'])->name('deleteuser');
});
Route::middleware(['auth','Staff'])->group(function(){
    Route::get('/biayaoperasional', [App\Http\Controllers\OperasionalController::class, 'staff'])->name('biayaoperasional');
    Route::get('/pencatatan', [App\Http\Controllers\PendapatanController::class, 'staff'])->name('pencatatan');
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/operasional', [App\Http\Controllers\OperasionalController::class, 'index'])->name('operasional');
    Route::get('/tambahoperasional', [App\Http\Controllers\OperasionalController::class, 'tambah'])->name('tambahoperasional');
    Route::get('/editoperasional{id}', [App\Http\Controllers\OperasionalController::class, 'edit'])->name('editoperasional');
    Route::post('/submitoperasional', [App\Http\Controllers\OperasionalController::class, 'submit'])->name('submitoperasional');
    Route::post('/updateoperasional{id}', [App\Http\Controllers\OperasionalController::class, 'update'])->name('updateoperasional');
    Route::delete('/deleteoperasional{id}', [App\Http\Controllers\OperasionalController::class, 'delete'])->name('deleteoperasional');
    Route::get('/exportoperasional', [App\Http\Controllers\OperasionalController::class, 'exportPDF'])->name('exportoperasional');
    Route::get('/pendapatan', [App\Http\Controllers\PendapatanController::class, 'index'])->name('pendapatan');
    Route::get('/tambahpendapatan', [App\Http\Controllers\PendapatanController::class, 'tambah'])->name('tambahpendapatan');
    Route::get('/editpendapatan{id}', [App\Http\Controllers\PendapatanController::class, 'edit'])->name('editpendapatan');
    Route::post('/submitpendapatan', [App\Http\Controllers\PendapatanController::class, 'submit'])->name('submitpendapatan');
    Route::post('/updatependapatan{id}', [App\Http\Controllers\PendapatanController::class, 'update'])->name('updatependapatan');
    Route::delete('/deletependapatan{id}', [App\Http\Controllers\PendapatanController::class, 'delete'])->name('deletependapatan');
    Route::get('/exportpendapatan', [App\Http\Controllers\PendapatanController::class, 'exportPDF'])->name('exportpendapatan');
});