<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudExampleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\UserManagementController;
use App\Http\Middleware\ViewShare;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth',
    ViewShare::class,
])->group(function () {

    # DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    # SETTINGS
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    # PROFILE
    Route::get('profiles', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profiles', [ProfileController::class, 'update']);
    Route::put('profiles/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    # DATATABLE
    Route::view('datatable', 'datatable.index')->name('datatable.index');

    # FORM
    Route::view('form', 'form.index')->name('form.index');

    # USER MANAGEMENT
        Route::prefix('user-management')->as('user-management.')->group(function () {
        Route::resource('users', UserManagementController::class);
        Route::resource('roles', RoleController::class);
    });

    #produk
        Route::get('produks/import-excel-example', [\App\Http\Controllers\ProdukController::class, 'importExcelExample'])->name('produks.import-excel-example');
        Route::post('produks/import-excel', [\App\Http\Controllers\ProdukController::class, 'importExcel'])->name('produks.import-excel');
        Route::resource('produks', \App\Http\Controllers\ProdukController::class);
    #Kategori Produk
        Route::get('kategoris/import-excel-example', [\App\Http\Controllers\KategoriController::class, 'importExcelExample'])->name('kategoris.import-excel-example');
        Route::post('kategoris/import-excel', [\App\Http\Controllers\KategoriController::class, 'importExcel'])->name('kategoris.import-excel');
        Route::resource('kategoris', \App\Http\Controllers\KategoriController::class);
    #SATUAN PRODUK
        Route::get('satuans/import-excel-example', [\App\Http\Controllers\SatuanController::class, 'importExcelExample'])->name('satuans.import-excel-example');
        Route::post('satuans/import-excel', [\App\Http\Controllers\SatuanController::class, 'importExcel'])->name('satuans.import-excel');  
        Route::resource('satuans', \App\Http\Controllers\SatuanController::class);
        #METODE PEMBAYARAN
        Route::get('metodes/import-excel-example', [\App\Http\Controllers\MetodeController::class, 'importExcelExample'])->name('metodes.import-excel-example');
        Route::post('metodes/import-excel', [\App\Http\Controllers\MetodeController::class, 'importExcel'])->name('metodes.import-excel');
        Route::resource('metodes', \App\Http\Controllers\MetodeController::class);
        #ARMADA
            Route::get('armadas/import-excel-example', [\App\Http\Controllers\ArmadaController::class, 'importExcelExample'])->name('armadas.import-excel-example');
            Route::post('armadas/import-excel', [\App\Http\Controllers\ArmadaController::class, 'importExcel'])->name('armadas.import-excel');
            Route::resource('armadas', \App\Http\Controllers\ArmadaController::class);
    #Pembeli
        Route::get('pembelis/import-excel-example', [\App\Http\Controllers\PembeliController::class, 'importExcelExample'])->name('customers.import-excel-example');
        Route::post('pembelis/import-excel', [\App\Http\Controllers\PembeliController::class, 'importExcel'])->name('customers.import-excel');
        Route::get('pembelis/address', [\App\Http\Controllers\PembeliController::class, 'address'])->name('customers.address');
        Route::resource('pembelis', \App\Http\Controllers\PembeliController::class);
        Route::get('pembelis/maps/{id}', [\App\Http\Controllers\PembeliController::class, 'maps'])->name('pembelis.maps');
    #Permintaan Produk
        Route::get('permintaans/import-excel-example', [\App\Http\Controllers\PermintaanController::class, 'importExcelExample'])->name('permintaans.import-excel-example');
        Route::post('permintaans/import-excel', [\App\Http\Controllers\PermintaanController::class, 'importExcel'])->name('permintaans.import-excel');
        Route::resource('permintaans', \App\Http\Controllers\PermintaanController::class);
        
    # CONTOH CRUD
        Route::get('crud-examples/import-excel-example', [CrudExampleController::class, 'importExcelExample'])->name('crud-examples.import-excel-example');
        Route::post('crud-examples/import-excel', [CrudExampleController::class, 'importExcel'])->name('crud-examples.import-excel');
        Route::resource('crud-examples', CrudExampleController::class);

        Route::get('mahasiswas/import-excel-example', [\App\Http\Controllers\MahasiswaController::class, 'importExcelExample'])->name('mahasiswas.import-excel-example');
        Route::post('mahasiswas/import-excel', [\App\Http\Controllers\MahasiswaController::class, 'importExcel'])->name('mahasiswas.import-excel');
        Route::resource('mahasiswas', \App\Http\Controllers\MahasiswaController::class);

        Route::get('testing/datatable', [TestingController::class, 'datatable']);
        Route::get('testing/send-email', [TestingController::class, 'sendEmail']);
        Route::get('testing/modal', [TestingController::class, 'modal']);
});
    Route::get('/', [AuthController::class, 'loginForm'])->name('login');
    Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('verification', [AuthController::class, 'verificationForm'])->name('verification');
    Route::post('verification', [AuthController::class, 'verification']);
    Route::get('verify/{token}', [AuthController::class, 'verify'])->name('verify');
    Route::get('register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
    Route::get('forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgot-password');
    Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
    Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('reset-password');
    Route::post('reset-password/{token}', [AuthController::class, 'resetPassword']);
});
Route::get('pembelis/get-address', [\App\Http\Controllers\PembeliController::class, 'addressGet'])->name('pembelis.get-address');

