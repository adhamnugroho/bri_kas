<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\LaporanKasMasukController;
use App\Http\Controllers\LaporanKasKeluarController;

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


Route::get('/', function () {

    return redirect()->route('dashboard');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['checklogin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'main'])->name('dashboard');

    Route::group(['prefix' => 'datamaster'], function () {

        Route::group(['prefix' => 'users'], function () {

            Route::get('/', [UsersController::class, 'index'])->name('users');
            Route::get('/create', [UsersController::class, 'create'])->name('usersCreate');
            Route::post('/store', [UsersController::class, 'store'])->name('usersStore');
            Route::get('/show/{id}', [UsersController::class, 'show'])->name('usersShow');
            Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('usersEdit');
            Route::post('/update/{id}', [UsersController::class, 'update'])->name('usersUpdate');
            Route::get('/delete/{id}', [UsersController::class, 'destroy'])->name('usersDelete');

            Route::post('/getKabupaten', [UsersController::class, 'getKabupaten'])->name('usersGetKabupaten');
        });
    });


    Route::group(['prefix' => 'kas'], function () {

        Route::group(['prefix' => 'kas-masuk'], function () {

            Route::get('/', [KasMasukController::class, 'index'])->name('kasMasuk');
            Route::get('/create', [KasMasukController::class, 'create'])->name('kasMasukCreate');
            Route::post('/store', [KasMasukController::class, 'store'])->name('kasMasukStore');
            Route::get('/show/{id}', [KasMasukController::class, 'show'])->name('kasMasukShow');
            Route::get('/edit/{id}', [KasMasukController::class, 'edit'])->name('kasMasukEdit');
            Route::post('/update/{id}', [KasMasukController::class, 'update'])->name('kasMasukUpdate');
            Route::get('/delete/{id}', [KasMasukController::class, 'destroy'])->name('kasMasukDelete');
        });


        Route::group(['prefix' => 'kas-keluar'], function () {

            Route::get('/', [KasKeluarController::class, 'index'])->name('kasKeluar');
            Route::get('/create', [KasKeluarController::class, 'create'])->name('kasKeluarCreate');
            Route::post('/store', [KasKeluarController::class, 'store'])->name('kasKeluarStore');
            Route::get('/show/{id}', [KasKeluarController::class, 'show'])->name('kasKeluarShow');
            Route::get('/edit/{id}', [KasKeluarController::class, 'edit'])->name('kasKeluarEdit');
            Route::post('/update/{id}', [KasKeluarController::class, 'update'])->name('kasKeluarUpdate');
            Route::get('/delete/{id}', [KasKeluarController::class, 'destroy'])->name('kasKeluarDelete');
        });
    });


    Route::group(['prefix' => 'laporan-rekapitulasi'], function () {

        Route::group(['prefix' => 'laporan-kas-masuk'], function () {

            Route::get('/', [LaporanKasMasukController::class, 'index'])->name('laporanKasMasuk');
            Route::get('/print', [LaporanKasMasukController::class, 'print'])->name('laporanKasMasukPrint');
        });


        Route::group(['prefix' => 'laporan-kas-keluar'], function () {

            Route::get('/', [LaporanKasKeluarController::class, 'index'])->name('laporanKasKeluar');
            Route::get('/print', [LaporanKasKeluarController::class, 'print'])->name('laporanKasKeluarPrint');
        });
    });
});
