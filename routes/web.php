<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LockScreen;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\ExpenseReportsController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TrainersController;
use App\Http\Controllers\TrainingTypeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PersonalInformationController;


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

/** for side bar menu active */
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();

// ----------------------------- main dashboard ------------------------------//
Route::get('/home', [HomeController::class, 'index'])->name('home');

// -----------------------------settings----------------------------------------//
Route::middleware('admin')->group(function () {
    Route::get('roles/permissions/page', [SettingController::class, 'rolesPermissions'])->name('roles/permissions/page');
    Route::post('roles/permissions/save', [SettingController::class, 'addRecord'])->name('roles/permissions/save');
    Route::post('roles/permissions/update', [SettingController::class, 'editRolesPermissions'])->name('roles/permissions/update');
    Route::post('roles/permissions/delete', [SettingController::class, 'deleteRolesPermissions'])->name('roles/permissions/delete');
});
// -----------------------------login----------------------------------------//
Route::middleware('web')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ----------------------------- lock screen --------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('lock_screen', [LockScreen::class, 'lockScreen'])->name('lock_screen');
    Route::post('unlock', [LockScreen::class, 'unlock'])->name('unlock');
});

// ------------------------------ register ---------------------------------//
// Route::controller(RegisterController::class)->group(function () {
//     Route::get('/register', 'register')->name('register');
//     Route::post('/register','storeUser')->name('register');    
// });

// ----------------------------- forget password ----------------------------//
    Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget-password');
    Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget-password');

// ----------------------------- reset password -----------------------------//
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword']);
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword']);

// ----------------------------- user profile ------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('profile_user', [UserManagementController::class, 'profile'])->name('profile_user');
    Route::post('profile/information/save', [UserManagementController::class, 'profileInformation'])->name('profile/information/save');
});

// ----------------------------- user userManagement -----------------------//
Route::get('userManagement', [UserManagementController::class, 'index'])->middleware('admin')->name('userManagement');
Route::post('user/add/save', [UserManagementController::class, 'addNewUserSave'])->middleware('admin')->name('user/add/save');
Route::post('search/user/list', [UserManagementController::class, 'searchUser'])->name('search/user/list');
Route::post('update', [UserManagementController::class, 'update'])->name('update');
Route::post('user/delete', [UserManagementController::class, 'delete'])->middleware('admin')->name('user/delete');
Route::get('activity/log', [UserManagementController::class, 'activityLog'])->middleware('admin')->name('activity/log');
Route::get('activity/login/logout', [UserManagementController::class, 'activityLogInLogOut'])->middleware('auth')->name('activity/login/logout');

// ----------------------------- search user management ------------------------------//
Route::post('search/user/list', [UserManagementController::class, 'searchUser'])->name('search/user/list');

// ----------------------------- form change password ------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('change/password', [UserManagementController::class, 'changePasswordView'])->name('change/password');
    Route::post('change/password/db', [UserManagementController::class, 'changePasswordDB'])->name('change/password/db');
});


 
// ----------------------------- form employee ------------------------------//
Route::get('all/employee/card', [EmployeeController::class, 'cardAllEmployee'])->name('all/employee/card');
Route::get('all/employee/list', [EmployeeController::class, 'listAllEmployee'])->name('all/employee/list');
Route::post('all/employee/save', [EmployeeController::class, 'saveRecord'])->middleware('admin')->name('all/employee/save');
Route::get('all/employee/view/edit/{employee_id}', [EmployeeController::class, 'viewRecord'])->middleware('admin');
Route::post('all/employee/update', [EmployeeController::class, 'updateRecord'])->middleware('admin')->name('all/employee/update');
Route::get('all/employee/delete/{employee_id}', [EmployeeController::class, 'deleteRecord'])->middleware('admin');
Route::post('all/employee/search', [EmployeeController::class, 'employeeSearch'])->name('all/employee/search');
Route::post('all/employee/list/search', [EmployeeController::class, 'employeeListSearch'])->name('all/employee/list/search');

Route::get('form/departments/page', [EmployeeController::class, 'index'])->middleware('auth')->name('form/departments/page');
Route::post('form/departments/save', [EmployeeController::class, 'saveRecordDepartment'])->middleware('admin')->name('form/departments/save');
Route::post('form/department/update', [EmployeeController::class, 'updateRecordDepartment'])->middleware('admin')->name('form/department/update');
Route::post('form/department/delete', [EmployeeController::class, 'deleteRecordDepartment'])->middleware('admin')->name('form/department/delete');

// ----------------------------- profile employee ------------------------------//
Route::get('employee/profile/{user_id}', [EmployeeController::class, 'profileEmployee'])->middleware('admin');

// ----------------------------- form holiday ------------------------------//
    Route::get('form/holidays/new', [HolidayController::class, 'holiday'])->middleware('auth')->name('form/holidays/new');
    Route::post('form/holidays/save', [HolidayController::class, 'saveRecord'])->middleware('admin')->name('form/holidays/save');
    Route::post('form/holidays/update', [HolidayController::class, 'updateRecord'])->middleware('admin')->name('form/holidays/update');

// ----------------------------- form leaves ------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('form/leaves/new', [LeavesController::class, 'leaves'])->name('form/leaves/new');
    Route::post('form/leaves/save', [LeavesController::class, 'saveRecord'])->name('form/leaves/save');
    Route::post('form/leaves/edit', [LeavesController::class, 'editRecordLeave'])->name('form/leaves/edit');
    Route::post('form/leaves/edit/delete', [LeavesController::class, 'deleteLeave'])->name('form/leaves/edit/delete');
});

// ----------------------------- form attendance  ------------------------------//
Route::middleware('admin')->group(function () {
    Route::post('/leave/approve/{id}', [LeavesController::class, 'approve'])->name('leave.approve');
    Route::post('/leave/decline/{id}', [LeavesController::class, 'decline'])->name('leave.decline');
    Route::post('/leave/pending/{id}', [LeavesController::class, 'pending'])->name('leave.pending');
});

// ----------------------------- form payroll  ------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('form/salary/page', [PayrollController::class, 'salary'])->name('form/salary/page');
    Route::get('form/salary/view/{user_id}', [PayrollController::class, 'salaryView']);
    Route::get('form/payroll/items', [PayrollController::class, 'payrollItems'])->name('form/payroll/items');
});

Route::middleware('admin')->group(function () {
    Route::post('form/salary/save', [PayrollController::class, 'saveRecord'])->name('form/salary/save');
    Route::post('form/salary/update', [PayrollController::class, 'updateRecord'])->name('form/salary/update');
    Route::post('form/salary/delete', [PayrollController::class, 'deleteRecord'])->name('form/salary/delete');
});

// ----------------------------- reports  ------------------------------//

Route::get('form/leave/reports/page', [ExpenseReportsController::class, 'leaveReport'])->middleware('auth')->name('form/leave/reports/page');

// ----------------------------- performance  ------------------------------//
Route::middleware('auth')->group(function () {
    Route::get('form/performance/indicator/page', [PerformanceController::class, 'index'])->name('form/performance/indicator/page');
    Route::get('form/performance/appraisal/page', [PerformanceController::class, 'performanceAppraisal'])->name('form/performance/appraisal/page');
});

Route::middleware('admin')->group(function () {
    Route::post('form/performance/indicator/save', [PerformanceController::class, 'saveRecordIndicator'])->name('form/performance/indicator/save');
    Route::post('form/performance/indicator/delete', [PerformanceController::class, 'deleteIndicator'])->name('form/performance/indicator/delete');
    Route::post('form/performance/indicator/update', [PerformanceController::class, 'updateIndicator'])->name('form/performance/indicator/update');
    Route::post('form/performance/appraisal/save', [PerformanceController::class, 'saveRecordAppraisal'])->name('form/performance/appraisal/save');
    Route::post('form/performance/appraisal/update', [PerformanceController::class, 'updateAppraisal'])->name('form/performance/appraisal/update');
    Route::post('form/performance/appraisal/delete', [PerformanceController::class, 'deleteAppraisal'])->name('form/performance/appraisal/delete');
});

// ----------------------------- training  ------------------------------//
Route::get('form/training/list/page', [TrainingController::class, 'index'])->middleware('auth')->name('form/training/list/page');
Route::middleware('admin')->group(function () {
    Route::post('form/training/save', [TrainingController::class, 'addNewTraining'])->name('form/training/save');
    Route::post('form/training/delete', [TrainingController::class, 'deleteTraining'])->name('form/training/delete');
    Route::post('form/training/update', [TrainingController::class, 'updateTraining'])->name('form/training/update');
});

// ----------------------------- trainers  ------------------------------//
Route::get('form/trainers/list/page', [TrainersController::class, 'index'])->middleware('auth')->name('form/trainers/list/page');

Route::middleware('admin')->group(function () {
    Route::post('form/trainers/save', [TrainersController::class, 'saveRecord'])->name('form/trainers/save');
    Route::post('form/trainers/update', [TrainersController::class, 'updateRecord'])->name('form/trainers/update');
    Route::post('form/trainers/delete', [TrainersController::class, 'deleteRecord'])->name('form/trainers/delete');
});

// ----------------------------- training type  ------------------------------//
Route::get('form/training/type/list/page', [TrainingTypeController::class, 'index'])->middleware('auth')->name('form/training/type/list/page');
Route::middleware('admin')->group(function () {
    Route::post('form/training/type/save', [TrainingTypeController::class, 'saveRecord'])->name('form/training/type/save');
    Route::post('form/training/type/update', [TrainingTypeController::class, 'updateRecord'])->name('form/training/type/update');
    Route::post('form/training/type/delete', [TrainingTypeController::class, 'deleteTrainingType'])->name('form/training/type/delete');
});

// ----------------------------- sales  ------------------------------//

Route::middleware('auth')->group(function () {
    // -------------------- estimate  -------------------//
    Route::get('form/estimates/page', [SalesController::class, 'estimatesIndex'])->name('form/estimates/page');
    Route::get('estimate/view/{estimate_number}', [SalesController::class, 'viewEstimateIndex'])->name('estimate/view/{estimate_number}');

    // ---------------------- payments  ---------------//
    Route::get('payments', [SalesController::class, 'Payments'])->name('payments');
    Route::get('expenses/page', [SalesController::class, 'Expenses'])->name('expenses/page');
    // ---------------------- search   ---------------//
    Route::get('expenses/search', [SalesController::class, 'searchRecord'])->name('expenses/search');
    Route::post('expenses/search', [SalesController::class, 'searchRecord'])->name('expenses/search');

});

Route::middleware('admin')->group(function () {
    // -------------------- estimate  -------------------//
    Route::get('create/estimate/page', [SalesController::class, 'createEstimateIndex'])->name('create/estimate/page');
    Route::get('edit/estimate/{estimate_number}', [SalesController::class, 'editEstimateIndex']);
    Route::post('create/estimate/save', [SalesController::class, 'createEstimateSaveRecord'])->name('create/estimate/save');
    Route::post('create/estimate/update', [SalesController::class, 'EstimateUpdateRecord'])->name('create/estimate/update');
    Route::post('estimate_add/delete', [SalesController::class, 'EstimateAddDeleteRecord'])->name('estimate_add/delete');
    Route::post('estimate/delete', [SalesController::class, 'EstimateDeleteRecord'])->name('estimate/delete');

    // ---------------------- payments  ---------------//
    Route::post('expenses/save', [SalesController::class, 'saveRecord'])->name('expenses/save');
    Route::post('expenses/update', [SalesController::class, 'updateRecord'])->name('expenses/update');
    Route::post('expenses/delete', [SalesController::class, 'deleteRecord'])->name('expenses/delete');
});

// ----------------------------- training type  ------------------------------//
    Route::post('user/information/save', [PersonalInformationController::class, 'saveRecord'])->middleware('auth')->name('user/information/save');



