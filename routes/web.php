<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FutamiController;
use App\Http\Controllers\ParameterPengujianController; //parameter pengujian
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MikrobiologiAirController;
use App\Http\Controllers\MikrobiologiProdukController;
use App\Http\Controllers\MikrobiologiProsesProduksiController;
use App\Http\Controllers\MikrobiologiProdukPercobaanController;
use App\Http\Controllers\MikrobiologiBahanBakuController;
use App\Http\Controllers\MikrobiologiBahanKemasController;
use App\Http\Controllers\MikrobiologiRuanganController;
use App\Http\Controllers\MikrobiologiPersonilController;
use App\Http\Controllers\MikrobiologiAlatMesinController;
use App\Http\Controllers\MikrobiologiKimiaSensoriController;
use App\Http\Controllers\LaporanAnalisaAirController;
use App\Models\ExportedFile;
use App\Http\Controllers\ExportedFileController;




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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('Guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'inputRegister'])->name('register.post');
});
Route::get('/', [LoginController::class, 'lending'])->name('lending');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//Route Profile
Route::middleware(['isLogin', 'cekRole:operator,staff,supervisor,qa_product_release'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/profile/{id}', [UserController::class, 'updateProfile'])->name('profile.post');
    Route::get('/profile/password_verify', [UserController::class, 'password_verify'])->name('password_verify');
    Route::post('/profile/password_verify', [UserController::class, 'verify'])->name('verify.post');
    Route::get('/profile/password', [UserController::class, 'password'])->name('password');
    Route::patch('/profile/update_password/{id}', [UserController::class, 'updatePassword'])->name('password.update');


});

Route::middleware(['isLogin', 'cekRole:superadmin'])->group(function () {
    Route::get('/superadmin/profile', [UserController::class, 'superadmin_profile'])->name('superadmin_profile');
    Route::patch('/superadmin/profile/{id}', [UserController::class, 'superadmin_updateProfile'])->name('superadmin_profile.post');
    Route::get('/superadmin/profile/password', [UserController::class, 'superadmin_password'])->name('superadmin_password');
    Route::patch('/superadmin/profile/update_password/{id}', [UserController::class, 'superadmin_updatePassword'])->name('superadmin_password.update');

});

//Route parameter pengujian
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Parameter Pengujian
    Route::get('/parameter_pengujian', [ParameterPengujianController::class, 'add'])->name('add');
    Route::post('/parameter_pengujian', [ParameterPengujianController::class, 'inputparameter'])->name('parameter.post');
    Route::delete('/parameter_pengujian/delete/{id}', [ParameterPengujianController::class, 'parameterDestroy'])->name('parameterDestroy'); //route untuk btn delete todo index
    Route::get('/parameter_pengujian/edit/{id}', [ParameterPengujianController::class, 'editParameter'])->name('editParameter');
    Route::patch('/parameter_pengujian/edit/{id}', [ParameterPengujianController::class, 'updateParameter'])->name('updateParameter');

    Route::post('/parameter_pengujian/satuan', [ParameterPengujianController::class, 'inputsatuan'])->name('satuan.post');
    Route::delete('/parameter_pengujian/satuan/delete/{id}', [ParameterPengujianController::class, 'satuanDestroy'])->name('satuanDestroy'); //route untuk btn delete todo index
    Route::get('/parameter_pengujian/satuan/edit/{id}', [ParameterPengujianController::class, 'editSatuan'])->name('editSatuan');
    Route::patch('/parameter_pengujian/satuan/edit/{id}', [ParameterPengujianController::class, 'updateSatuan'])->name('updateSatuan');

});

Route::middleware(['isLogin'])->group(function () {
    Route::get('/operator/analisakimia/exportExcel/{id}', [OperatorController::class, 'operator_analisakimia_exportExcel'])->name('operator_analisakimia_exportExcel');
});

Route::middleware(['isLogin', 'cekRole:operator'])->group(function () {
    //Route Operator
    Route::get('/operator', [OperatorController::class, 'operator'])->name('operator');
    Route::get('/operator/data', [OperatorController::class, 'data'])->name('data');
    Route::get('/operator/tambahdata', [OperatorController::class, 'tambahData'])->name('tambahData');
    Route::post('/operator/tambahdata', [OperatorController::class, 'inputData'])->name('data.post');
    Route::patch('/delete/{id}', [OperatorController::class, 'dataDestroy'])->name('delete'); //route untuk btn delete todo index

    // Route::get('/edit/{id}', [OperatorController::class, 'dataEdit'])->name('edit'); //untuk mengedit-> {id} untuk mengedit id yang dipilih
    // Route::patch('/update/{id}', [OperatorController::class, 'dataUpdate'])->name('update');
    Route::patch('/operatorttd/{id}', [OperatorController::class, 'operatorttd'])->name('operatorttd');
    Route::get('/operatoranalisakimia/pdf/{id}', [OperatorController::class, 'operator_analisakimiapdf'])->name('operator_analisakimiapdf');

    //Export Excel
    Route::get('/operatoranalisakimia/show_excel/{id}', [OperatorController::class, 'operator_analisakimia_excel_show'])->name('operator_analisakimia_excel_show');
    Route::get('/operatoranalisakimia/excel/{id}', [OperatorController::class, 'operator_analisakimia_excel'])->name('operator_analisakimia_excel');
    // Route::get('/operator/analisakimia/exportExcel/{id}', [OperatorController::class, 'operator_analisakimia_exportExcel'])->name('operator_analisakimia_exportExcel');


    Route::get('/operator/analisakimia', [OperatorController::class, 'data_analisa_kimia'])->name('data_analisa_kimia');
    Route::post('/operator/analisakimia', [OperatorController::class, 'input_data_analisa_kimia'])->name('data_analisa_kimia.post');
    Route::get('/operator/sampelanalisakimia/{id}', [OperatorController::class, 'sampel_analisa_kimia'])->name('sampel_analisa_kimia');
    Route::post('/operator/sampelanalisakimia/{id}', [OperatorController::class, 'input_sampel_analisa_kimia'])->name('sampel_analisa_kimia.post');

    Route::get('/operator/analisakimia/edit/{id}', [OperatorController::class, 'edit_data_analisa_kimia'])->name('edit_data_analisa_kimia');
    Route::patch('/operator/analisakimia/edit/{id}', [OperatorController::class, 'update_data_analisa_kimia'])->name('update_data_analisa_kimia');
    Route::get('/operator/analisakimia/sampel/{id}', [OperatorController::class, 'sampel'])->name('sampel');
    Route::delete('/operator/analisakimia/delete/{id}', [OperatorController::class, 'sampelDestroy'])->name('sampelDelete'); //route untuk btn delete todo index

    Route::get('/operator/analisakimia/history', [OperatorController::class, 'analisakimia_history'])->name('analisakimia_history');



});


// Route::middleware(['isLogin', 'cekRole:staff'])->group(function () {
//     //Route Staff
//     Route::get('/staff/mikrobiologi', [MikrobiologiAirController::class, 'staff_mikrobiologi'])->name('staff_mikrobiologi');
//     Route::patch('/staff/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staffttd'])->name('mikrobiologi_staffttd');
//     Route::patch('/staff/mikrobiologi/declinettd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staff_declinettd'])->name('mikrobiologi_staff_declinettd');
//     Route::get('/staff/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'staff_mikrobiologi_pdf'])->name('staff_mikrobiologi_pdf');

// });


//Staff Route
Route::middleware(['isLogin', 'cekRole:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'staff'])->name('staff');
    Route::get('/staff/data', [StaffController::class, 'datastaff'])->name('datastaff');
    Route::patch('/staffttd/{id}', [StaffController::class, 'staffttd'])->name('staffttd');
    Route::patch('/declinettd/{id}', [StaffController::class, 'declinettd'])->name('declinettd');
    Route::get('/staffanalisakimia/pdf/{id}', [StaffController::class, 'staff_analisakimiapdf'])->name('staff_analisakimiapdf');
    Route::get('/staff/analisakimia/history', [StaffController::class, 'staff_analisakimia_history'])->name('staff_analisakimia_history');

    //Export Excel
    Route::get('/staffanalisakimia/show_excel/{id}', [StaffController::class, 'staff_analisakimia_excel_show'])->name('staff_analisakimia_excel_show');
    Route::get('/staffanalisakimia/excel/{id}', [StaffController::class, 'staff_analisakimia_excel'])->name('staff_analisakimia_excel');
    Route::get('/staff/analisakimia/exportExcel/{id}', [StaffController::class, 'staff_analisakimia_exportExcel'])->name('staff_analisakimia_exportExcel');

});


//Route Supervisor
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->group(function () {
    Route::get('/supervisor', [SupervisorController::class, 'supervisor'])->name('supervisor');
    Route::get('/supervisor/data', [SupervisorController::class, 'datasupervisor'])->name('datasupervisor');
    Route::patch('/supervisorttd/{id}', [SupervisorController::class, 'supervisorttd'])->name('supervisorttd');
    Route::get('/supervisoranalisakimia/pdf/{id}', [SupervisorController::class, 'supervisor_analisakimiapdf'])->name('supervisor_analisakimiapdf');
    Route::get('/supervisor/analisakimia/history', [SupervisorController::class, 'supervisor_analisakimia_history'])->name('supervisor_analisakimia_history');

    //Export Excel
    Route::get('/supervisoranalisakimia/show_excel/{id}', [SupervisorController::class, 'supervisor_analisakimia_excel_show'])->name('supervisor_analisakimia_excel_show');
    Route::get('/supervisoranalisakimia/excel/{id}', [SupervisorController::class, 'supervisor_analisakimia_excel'])->name('supervisor_analisakimia_excel');
    // Route::get('/operator/analisakimia/exportExcel/{id}', [SupervisorController::class, 'operator_analisakimia_exportExcel'])->name('operator_analisakimia_exportExcel');
});


//Admin Route
Route::middleware(['isLogin', 'cekRole:superadmin'])->group(function () {
    Route::get('/admin', [SuperadminController::class, 'admin'])->name('admin');
    Route::get('/admin/role', [SuperadminController::class, 'role'])->name('role');
    Route::post('/admin/role', [SuperadminController::class, 'inputrole'])->name('inputrole');

    Route::get('/admin/adduser', [SuperadminController::class, 'adduser'])->name('adduser');
    Route::post('/admin/adduser', [SuperadminController::class, 'inputUser'])->name('user.post');
    Route::delete('/admin/adduser/delete/{id}', [SuperadminController::class, 'userDestroy'])->name('user.delete'); //route untuk btn delete todo index
    Route::patch('/admin/adduser/reset/{id}', [SuperadminController::class, 'userReset'])->name('user.reset'); //route untuk btn delete todo index

    Route::get('/admin/adduser/edit/{id}', [SuperadminController::class, 'userEdit'])->name('user.edit'); //untuk mengedit-> {id} untuk mengedit id yang dipilih
    Route::patch('/admin/adduser/update/{id}', [SuperadminController::class, 'userUpdate'])->name('user.update');
    Route::get('/admin/info', [SuperadminController::class, 'info'])->name('info');
    Route::get('/admin/analisakimia/pdf/{id}', [SuperadminController::class, 'superadmin_analisakimiapdf'])->name('superadmin_analisakimiapdf');
    Route::get('/admin/analisakimia/history', [SuperadminController::class, 'history'])->name('history');


    Route::get('/admin/adduser/search', [SuperadminController::class, 'search'])->name('search');
    // Route::get('/admin/adduser/user-status', [SuperadminController::class, 'getStatus'])->name('user.status');
    // Route::get('/check-active-user', [SuperadminController::class, 'isActiveUser'])->name('check-active-user');

    //Export Excel
    Route::get('/admin/analisakimia/show_excel/{id}', [SuperadminController::class, 'superadmin_analisakimia_excel_show'])->name('superadmin_analisakimia_excel_show');
    Route::get('/admin/analisakimia/excel/{id}', [SuperadminController::class, 'superadmin_analisakimia_excel'])->name('superadmin_analisakimia_excel');
    // Route::get('/operator/analisakimia/exportExcel/{id}', [SuperadminController::class, 'operator_analisakimia_exportExcel'])->name('operator_analisakimia_exportExcel');
});



// PROJECT Route mikrobiologi air
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_air/show_excel/{id}', [MikrobiologiAirController::class, 'mikrobiologi_air_excel_show'])->name('mikrobiologi_air_excel_show');
    Route::get('/mikrobiologi_air/excel/{id}', [MikrobiologiAirController::class, 'mikrobiologi_air_excel'])->name('mikrobiologi_air_excel');
    Route::get('mikrobiologi_air/exportExcel/{id}', [MikrobiologiAirController::class, 'mikrobiologi_air_exportExcel'])->name('mikrobiologi_air_exportExcel');
});

Route::middleware(['isLogin', 'cekRole:operator'])->group(function () {
    //Route Operator
    Route::get('/operator/mikrobiologi', [MikrobiologiAirController::class, 'mikrobiologi'])->name('mikrobiologi');
    Route::get('/operator/add_mikrobiologi', [MikrobiologiAirController::class, 'add_mikrobiologi'])->name('add_mikrobiologi');
    Route::post('/operator/add_mikrobiologi', [MikrobiologiAirController::class, 'input_mikrobiologi'])->name('mikrobiologi.post');
    Route::get('/operator/sampel_mikrobiologi/{id}', [MikrobiologiAirController::class, 'sampel_mikrobiologi'])->name('sampel_mikrobiologi');
    Route::post('/operator/sampel_mikrobiologi/{id}', [MikrobiologiAirController::class, 'input_sampel_mikrobiologi'])->name('sampel_mikrobiologi.post');
    Route::patch('/operator/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_operatorttd'])->name('mikrobiologi_operatorttd');
    Route::get('/operator/mikrobiologi/sampel/{id}', [MikrobiologiAirController::class, 'mikrobiologi_sampel'])->name('mikrobiologi_sampel');
    Route::get('/operator/mikrobiologi/edit/{id}', [MikrobiologiAirController::class, 'edit_mikrobiologi'])->name('edit_mikrobiologi');
    // Route::patch('/operator/mikrobiologi/edit/{id}', [MikrobiologiAirController::class, 'update_mikrobiologi_air'])->name('update_mikrobiologi_air');
    Route::patch('/operator/mikrobiologi_air/edit/{id}', [MikrobiologiAirController::class, 'update_mikrobiologi_air'])->name('update_mikrobiologi_air');


    Route::patch('/operator/mikrobiologi/Delete/{id}', [MikrobiologiAirController::class, 'mikrobiologi_Destroy'])->name('mikrobiologi_Delete'); //route untuk btn delete todo index
    Route::delete('/operator/mikrobiologi/sampelDelete/{id}', [MikrobiologiAirController::class, 'sampel_mikrobiologi_Destroy'])->name('sampel_mikrobiologi_Delete'); //route untuk btn delete todo index
    Route::get('/operator/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'operator_mikrobiologi_pdf'])->name('operator_mikrobiologi_pdf');
    Route::get('/operator/mikrobiologi/history', [MikrobiologiAirController::class, 'mikrobiologi_history'])->name('mikrobiologi_history');
    Route::post('/mikrobiologi/restore/{id}', [MikrobiologiAirController::class, 'restore'])->name('mikrobiologi_air.restore');
    Route::delete('/operator/mikrobiologi/delete/permanent/{id}', [MikrobiologiAirController::class, 'mikrobiologi_delete_permanent'])->name('mikrobiologi_air_delete_permanent');

});

Route::middleware(['isLogin', 'cekRole:operator,staff'])->group(function () {
    Route::get('/exported-files', function () {
        $files = ExportedFile::all();
        return view('exports.exported_files', compact('files'));
    })->name('exported.files');
    Route::get('/exported-files', [ExportedFileController::class, 'index'])->name('exported.files');
    Route::post('/exported-files/download', [ExportedFileController::class, 'downloadMultiple'])->name('exported.files.download');
});

Route::middleware(['isLogin', 'cekRole:staff'])->group(function () {
    // //Route Staff
    Route::get('/staff/mikrobiologi', [MikrobiologiAirController::class, 'staff_mikrobiologi'])->name('staff_mikrobiologi');
    Route::patch('/staff/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staffttd'])->name('mikrobiologi_staffttd');
    Route::patch('/staff/mikrobiologi/declinettd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_staff_declinettd'])->name('mikrobiologi_staff_declinettd');
    Route::get('/staff/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'staff_mikrobiologi_pdf'])->name('staff_mikrobiologi_pdf');

});

Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->group(function () {
    //Route Supervisor
    Route::get('/supervisor/mikrobiologi', [MikrobiologiAirController::class, 'supervisor_mikrobiologi'])->name('supervisor_mikrobiologi');
    Route::patch('/supervisor/mikrobiologi/ttd/{id}', [MikrobiologiAirController::class, 'mikrobiologi_supervisorttd'])->name('mikrobiologi_supervisorttd');
    Route::get('/supervisor/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'supervisor_mikrobiologi_pdf'])->name('supervisor_mikrobiologi_pdf');

});
Route::middleware(['isLogin', 'cekRole:superadmin'])->group(function () {
    //Route Superadmin
    Route::get('/superadmin/mikrobiologi/info', [MikrobiologiAirController::class, 'superadmin_mikrobiologi'])->name('superadmin_mikrobiologi');
    Route::get('/superadmin/mikrobiologi/sampel/{id}', [MikrobiologiAirController::class, 'superadmin_mikrobiologi_sampel'])->name('superadmin_mikrobiologi_sampel');
    Route::get('/superadmin/mikrobiologi/pdf/{id}', [MikrobiologiAirController::class, 'superadmin_mikrobiologi_pdf'])->name('superadmin_mikrobiologi_pdf');
    Route::get('/superadmin/mikrobiologi/history', [MikrobiologiAirController::class, 'superadmin_mikrobiologi_history'])->name('superadmin_mikrobiologi_history');

});


// PROJECT Route mikrobiologi Produksi
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_produk/show_excel/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_excel_show'])->name('mikrobiologi_produk_excel_show');
    Route::get('/mikrobiologi_produk/excel/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_excel'])->name('mikrobiologi_produk_excel');
    Route::get('mikrobiologi_produk/exportExcel/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_exportExcel'])->name('mikrobiologi_produk_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_produk', [MikrobiologiProdukController::class, 'mikrobiologi_produk'])->name('mikrobiologi_produk');
    Route::get('/add_mikrobiologi_produk', [MikrobiologiProdukController::class, 'add_mikrobiologi_produk'])->name('add_mikrobiologi_produk');
    Route::post('/add_mikrobiologi_produk', [MikrobiologiProdukController::class, 'input_mikrobiologi_produk'])->name('mikrobiologi_produk.post');
    Route::get('/sampel_mikrobiologi_produk/{id}', [MikrobiologiProdukController::class, 'sampel_mikrobiologi_produk'])->name('sampel_mikrobiologi_produk');
    Route::post('/sampel_mikrobiologi_produk/{id}', [MikrobiologiProdukController::class, 'input_sampel_mikrobiologi_produk'])->name('sampel_mikrobiologi_produk.post');
    Route::patch('/mikrobiologi_produk/ttd/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_operatorttd'])->name('mikrobiologi_produk_operatorttd');
    Route::patch('/mikrobiologi_produk/Delete/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_Destroy'])->name('mikrobiologi_produk_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_produk/history', [MikrobiologiProdukController::class, 'mikrobiologi_produk_history'])->name('mikrobiologi_produk_history');
    Route::get('/mikrobiologi_produk/sampel/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_sampel'])->name('mikrobiologi_produk_sampel');
    Route::delete('/mikrobiologi_produk/sampelDelete/{id}', [MikrobiologiProdukController::class, 'sampel_mikrobiologi_produk_Destroy'])->name('sampel_mikrobiologi_produk_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_produk/edit/{id}', [MikrobiologiProdukController::class, 'edit_mikrobiologi_produk'])->name('edit_mikrobiologi_produk');
    Route::patch('/mikrobiologi/edit/{id}', [MikrobiologiProdukController::class, 'update_mikrobiologi_produk'])->name('update_mikrobiologi_produk.post');
    Route::get('/mikrobiologi_produk/pdf/{id}', [MikrobiologiProdukController::class, 'OP_mikrobiologi_produk_pdf'])->name('OP_mikrobiologi_produk_pdf');
    Route::post('/operator/mikrobiologi/restore/{id}', [MikrobiologiProdukController::class, 'restore'])->name('mikrobiologi_produk.restore');
    Route::delete('/operator/mikrobiologi/delete/permanent/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_delete_permanent'])->name('mikrobiologi_produk_delete_permanent');



});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_produk', [MikrobiologiProdukController::class, 'staff_mikrobiologi_produk'])->name('staff_mikrobiologi_produk');
    Route::patch('/mikrobiologi_produk/ttd/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_staffttd'])->name('mikrobiologi_produk_staffttd');
    Route::patch('/mikrobiologi_produk/declinettd/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_declinettd'])->name('mikrobiologi_produk_declinettd');
    Route::get('/mikrobiologi_produk/pdf/{id}', [MikrobiologiProdukController::class, 'ST_mikrobiologi_produk_pdf'])->name('ST_mikrobiologi_produk_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_produk', [MikrobiologiProdukController::class, 'supervisor_mikrobiologi_produk'])->name('supervisor_mikrobiologi_produk');
    Route::patch('/mikrobiologi_produk/ttd/{id}', [MikrobiologiProdukController::class, 'mikrobiologi_produk_supervisorttd'])->name('mikrobiologi_produk_supervisorttd');
    Route::get('/mikrobiologi_produk/pdf/{id}', [MikrobiologiProdukController::class, 'SP_mikrobiologi_produk_pdf'])->name('SP_mikrobiologi_produk_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_produk/info', [MikrobiologiProdukController::class, 'superadmin_mikrobiologi_produk'])->name('superadmin_mikrobiologi_produk');
    Route::get('/mikrobiologi_produk/sampel/{id}', [MikrobiologiProdukController::class, 'superadmin_mikrobiologi_produk_sampel'])->name('superadmin_mikrobiologi_produk_sampel');
    Route::get('/mikrobiologi_produk/history', [MikrobiologiProdukController::class, 'superadmin_mikrobiologi_produk_history'])->name('superadmin_mikrobiologi_produk_history');
    Route::get('/mikrobiologi_produk/pdf/{id}', [MikrobiologiProdukController::class, 'SA_mikrobiologi_produk_pdf'])->name('SA_mikrobiologi_produk_pdf');

});








// PROJECT Route mikrobiologi Proses Produksi
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_proses_produksi/show_excel/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_excel_show'])->name('mikrobiologi_proses_produksi_excel_show');
    Route::get('/mikrobiologi_proses_produksi/excel/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_excel'])->name('mikrobiologi_proses_produksi_excel');
    Route::get('mikrobiologi_proses_produksi/exportExcel/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_exportExcel'])->name('mikrobiologi_proses_produksi_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_proses_produksi', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi'])->name('mikrobiologi_proses_produksi');
    Route::get('/add_mikrobiologi_proses_produksi', [MikrobiologiProsesProduksiController::class, 'add_mikrobiologi_proses_produksi'])->name('add_mikrobiologi_proses_produksi');
    Route::post('/add_mikrobiologi_proses_produksi', [MikrobiologiProsesProduksiController::class, 'input_mikrobiologi_proses_produksi'])->name('mikrobiologi_proses_produksi.post');
    Route::get('/sampel_mikrobiologi_proses_produksi/{id}', [MikrobiologiProsesProduksiController::class, 'sampel_mikrobiologi_proses_produksi'])->name('sampel_mikrobiologi_proses_produksi');
    Route::post('/sampel_mikrobiologi_proses_produksi/{id}', [MikrobiologiProsesProduksiController::class, 'input_sampel_mikrobiologi_proses_produksi'])->name('sampel_mikrobiologi_proses_produksi.post');
    Route::patch('/mikrobiologi_proses_produksi/ttd/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_operatorttd'])->name('mikrobiologi_proses_produksi_operatorttd');
    Route::patch('/mikrobiologi_proses_produksi/Delete/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_Destroy'])->name('mikrobiologi_proses_produksi_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_proses_produksi/history', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_history'])->name('mikrobiologi_proses_produksi_history');
    Route::post('/operator/mikrobiologi_proses_produksi/restore/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_restore'])->name('mikrobiologi_proses_produksi.restore');
    Route::delete('/operator/mikrobiologi_proses_produksi/delete/permanent/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_delete_permanent'])->name('mikrobiologi_proses_produksi_delete_permanent');

    //sampel delete ss id nya
    Route::get('/mikrobiologi_proses_produksi/sampel/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_sampel'])->name('mikrobiologi_proses_produksi_sampel');
    Route::delete('/mikrobiologi_proses_produksi/sampelDelete/{id}', [MikrobiologiProsesProduksiController::class, 'sampel_mikrobiologi_proses_produksi_Destroy'])->name('sampel_mikrobiologi_proses_produksi_Delete'); //route untuk btn delete todo index

    Route::get('/mikrobiologi_proses_produksi/edit/{id}', [MikrobiologiProsesProduksiController::class, 'edit_mikrobiologi_proses_produksi'])->name('edit_mikrobiologi_proses_produksi');
    Route::patch('/mikrobiologi_proses_produksi/edit/{id}', [MikrobiologiProsesProduksiController::class, 'update_mikrobiologi_proses_produksi'])->name('update_mikrobiologi_proses_produksi.post');
    Route::get('/mikrobiologi_proses_produksi/pdf/{id}', [MikrobiologiProsesProduksiController::class, 'OP_mikrobiologi_proses_produksi_pdf'])->name('OP_mikrobiologi_proses_produksi_pdf');
});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_proses_produksi', [MikrobiologiProsesProduksiController::class, 'staff_mikrobiologi_proses_produksi'])->name('staff_mikrobiologi_proses_produksi');
    Route::patch('/mikrobiologi_proses_produksi/ttd/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_staffttd'])->name('mikrobiologi_proses_produksi_staffttd');
    Route::patch('/mikrobiologi_proses_produksi/declinettd/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_declinettd'])->name('mikrobiologi_proses_produksi_declinettd');
    Route::get('/mikrobiologi_proses_produksi/pdf/{id}', [MikrobiologiProsesProduksiController::class, 'ST_mikrobiologi_proses_produksi_pdf'])->name('ST_mikrobiologi_proses_produksi_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_proses_produksi', [MikrobiologiProsesProduksiController::class, 'supervisor_mikrobiologi_proses_produksi'])->name('supervisor_mikrobiologi_proses_produksi');
    Route::patch('/mikrobiologi_proses_produksi/ttd/{id}', [MikrobiologiProsesProduksiController::class, 'mikrobiologi_proses_produksi_supervisorttd'])->name('mikrobiologi_proses_produksi_supervisorttd');
    Route::get('/mikrobiologi_proses_produksi/pdf/{id}', [MikrobiologiProsesProduksiController::class, 'SP_mikrobiologi_proses_produksi_pdf'])->name('SP_mikrobiologi_proses_produksi_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_proses_produksi/info', [MikrobiologiProsesProduksiController::class, 'superadmin_mikrobiologi_proses_produksi'])->name('superadmin_mikrobiologi_proses_produksi');
    Route::get('/mikrobiologi_proses_produksi/sampel/{id}', [MikrobiologiProsesProduksiController::class, 'superadmin_mikrobiologi_proses_produksi_sampel'])->name('superadmin_mikrobiologi_proses_produksi_sampel');
    Route::get('/mikrobiologi_proses_produksi/history', [MikrobiologiProsesProduksiController::class, 'superadmin_mikrobiologi_proses_produksi_history'])->name('superadmin_mikrobiologi_proses_produksi_history');
    Route::get('/mikrobiologi_proses_produksi/pdf/{id}', [MikrobiologiProsesProduksiController::class, 'SA_mikrobiologi_proses_produksi_pdf'])->name('SA_mikrobiologi_proses_produksi_pdf');

});







// PROJECT Route mikrobiologi Produk percobaan
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_produk_percobaan/show_excel/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_excel_show'])->name('mikrobiologi_produk_percobaan_excel_show');
    Route::get('/mikrobiologi_produk_percobaan/excel/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_excel'])->name('mikrobiologi_produk_percobaan_excel');
    Route::get('mikrobiologi_produk_percobaan/exportExcel/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_exportExcel'])->name('mikrobiologi_produk_percobaan_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_produk_percobaan', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan'])->name('mikrobiologi_produk_percobaan');
    Route::get('/add_mikrobiologi_produk_percobaan', [MikrobiologiProdukPercobaanController::class, 'add_mikrobiologi_produk_percobaan'])->name('add_mikrobiologi_produk_percobaan');
    Route::post('/add_mikrobiologi_produk_percobaan', [MikrobiologiProdukPercobaanController::class, 'input_mikrobiologi_produk_percobaan'])->name('mikrobiologi_produk_percobaan.post');
    Route::get('/sampel_mikrobiologi_produk_percobaan/{id}', [MikrobiologiProdukPercobaanController::class, 'sampel_mikrobiologi_produk_percobaan'])->name('sampel_mikrobiologi_produk_percobaan');
    Route::post('/sampel_mikrobiologi_produk_percobaan/{id}', [MikrobiologiProdukPercobaanController::class, 'input_sampel_mikrobiologi_produk_percobaan'])->name('sampel_mikrobiologi_produk_percobaan.post');
    Route::patch('/mikrobiologi_produk_percobaan/ttd/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_operatorttd'])->name('mikrobiologi_produk_percobaan_operatorttd');
    Route::patch('/mikrobiologi_produk_percobaan/Delete/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_Destroy'])->name('mikrobiologi_produk_percobaan_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_produk_percobaan/history', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_history'])->name('mikrobiologi_produk_percobaan_history');
    Route::get('/mikrobiologi_produk_percobaan/sampel/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_sampel'])->name('mikrobiologi_produk_percobaan_sampel');
    Route::delete('/mikrobiologi_produk_percobaan/sampelDelete/{id}', [MikrobiologiProdukPercobaanController::class, 'sampel_mikrobiologi_produk_percobaan_Destroy'])->name('sampel_mikrobiologi_produk_percobaan_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_produk_percobaan/edit/{id}', [MikrobiologiProdukPercobaanController::class, 'edit_mikrobiologi_produk_percobaan'])->name('edit_mikrobiologi_produk_percobaan');
    Route::patch('/mikrobiologi_produk_percobaan/edit/{id}', [MikrobiologiProdukPercobaanController::class, 'update_mikrobiologi_produk_percobaan'])->name('update_mikrobiologi_produk_percobaan.post');
    Route::get('/mikrobiologi_produk_percobaan/pdf/{id}', [MikrobiologiProdukPercobaanController::class, 'OP_mikrobiologi_produk_percobaan_pdf'])->name('OP_mikrobiologi_produk_percobaan_pdf');
    Route::post('/operator/mikrobiologi_produk_percobaan/restore/{id}', [MikrobiologiProdukPercobaanController::class, 'restore'])->name('mikrobiologi_produk_percobaan.restore');
    Route::delete('/operator/mikrobiologi_produk_percobaan/delete/permanent/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_delete_permanent'])->name('mikrobiologi_produk_percobaan_delete_permanent');


});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_produk_percobaan', [MikrobiologiProdukPercobaanController::class, 'staff_mikrobiologi_produk_percobaan'])->name('staff_mikrobiologi_produk_percobaan');
    Route::patch('/mikrobiologi_produk_percobaan/ttd/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_staffttd'])->name('mikrobiologi_produk_percobaan_staffttd');
    Route::patch('/mikrobiologi_produk_percobaan/declinettd/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_declinettd'])->name('mikrobiologi_produk_percobaan_declinettd');
    Route::get('/mikrobiologi_produk_percobaan/pdf/{id}', [MikrobiologiProdukPercobaanController::class, 'ST_mikrobiologi_produk_percobaan_pdf'])->name('ST_mikrobiologi_produk_percobaan_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_produk_percobaan', [MikrobiologiProdukPercobaanController::class, 'supervisor_mikrobiologi_produk_percobaan'])->name('supervisor_mikrobiologi_produk_percobaan');
    Route::patch('/mikrobiologi_produk_percobaan/ttd/{id}', [MikrobiologiProdukPercobaanController::class, 'mikrobiologi_produk_percobaan_supervisorttd'])->name('mikrobiologi_produk_percobaan_supervisorttd');
    Route::get('/mikrobiologi_produk_percobaan/pdf/{id}', [MikrobiologiProdukPercobaanController::class, 'SP_mikrobiologi_produk_percobaan_pdf'])->name('SP_mikrobiologi_produk_percobaan_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_produk_percobaan/info', [MikrobiologiProdukPercobaanController::class, 'superadmin_mikrobiologi_produk_percobaan'])->name('superadmin_mikrobiologi_produk_percobaan');
    Route::get('/mikrobiologi_produk_percobaan/sampel/{id}', [MikrobiologiProdukPercobaanController::class, 'superadmin_mikrobiologi_produk_percobaan_sampel'])->name('superadmin_mikrobiologi_produk_percobaan_sampel');
    Route::get('/mikrobiologi_produk_percobaan/history', [MikrobiologiProdukPercobaanController::class, 'superadmin_mikrobiologi_produk_percobaan_history'])->name('superadmin_mikrobiologi_produk_percobaan_history');
    Route::get('/mikrobiologi_produk_percobaan/pdf/{id}', [MikrobiologiProdukPercobaanController::class, 'SA_mikrobiologi_produk_percobaan_pdf'])->name('SA_mikrobiologi_produk_percobaan_pdf');

});







// PROJECT Route mikrobiologi Bahan Baku
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_bahan_baku/show_excel/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_excel_show'])->name('mikrobiologi_bahan_baku_excel_show');
    Route::get('/mikrobiologi_bahan_baku/excel/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_excel'])->name('mikrobiologi_bahan_baku_excel');
    Route::get('mikrobiologi_bahan_baku/exportExcel/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_exportExcel'])->name('mikrobiologi_bahan_baku_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_bahan_baku', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku'])->name('mikrobiologi_bahan_baku');
    Route::get('/add_mikrobiologi_bahan_baku', [MikrobiologiBahanBakuController::class, 'add_mikrobiologi_bahan_baku'])->name('add_mikrobiologi_bahan_baku');
    Route::post('/add_mikrobiologi_bahan_baku', [MikrobiologiBahanBakuController::class, 'input_mikrobiologi_bahan_baku'])->name('mikrobiologi_bahan_baku.post');
    Route::get('/sampel_mikrobiologi_bahan_baku/{id}', [MikrobiologiBahanBakuController::class, 'sampel_mikrobiologi_bahan_baku'])->name('sampel_mikrobiologi_bahan_baku');
    Route::post('/sampel_mikrobiologi_bahan_baku/{id}', [MikrobiologiBahanBakuController::class, 'input_sampel_mikrobiologi_bahan_baku'])->name('sampel_mikrobiologi_bahan_baku.post');
    Route::patch('/mikrobiologi_bahan_baku/ttd/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_operatorttd'])->name('mikrobiologi_bahan_baku_operatorttd');
    Route::patch('/mikrobiologi_bahan_baku/Delete/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_Destroy'])->name('mikrobiologi_bahan_baku_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_bahan_baku/history', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_history'])->name('mikrobiologi_bahan_baku_history');
    Route::get('/mikrobiologi_bahan_baku/sampel/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_sampel'])->name('mikrobiologi_bahan_baku_sampel');
    Route::delete('/mikrobiologi_bahan_baku/sampelDelete/{id}', [MikrobiologiBahanBakuController::class, 'sampel_mikrobiologi_bahan_baku_Destroy'])->name('sampel_mikrobiologi_bahan_baku_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_bahan_baku/edit/{id}', [MikrobiologiBahanBakuController::class, 'edit_mikrobiologi_bahan_baku'])->name('edit_mikrobiologi_bahan_baku');
    Route::patch('/mikrobiologi_bahan_baku/edit/{id}', [MikrobiologiBahanBakuController::class, 'update_mikrobiologi_bahan_baku'])->name('update_mikrobiologi_bahan_baku.post');
    Route::get('/mikrobiologi_bahan_baku/pdf/{id}', [MikrobiologiBahanBakuController::class, 'OP_mikrobiologi_bahan_baku_pdf'])->name('OP_mikrobiologi_bahan_baku_pdf');
    Route::post('/operator/mikrobiologi_bahan_baku/restore/{id}', [MikrobiologiBahanBakuController::class, 'restore'])->name('mikrobiologi_bahan_baku.restore');
    Route::delete('/operator/mikrobiologi_bahan_baku/delete/permanent/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_delete_permanent'])->name('mikrobiologi_bahan_baku_delete_permanent');

});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_bahan_baku', [MikrobiologiBahanBakuController::class, 'staff_mikrobiologi_bahan_baku'])->name('staff_mikrobiologi_bahan_baku');
    Route::patch('/mikrobiologi_bahan_baku/ttd/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_staffttd'])->name('mikrobiologi_bahan_baku_staffttd');
    Route::patch('/mikrobiologi_bahan_baku/declinettd/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_declinettd'])->name('mikrobiologi_bahan_baku_declinettd');
    Route::get('/mikrobiologi_bahan_baku/pdf/{id}', [MikrobiologiBahanBakuController::class, 'ST_mikrobiologi_bahan_baku_pdf'])->name('ST_mikrobiologi_bahan_baku_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_bahan_baku', [MikrobiologiBahanBakuController::class, 'supervisor_mikrobiologi_bahan_baku'])->name('supervisor_mikrobiologi_bahan_baku');
    Route::patch('/mikrobiologi_bahan_baku/ttd/{id}', [MikrobiologiBahanBakuController::class, 'mikrobiologi_bahan_baku_supervisorttd'])->name('mikrobiologi_bahan_baku_supervisorttd');
    Route::get('/mikrobiologi_bahan_baku/pdf/{id}', [MikrobiologiBahanBakuController::class, 'SP_mikrobiologi_bahan_baku_pdf'])->name('SP_mikrobiologi_bahan_baku_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_bahan_baku/info', [MikrobiologiBahanBakuController::class, 'superadmin_mikrobiologi_bahan_baku'])->name('superadmin_mikrobiologi_bahan_baku');
    Route::get('/mikrobiologi_bahan_baku/sampel/{id}', [MikrobiologiBahanBakuController::class, 'superadmin_mikrobiologi_bahan_baku_sampel'])->name('superadmin_mikrobiologi_bahan_baku_sampel');
    Route::get('/mikrobiologi_bahan_baku/history', [MikrobiologiBahanBakuController::class, 'superadmin_mikrobiologi_bahan_kemas_history'])->name('superadmin_mikrobiologi_bahan_baku_history');
    Route::get('/mikrobiologi_bahan_baku/pdf/{id}', [MikrobiologiBahanBakuController::class, 'SA_mikrobiologi_bahan_baku_pdf'])->name('SA_mikrobiologi_bahan_baku_pdf');

});










// PROJECT Route mikrobiologi Bahan Kemas
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_bahan_kemas/show_excel/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_excel_show'])->name('mikrobiologi_bahan_kemas_excel_show');
    Route::get('/mikrobiologi_bahan_kemas/excel/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_excel'])->name('mikrobiologi_bahan_kemas_excel');
    Route::get('mikrobiologi_bahan_kemas/exportExcel/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_exportExcel'])->name('mikrobiologi_bahan_kemas_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_bahan_kemas', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas'])->name('mikrobiologi_bahan_kemas');
    Route::get('/add_mikrobiologi_bahan_kemas', [MikrobiologiBahanKemasController::class, 'add_mikrobiologi_bahan_kemas'])->name('add_mikrobiologi_bahan_kemas');
    Route::post('/add_mikrobiologi_bahan_kemas', [MikrobiologiBahanKemasController::class, 'input_mikrobiologi_bahan_kemas'])->name('mikrobiologi_bahan_kemas.post');
    Route::get('/sampel_mikrobiologi_bahan_kemas/{id}', [MikrobiologiBahanKemasController::class, 'sampel_mikrobiologi_bahan_kemas'])->name('sampel_mikrobiologi_bahan_kemas');
    Route::post('/sampel_mikrobiologi_bahan_kemas/{id}', [MikrobiologiBahanKemasController::class, 'input_sampel_mikrobiologi_bahan_kemas'])->name('sampel_mikrobiologi_bahan_kemas.post');
    Route::patch('/mikrobiologi_bahan_kemas/ttd/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_operatorttd'])->name('mikrobiologi_bahan_kemas_operatorttd');
    Route::patch('/mikrobiologi_bahan_kemas/Delete/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_Destroy'])->name('mikrobiologi_bahan_kemas_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_bahan_kemas/history', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_history'])->name('mikrobiologi_bahan_kemas_history');
    Route::get('/mikrobiologi_bahan_kemas/sampel/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_sampel'])->name('mikrobiologi_bahan_kemas_sampel');
    Route::delete('/mikrobiologi_bahan_kemas/sampelDelete/{id}', [MikrobiologiBahanKemasController::class, 'sampel_mikrobiologi_bahan_kemas_Destroy'])->name('sampel_mikrobiologi_bahan_kemas_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_bahan_kemas/edit/{id}', [MikrobiologiBahanKemasController::class, 'edit_mikrobiologi_bahan_kemas'])->name('edit_mikrobiologi_bahan_kemas');
    Route::patch('/mikrobiologi_bahan_kemas/edit/{id}', [MikrobiologiBahanKemasController::class, 'update_mikrobiologi_bahan_kemas'])->name('update_mikrobiologi_bahan_kemas.post');
    Route::get('/mikrobiologi_bahan_kemas/pdf/{id}', [MikrobiologiBahanKemasController::class, 'OP_mikrobiologi_bahan_kemas_pdf'])->name('OP_mikrobiologi_bahan_kemas_pdf');
    Route::post('/operator/mikrobiologi_bahan_kemas/restore/{id}', [MikrobiologiBahanKemasController::class, 'restore'])->name('mikrobiologi_bahan_kemas.restore');
    Route::delete('/operator/mikrobiologi_bahan_kemas/delete/permanent/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_delete_permanent'])->name('mikrobiologi_bahan_kemas_delete_permanent');

});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_bahan_kemas', [MikrobiologiBahanKemasController::class, 'staff_mikrobiologi_bahan_kemas'])->name('staff_mikrobiologi_bahan_kemas');
    Route::patch('/mikrobiologi_bahan_kemas/ttd/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_staffttd'])->name('mikrobiologi_bahan_kemas_staffttd');
    Route::patch('/mikrobiologi_bahan_kemas/declinettd/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_declinettd'])->name('mikrobiologi_bahan_kemas_declinettd');
    Route::get('/mikrobiologi_bahan_kemas/pdf/{id}', [MikrobiologiBahanKemasController::class, 'ST_mikrobiologi_bahan_kemas_pdf'])->name('ST_mikrobiologi_bahan_kemas_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_bahan_kemas', [MikrobiologiBahanKemasController::class, 'supervisor_mikrobiologi_bahan_kemas'])->name('supervisor_mikrobiologi_bahan_kemas');
    Route::patch('/mikrobiologi_bahan_kemas/ttd/{id}', [MikrobiologiBahanKemasController::class, 'mikrobiologi_bahan_kemas_supervisorttd'])->name('mikrobiologi_bahan_kemas_supervisorttd');
    Route::get('/mikrobiologi_bahan_kemas/pdf/{id}', [MikrobiologiBahanKemasController::class, 'SP_mikrobiologi_bahan_kemas_pdf'])->name('SP_mikrobiologi_bahan_kemas_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_bahan_kemas/info', [MikrobiologiBahanKemasController::class, 'superadmin_mikrobiologi_bahan_kemas'])->name('superadmin_mikrobiologi_bahan_kemas');
    Route::get('/mikrobiologi_bahan_kemas/sampel/{id}', [MikrobiologiBahanKemasController::class, 'superadmin_mikrobiologi_bahan_kemas_sampel'])->name('superadmin_mikrobiologi_bahan_kemas_sampel');
    Route::get('/mikrobiologi_bahan_kemas/history', [MikrobiologiBahanKemasController::class, 'superadmin_mikrobiologi_bahan_kemas_history'])->name('superadmin_mikrobiologi_bahan_kemas_history');
    Route::get('/mikrobiologi_bahan_kemas/pdf/{id}', [MikrobiologiBahanKemasController::class, 'SA_mikrobiologi_bahan_kemas_pdf'])->name('SA_mikrobiologi_bahan_kemas_pdf');

});














// PROJECT Route mikrobiologi Ruangan
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_ruangan/show_excel/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_excel_show'])->name('mikrobiologi_ruangan_excel_show');
    Route::get('/mikrobiologi_ruangan/excel/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_excel'])->name('mikrobiologi_ruangan_excel');
    Route::get('mikrobiologi_ruangan/exportExcel/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_exportExcel'])->name('mikrobiologi_ruangan_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_ruangan', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan'])->name('mikrobiologi_ruangan');
    Route::get('/add_mikrobiologi_ruangan', [MikrobiologiRuanganController::class, 'add_mikrobiologi_ruangan'])->name('add_mikrobiologi_ruangan');
    Route::post('/add_mikrobiologi_ruangan', [MikrobiologiRuanganController::class, 'input_mikrobiologi_ruangan'])->name('mikrobiologi_ruangan.post');
    Route::get('/sampel_mikrobiologi_ruangan/{id}', [MikrobiologiRuanganController::class, 'sampel_mikrobiologi_ruangan'])->name('sampel_mikrobiologi_ruangan');
    Route::post('/sampel_mikrobiologi_ruangan/{id}', [MikrobiologiRuanganController::class, 'input_sampel_mikrobiologi_ruangan'])->name('sampel_mikrobiologi_ruangan.post');
    Route::patch('/mikrobiologi_ruangan/ttd/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_operatorttd'])->name('mikrobiologi_ruangan_operatorttd');
    Route::patch('/mikrobiologi_ruangan/Delete/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_Destroy'])->name('mikrobiologi_ruangan_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_ruangan/history', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_history'])->name('mikrobiologi_ruangan_history');
    Route::get('/mikrobiologi_ruangan/sampel/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_sampel'])->name('mikrobiologi_ruangan_sampel');
    Route::delete('/mikrobiologi_ruangan/sampelDelete/{id}', [MikrobiologiRuanganController::class, 'sampel_mikrobiologi_ruangan_Destroy'])->name('sampel_mikrobiologi_ruangan_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_ruangan/edit/{id}', [MikrobiologiRuanganController::class, 'edit_mikrobiologi_ruangan'])->name('edit_mikrobiologi_ruangan');
    Route::patch('/mikrobiologi_ruangan/edit/{id}', [MikrobiologiRuanganController::class, 'update_mikrobiologi_ruangan'])->name('update_mikrobiologi_ruangan.post');
    Route::get('/mikrobiologi_ruangan/pdf/{id}', [MikrobiologiRuanganController::class, 'OP_mikrobiologi_ruangan_pdf'])->name('OP_mikrobiologi_ruangan_pdf');
    Route::post('/operator/mikrobiologi_ruangan/restore/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_restore'])->name('mikrobiologi_ruangan.restore');
    Route::delete('/operator/mikrobiologi_ruangan/delete/permanent/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_delete_permanent'])->name('mikrobiologi_ruangan_delete_permanent');

});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_ruangan', [MikrobiologiRuanganController::class, 'staff_mikrobiologi_ruangan'])->name('staff_mikrobiologi_ruangan');
    Route::patch('/mikrobiologi_ruangan/ttd/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_staffttd'])->name('mikrobiologi_ruangan_staffttd');
    Route::patch('/mikrobiologi_ruangan/declinettd/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_declinettd'])->name('mikrobiologi_ruangan_declinettd');
    Route::get('/mikrobiologi_ruangan/pdf/{id}', [MikrobiologiRuanganController::class, 'ST_mikrobiologi_ruangan_pdf'])->name('ST_mikrobiologi_ruangan_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_ruangan', [MikrobiologiRuanganController::class, 'supervisor_mikrobiologi_ruangan'])->name('supervisor_mikrobiologi_ruangan');
    Route::patch('/mikrobiologi_ruangan/ttd/{id}', [MikrobiologiRuanganController::class, 'mikrobiologi_ruangan_supervisorttd'])->name('mikrobiologi_ruangan_supervisorttd');
    Route::get('/mikrobiologi_ruangan/pdf/{id}', [MikrobiologiRuanganController::class, 'SP_mikrobiologi_ruangan_pdf'])->name('SP_mikrobiologi_ruangan_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_ruangan/info', [MikrobiologiRuanganController::class, 'superadmin_mikrobiologi_ruangan'])->name('superadmin_mikrobiologi_ruangan');
    Route::get('/mikrobiologi_ruangan/sampel/{id}', [MikrobiologiRuanganController::class, 'superadmin_mikrobiologi_ruangan_sampel'])->name('superadmin_mikrobiologi_ruangan_sampel');
    Route::get('/mikrobiologi_ruangan/history', [MikrobiologiRuanganController::class, 'superadmin_mikrobiologi_ruangan_history'])->name('superadmin_mikrobiologi_ruangan_history');
    Route::get('/mikrobiologi_ruangan/pdf/{id}', [MikrobiologiRuanganController::class, 'SA_mikrobiologi_ruangan_pdf'])->name('SA_mikrobiologi_ruangan_pdf');

});









// PROJECT Route mikrobiologi Personil
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_personil/show_excel/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_excel_show'])->name('mikrobiologi_personil_excel_show');
    Route::get('/mikrobiologi_personil/excel/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_excel'])->name('mikrobiologi_personil_excel');
    Route::get('mikrobiologi_personil/exportExcel/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_exportExcel'])->name('mikrobiologi_personil_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_personil', [MikrobiologiPersonilController::class, 'mikrobiologi_personil'])->name('mikrobiologi_personil');
    Route::get('/add_mikrobiologi_personil', [MikrobiologiPersonilController::class, 'add_mikrobiologi_personil'])->name('add_mikrobiologi_personil');
    Route::post('/add_mikrobiologi_personil', [MikrobiologiPersonilController::class, 'input_mikrobiologi_personil'])->name('mikrobiologi_personil.post');
    Route::get('/sampel_mikrobiologi_personil/{id}', [MikrobiologiPersonilController::class, 'sampel_mikrobiologi_personil'])->name('sampel_mikrobiologi_personil');
    Route::post('/sampel_mikrobiologi_personil/{id}', [MikrobiologiPersonilController::class, 'input_sampel_mikrobiologi_personil'])->name('sampel_mikrobiologi_personil.post');
    Route::patch('/mikrobiologi_personil/ttd/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_operatorttd'])->name('mikrobiologi_personil_operatorttd');
    Route::patch('/mikrobiologi_personil/Delete/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_Destroy'])->name('mikrobiologi_personil_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_personil/history', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_history'])->name('mikrobiologi_personil_history');
    Route::get('/mikrobiologi_personil/sampel/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_sampel'])->name('mikrobiologi_personil_sampel');
    Route::delete('/mikrobiologi_personil/sampelDelete/{id}', [MikrobiologiPersonilController::class, 'sampel_mikrobiologi_personil_Destroy'])->name('sampel_mikrobiologi_personil_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_personil/edit/{id}', [MikrobiologiPersonilController::class, 'edit_mikrobiologi_personil'])->name('edit_mikrobiologi_personil');
    Route::patch('/mikrobiologi_personil/edit/{id}', [MikrobiologiPersonilController::class, 'update_mikrobiologi_personil'])->name('update_mikrobiologi_personil.post');
    Route::get('/mikrobiologi_personil/pdf/{id}', [MikrobiologiPersonilController::class, 'OP_mikrobiologi_personil_pdf'])->name('OP_mikrobiologi_personil_pdf');
    Route::post('/operator/mikrobiologi_personil/restore/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_restore'])->name('mikrobiologi_personil.restore');
    Route::delete('/operator/mikrobiologi_personil/delete/permanent/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_delete_permanent'])->name('mikrobiologi_personil_delete_permanent');

});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_personil', [MikrobiologiPersonilController::class, 'staff_mikrobiologi_personil'])->name('staff_mikrobiologi_personil');
    Route::patch('/mikrobiologi_personil/ttd/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_staffttd'])->name('mikrobiologi_personil_staffttd');
    Route::patch('/mikrobiologi_personil/declinettd/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_declinettd'])->name('mikrobiologi_personil_declinettd');
    Route::get('/mikrobiologi_personil/pdf/{id}', [MikrobiologiPersonilController::class, 'ST_mikrobiologi_personil_pdf'])->name('ST_mikrobiologi_personil_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_personil', [MikrobiologiPersonilController::class, 'supervisor_mikrobiologi_personil'])->name('supervisor_mikrobiologi_personil');
    Route::patch('/mikrobiologi_personil/ttd/{id}', [MikrobiologiPersonilController::class, 'mikrobiologi_personil_supervisorttd'])->name('mikrobiologi_personil_supervisorttd');
    Route::get('/mikrobiologi_personil/pdf/{id}', [MikrobiologiPersonilController::class, 'SP_mikrobiologi_personil_pdf'])->name('SP_mikrobiologi_personil_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_personil/info', [MikrobiologiPersonilController::class, 'superadmin_mikrobiologi_personil'])->name('superadmin_mikrobiologi_personil');
    Route::get('/mikrobiologi_personil/sampel/{id}', [MikrobiologiPersonilController::class, 'superadmin_mikrobiologi_personil_sampel'])->name('superadmin_mikrobiologi_personil_sampel');
    Route::get('/mikrobiologi_personil/history', [MikrobiologiPersonilController::class, 'superadmin_mikrobiologi_personil_history'])->name('superadmin_mikrobiologi_personil_history');
    Route::get('/mikrobiologi_personil/pdf/{id}', [MikrobiologiPersonilController::class, 'SA_mikrobiologi_personil_pdf'])->name('SA_mikrobiologi_personil_pdf');

});










// PROJECT Route mikrobiologi Alat Dan Mesin
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_alat_mesin/show_excel/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_excel_show'])->name('mikrobiologi_alat_mesin_excel_show');
    Route::get('/mikrobiologi_alat_mesin/excel/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_excel'])->name('mikrobiologi_alat_mesin_excel');
    Route::get('mikrobiologi_alat_mesin/exportExcel/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_exportExcel'])->name('mikrobiologi_alat_mesin_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_alat_mesin', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin'])->name('mikrobiologi_alat_mesin');
    Route::get('/add_mikrobiologi_alat_mesin', [MikrobiologiAlatMesinController::class, 'add_mikrobiologi_alat_mesin'])->name('add_mikrobiologi_alat_mesin');
    Route::post('/add_mikrobiologi_alat_mesin', [MikrobiologiAlatMesinController::class, 'input_mikrobiologi_alat_mesin'])->name('mikrobiologi_alat_mesin.post');
    Route::get('/sampel_mikrobiologi_alat_mesin/{id}', [MikrobiologiAlatMesinController::class, 'sampel_mikrobiologi_alat_mesin'])->name('sampel_mikrobiologi_alat_mesin');
    Route::post('/sampel_mikrobiologi_alat_mesin/{id}', [MikrobiologiAlatMesinController::class, 'input_sampel_mikrobiologi_alat_mesin'])->name('sampel_mikrobiologi_alat_mesin.post');
    Route::patch('/mikrobiologi_alat_mesin/ttd/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_operatorttd'])->name('mikrobiologi_alat_mesin_operatorttd');
    Route::patch('/mikrobiologi_alat_mesin/Delete/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_Destroy'])->name('mikrobiologi_alat_mesin_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_alat_mesin/history', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_history'])->name('mikrobiologi_alat_mesin_history');
    Route::get('/mikrobiologi_alat_mesin/sampel/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_sampel'])->name('mikrobiologi_alat_mesin_sampel');
    Route::delete('/mikrobiologi_alat_mesin/sampelDelete/{id}', [MikrobiologiAlatMesinController::class, 'sampel_mikrobiologi_alat_mesin_Destroy'])->name('sampel_mikrobiologi_alat_mesin_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_alat_mesin/edit/{id}', [MikrobiologiAlatMesinController::class, 'edit_mikrobiologi_alat_mesin'])->name('edit_mikrobiologi_alat_mesin');
    Route::patch('/mikrobiologi_alat_mesin/edit/{id}', [MikrobiologiAlatMesinController::class, 'update_mikrobiologi_alat_mesin'])->name('update_mikrobiologi_alat_mesin.post');
    Route::get('/mikrobiologi_alat_mesin/pdf/{id}', [MikrobiologiAlatMesinController::class, 'OP_mikrobiologi_alat_mesin_pdf'])->name('OP_mikrobiologi_alat_mesin_pdf');
    Route::post('/operator/mikrobiologi_alat_mesin/restore/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_restore'])->name('mikrobiologi_alat_mesin.restore');
    Route::delete('/operator/mikrobiologi_alat_mesin/delete/permanent/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_delete_permanent'])->name('mikrobiologi_alat_mesin_delete_permanent');

});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_alat_mesin', [MikrobiologiAlatMesinController::class, 'staff_mikrobiologi_alat_mesin'])->name('staff_mikrobiologi_alat_mesin');
    Route::patch('/mikrobiologi_alat_mesin/ttd/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_staffttd'])->name('mikrobiologi_alat_mesin_staffttd');
    Route::patch('/mikrobiologi_alat_mesin/declinettd/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_declinettd'])->name('mikrobiologi_alat_mesin_declinettd');
    Route::get('/mikrobiologi_alat_mesin/pdf/{id}', [MikrobiologiAlatMesinController::class, 'ST_mikrobiologi_alat_mesin_pdf'])->name('ST_mikrobiologi_alat_mesin_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_alat_mesin', [MikrobiologiAlatMesinController::class, 'supervisor_mikrobiologi_alat_mesin'])->name('supervisor_mikrobiologi_alat_mesin');
    Route::patch('/mikrobiologi_alat_mesin/ttd/{id}', [MikrobiologiAlatMesinController::class, 'mikrobiologi_alat_mesin_supervisorttd'])->name('mikrobiologi_alat_mesin_supervisorttd');
    Route::get('/mikrobiologi_alat_mesin/pdf/{id}', [MikrobiologiAlatMesinController::class, 'SP_mikrobiologi_alat_mesin_pdf'])->name('SP_mikrobiologi_alat_mesin_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_alat_mesin/info', [MikrobiologiAlatMesinController::class, 'superadmin_mikrobiologi_alat_mesin'])->name('superadmin_mikrobiologi_alat_mesin');
    Route::get('/mikrobiologi_alat_mesin/sampel/{id}', [MikrobiologiAlatMesinController::class, 'superadmin_mikrobiologi_alat_mesin_sampel'])->name('superadmin_mikrobiologi_alat_mesin_sampel');
    Route::get('/mikrobiologi_alat_mesin/history', [MikrobiologiAlatMesinController::class, 'superadmin_mikrobiologi_alat_mesin_history'])->name('superadmin_mikrobiologi_alat_mesin_history');
    Route::get('/mikrobiologi_alat_mesin/pdf/{id}', [MikrobiologiAlatMesinController::class, 'SA_mikrobiologi_alat_mesin_pdf'])->name('SA_mikrobiologi_alat_mesin_pdf');

});












// PROJECT Route mikrobiologi Kimia Dan Sensori
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/mikrobiologi_kimia_sensori/show_excel/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_excel_show'])->name('mikrobiologi_kimia_sensori_excel_show');
    Route::get('/mikrobiologi_kimia_sensori/excel/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_excel'])->name('mikrobiologi_kimia_sensori_excel');
    Route::get('mikrobiologi_kimia_sensori/exportExcel/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_exportExcel'])->name('mikrobiologi_kimia_sensori_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/mikrobiologi_kimia_sensori', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori'])->name('mikrobiologi_kimia_sensori');
    Route::get('/add_mikrobiologi_kimia_sensori', [MikrobiologiKimiaSensoriController::class, 'add_mikrobiologi_kimia_sensori'])->name('add_mikrobiologi_kimia_sensori');
    Route::post('/add_mikrobiologi_kimia_sensori', [MikrobiologiKimiaSensoriController::class, 'input_mikrobiologi_kimia_sensori'])->name('mikrobiologi_kimia_sensori.post');
    Route::get('/sampel_mikrobiologi_kimia_sensori/{id}', [MikrobiologiKimiaSensoriController::class, 'sampel_mikrobiologi_kimia_sensori'])->name('sampel_mikrobiologi_kimia_sensori');
    Route::post('/sampel_mikrobiologi_kimia_sensori/{id}', [MikrobiologiKimiaSensoriController::class, 'input_sampel_mikrobiologi_kimia_sensori'])->name('sampel_mikrobiologi_kimia_sensori.post');
    Route::patch('/mikrobiologi_kimia_sensori/ttd/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_operatorttd'])->name('mikrobiologi_kimia_sensori_operatorttd');
    Route::patch('/mikrobiologi_kimia_sensori/Delete/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_Destroy'])->name('mikrobiologi_kimia_sensori_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_kimia_sensori/history', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_history'])->name('mikrobiologi_kimia_sensori_history');
    Route::get('/mikrobiologi_kimia_sensori/sampel/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_sampel'])->name('mikrobiologi_kimia_sensori_sampel');
    Route::delete('/mikrobiologi_kimia_sensori/sampelDelete/{id}', [MikrobiologiKimiaSensoriController::class, 'sampel_mikrobiologi_kimia_sensori_Destroy'])->name('sampel_mikrobiologi_kimia_sensori_Delete'); //route untuk btn delete todo index
    Route::get('/mikrobiologi_kimia_sensori/edit/{id}', [MikrobiologiKimiaSensoriController::class, 'edit_mikrobiologi_kimia_sensori'])->name('edit_mikrobiologi_kimia_sensori');
    Route::patch('/mikrobiologi_kimia_sensori/edit/{id}', [MikrobiologiKimiaSensoriController::class, 'update_mikrobiologi_kimia_sensori'])->name('update_mikrobiologi_kimia_sensori.post');
    Route::get('/mikrobiologi_kimia_sensori/pdf/{id}', [MikrobiologiKimiaSensoriController::class, 'OP_mikrobiologi_kimia_sensori_pdf'])->name('OP_mikrobiologi_kimia_sensori_pdf');


});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/mikrobiologi_kimia_sensori', [MikrobiologiKimiaSensoriController::class, 'staff_mikrobiologi_kimia_sensori'])->name('staff_mikrobiologi_kimia_sensori');
    Route::patch('/mikrobiologi_kimia_sensori/ttd/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_staffttd'])->name('mikrobiologi_kimia_sensori_staffttd');
    Route::patch('/mikrobiologi_kimia_sensori/declinettd/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_declinettd'])->name('mikrobiologi_kimia_sensori_declinettd');
    Route::get('/mikrobiologi_kimia_sensori/pdf/{id}', [MikrobiologiKimiaSensoriController::class, 'ST_mikrobiologi_kimia_sensori_pdf'])->name('ST_mikrobiologi_kimia_sensori_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/mikrobiologi_kimia_sensori', [MikrobiologiKimiaSensoriController::class, 'supervisor_mikrobiologi_kimia_sensori'])->name('supervisor_mikrobiologi_kimia_sensori');
    Route::patch('/mikrobiologi_kimia_sensori/ttd/{id}', [MikrobiologiKimiaSensoriController::class, 'mikrobiologi_kimia_sensori_supervisorttd'])->name('mikrobiologi_kimia_sensori_supervisorttd');
    Route::get('/mikrobiologi_kimia_sensori/pdf/{id}', [MikrobiologiKimiaSensoriController::class, 'SP_mikrobiologi_kimia_sensori_pdf'])->name('SP_mikrobiologi_kimia_sensori_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/mikrobiologi_kimia_sensori/info', [MikrobiologiKimiaSensoriController::class, 'superadmin_mikrobiologi_kimia_sensori'])->name('superadmin_mikrobiologi_kimia_sensori');
    Route::get('/mikrobiologi_kimia_sensori/sampel/{id}', [MikrobiologiKimiaSensoriController::class, 'superadmin_mikrobiologi_kimia_sensori_sampel'])->name('superadmin_mikrobiologi_kimia_sensori_sampel');
    Route::get('/mikrobiologi_kimia_sensori/history', [MikrobiologiKimiaSensoriController::class, 'superadmin_mikrobiologi_kimia_sensori_history'])->name('superadmin_mikrobiologi_kimia_sensori_history');
    Route::get('/mikrobiologi_kimia_sensori/pdf/{id}', [MikrobiologiKimiaSensoriController::class, 'SA_mikrobiologi_kimia_sensori_pdf'])->name('SA_mikrobiologi_kimia_sensori_pdf');

});








//Project route Laporan Analisa Air
Route::middleware(['isLogin'])->group(function () {
    //Export Excel
    Route::get('/laporan_analisa_air/show_excel/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_excel_show'])->name('laporan_analisa_air_excel_show');
    Route::get('/laporan_analisa_air/excel/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_excel'])->name('laporan_analisa_air_excel');
    Route::get('laporan_analisa_air/exportExcel/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_exportExcel'])->name('laporan_analisa_air_exportExcel');
});
Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->group(function () {
    //Route Operator
    Route::get('/laporan_analisa_air', [LaporanAnalisaAirController::class, 'laporan_analisa_air'])->name('laporan_analisa_air');
    Route::get('/add_laporan_analisa_air', [LaporanAnalisaAirController::class, 'add_laporan_analisa_air'])->name('add_laporan_analisa_air');
    Route::post('/add_laporan_analisa_air', [LaporanAnalisaAirController::class, 'input_laporan_analisa_air'])->name('laporan_analisa_air.post');
    Route::get('/sampel_laporan_analisa_air/{id}', [LaporanAnalisaAirController::class, 'sampel_laporan_analisa_air'])->name('sampel_laporan_analisa_air');
    Route::get('/sampel_laporan_analisa_air/{id}/{sampel_id}', [LaporanAnalisaAirController::class, 'option_sampel_laporan_analisa_air'])->name('option_sampel_laporan_analisa_air.post');
    Route::post('/sampel_laporan_analisa_air/{id}/{sampel_id}', [LaporanAnalisaAirController::class, 'input_sampel_laporan_analisa_air'])->name('sampel_laporan_analisa_air.post');
    Route::patch('/laporan_analisa_air/ttd/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_operatorttd'])->name('laporan_analisa_air_operatorttd');
    Route::patch('/laporan_analisa_air/Delete/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_Destroy'])->name('laporan_analisa_air_Delete');
    Route::get('/laporan_analisa_air/history', [LaporanAnalisaAirController::class, 'laporan_analisa_air_history'])->name('laporan_analisa_air_history');
    Route::patch('/laporan_analisa_air/restore/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_restore'])->name('laporan_analisa_air_restore');
    Route::delete('/laporan_analisa_air/delete_permanent/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_delete_permanent'])->name('laporan_analisa_air_delete_permanent');

    Route::get('/laporan_analisa_air/sampel/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_sampel'])->name('laporan_analisa_air_sampel');
    Route::get('/laporan_analisa_air/sampel/{id}/{sampel_id}', [LaporanAnalisaAirController::class, 'show_laporan_analisa_air_sampel'])->name('show_laporan_analisa_air_sampel');
    Route::delete('/laporan_analisa_air/sampelDelete/{id}/{sampel_id}/{pengujian_id}', [LaporanAnalisaAirController::class, 'show_sampel_laporan_analisa_air_Delete'])->name('show_sampel_laporan_analisa_air_Delete');

    Route::get('/laporan_analisa_air/edit/{id}', [LaporanAnalisaAirController::class, 'edit_laporan_analisa_air'])->name('edit_laporan_analisa_air');
    Route::get('/laporan_analisa_air/edit/{id}/{sampel_id}', [LaporanAnalisaAirController::class, 'edit_sampel_laporan_analisa_air'])->name('edit_sampel_laporan_analisa_air');
    Route::patch('/laporan_analisa_air/update/{id}/{sampel_id}', [LaporanAnalisaAirController::class, 'update_laporan_analisa_air'])->name('update_laporan_analisa_air.post');
    Route::get('/laporan_analisa_air/pdf/{id}', [LaporanAnalisaAirController::class, 'OP_laporan_analisa_air_pdf'])->name('OP_laporan_analisa_air_pdf');
});
Route::middleware(['isLogin', 'cekRole:staff'])->prefix('/staff')->group(function () {
    //Route Staff
    Route::get('/laporan_analisa_air', [LaporanAnalisaAirController::class, 'staff_laporan_analisa_air'])->name('staff_laporan_analisa_air');
    Route::patch('/laporan_analisa_air/ttd/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_staffttd'])->name('laporan_analisa_air_staffttd');
    Route::patch('/laporan_analisa_air/declinettd/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_declinettd'])->name('laporan_analisa_air_declinettd');
    Route::get('/laporan_analisa_air/pdf/{id}', [LaporanAnalisaAirController::class, 'ST_laporan_analisa_air_pdf'])->name('ST_laporan_analisa_air_pdf');

});
Route::middleware(['isLogin', 'cekRole:supervisor,qa_product_release'])->prefix('/supervisor')->group(function () {
    //Route Supervisor
    Route::get('/laporan_analisa_air', [LaporanAnalisaAirController::class, 'supervisor_laporan_analisa_air'])->name('supervisor_laporan_analisa_air');
    Route::patch('/laporan_analisa_air/ttd/{id}', [LaporanAnalisaAirController::class, 'laporan_analisa_air_supervisorttd'])->name('laporan_analisa_air_supervisorttd');
    Route::get('/laporan_analisa_air/pdf/{id}', [LaporanAnalisaAirController::class, 'SP_laporan_analisa_air_pdf'])->name('SP_laporan_analisa_air_pdf');


});
Route::middleware(['isLogin', 'cekRole:superadmin'])->prefix('/superadmin')->group(function () {
    //Route Superadmin
    Route::get('/laporan_analisa_air/info', [LaporanAnalisaAirController::class, 'superadmin_laporan_analisa_air'])->name('superadmin_laporan_analisa_air');
    Route::get('/laporan_analisa_air/sampel/{id}', [LaporanAnalisaAirController::class, 'superadmin_laporan_analisa_air_sampel'])->name('superadmin_laporan_analisa_air_sampel');
    Route::get('/laporan_analisa_air/sampel/{id}/{sampel_id}', [LaporanAnalisaAirController::class, 'superadmin_laporan_analisa_air_sampelShow'])->name('superadmin_laporan_analisa_air_sampelShow');

    Route::get('/laporan_analisa_air/history', [LaporanAnalisaAirController::class, 'superadmin_laporan_analisa_air_history'])->name('superadmin_laporan_analisa_air_history');
    Route::get('/laporan_analisa_air/pdf/{id}', [LaporanAnalisaAirController::class, 'SA_laporan_analisa_air_pdf'])->name('SA_laporan_analisa_air_pdf');
});
















// Route::get('/adhaodhaohd', function () {
//     return view('welcome');
// });


