<?php

use Illuminate\Support\Facades\Route;

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
// REPORT ROUTE
Route::get('/report/download-authorization', [App\Http\Controllers\ReportController::class, 'downloadAuthorization'])->middleware(['auth'])->name('authorization_download');
Route::get('/report/download-authorization', [App\Http\Controllers\ReportController::class, 'downloadStatus'])->middleware(['auth'])->name('status_download');
Route::get('/report/download-authorization', [App\Http\Controllers\ReportController::class, 'downloadAccountability'])->middleware(['auth'])->name('accountability_download');

//DASHBOARD ROUTE
Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/download', [App\Http\Controllers\DashboardController::class, 'download'])->middleware(['auth'])->name('dash_download');

//MEMBERS ROUTES
Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->middleware(['auth'])->name('member');
Route::get('/member/ecm', [App\Http\Controllers\MemberController::class, 'ecmMembers'])->middleware(['auth'])->name('ecm-member');
Route::get('/member/deleted', [App\Http\Controllers\MemberController::class, 'deletedMemberList'])->middleware(['auth'])->name('deleted-member');
Route::get('/member/new', [App\Http\Controllers\MemberController::class, 'newMember'])->middleware(['auth'])->name('new-member');
Route::post('/member/create', [App\Http\Controllers\MemberController::class, 'persistMember'])->middleware('auth')->name('create-member');
Route::post('/member/search', [App\Http\Controllers\MemberController::class, 'search'])->middleware('auth')->name('search-member');
Route::get('/member/compile', [App\Http\Controllers\MemberController::class, 'compile'])->middleware('auth')->name('compile-select');
Route::put('/member/edit/{id}', [App\Http\Controllers\MemberController::class, 'editMember'])->middleware('auth')->name('edit-member');
Route::get('/member/detail/{id}', [App\Http\Controllers\MemberController::class, 'memberDetail'])->middleware(['auth'])->name('member-detail');
Route::get('/member/scheda/{id}', [App\Http\Controllers\MemberController::class, 'createScheda'])->middleware(['auth'])->name('member-scheda');
Route::get('/member/bolletino/{id}', [App\Http\Controllers\MemberController::class, 'createBolletino'])->middleware(['auth'])->name('member-bolletino');
Route::get('/member/delete/{id}', [App\Http\Controllers\MemberController::class, 'deleteMember'])->middleware(['auth'])->name('member-delete');
Route::post('/member/hard-delete/{id}', [App\Http\Controllers\MemberController::class, 'hardDeleteMember'])->middleware(['auth'])->name('member-hard-delete');
Route::post('/member/restore/{id}', [App\Http\Controllers\MemberController::class, 'restoreMember'])->middleware(['auth'])->name('member-restore');
Route::get('/member/export', [App\Http\Controllers\MemberController::class, 'export'])->middleware(['auth'])->name('members-export');
Route::post('/member/quotas', [App\Http\Controllers\MemberController::class, 'addQuotas'])->middleware(['auth'])->name('add-quotas');
Route::post('/member/cf', [App\Http\Controllers\MemberController::class, 'calculateCF'])->middleware(['auth'])->name('calculate-cf');
Route::post('/member/city-detail', [App\Http\Controllers\MemberController::class, 'selectCityDetail'])->middleware(['auth'])->name('select-city-detail');

//QUOTAS ROUTES
Route::get('/quota/list', [App\Http\Controllers\QuotaController::class, 'list'])->middleware(['auth'])->name('quota-list');
Route::post('/quota/send', [App\Http\Controllers\QuotaController::class, 'send'])->middleware(['auth'])->name('send-quota');
Route::post('/quota/add', [App\Http\Controllers\QuotaController::class, 'store'])->middleware(['auth'])->name('add-quota');
Route::post('/quota/delete', [App\Http\Controllers\QuotaController::class, 'delete'])->middleware(['auth'])->name('delete-quota');
Route::post('/quota/send/attachments', [App\Http\Controllers\QuotaController::class, 'sendEmail'])->middleware(['auth'])->name('send-quota-attachments');

//PAYMENTS ROUTES
Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'index'])->middleware(['auth'])->name('members-payment');
Route::get('/payment/history', [App\Http\Controllers\PaymentController::class, 'history'])->middleware(['auth'])->name('payment-history');
Route::get('/payment/add/year', [App\Http\Controllers\PaymentController::class, 'newYear'])->middleware(['auth'])->name('new-year-payments');
Route::get('/test', [App\Http\Controllers\PaymentController::class, 'test'])->middleware(['auth'])->name('test');
Route::get('/payment/detail/{id}', [App\Http\Controllers\PaymentController::class, 'detail'])->middleware(['auth'])->name('payment-detail');
Route::get('/payment/list/{id}', [App\Http\Controllers\PaymentController::class, 'list'])->middleware(['auth'])->name('payment-list');
Route::post('/payment/add', [App\Http\Controllers\PaymentController::class, 'add'])->middleware(['auth'])->name('add-payment');
Route::post('/payment/delete', [App\Http\Controllers\PaymentController::class, 'delete'])->middleware(['auth'])->name('payment-delete');
Route::get('/payment/receipts/{id}', [App\Http\Controllers\PaymentController::class, 'download'])->middleware(['auth'])->name('download-receipt');
Route::get('/payment/receipts/delete/{id}', [App\Http\Controllers\PaymentController::class, 'deleteReceipt'])->middleware(['auth'])->name('delete-receipt');
Route::post('/receipt/send/', [App\Http\Controllers\PaymentController::class, 'send'])->middleware(['auth'])->name('send-receipt');

//RECEIPTS ROUTES
Route::get('/receipts', [App\Http\Controllers\ReceiptController::class, 'index'])->middleware(['auth'])->name('receipts-list');
Route::get('/receipt/delete/{id}', [App\Http\Controllers\ReceiptController::class, 'delete'])->middleware(['auth'])->name('delete-receipt-list');

//COURSES ROUTES
Route::get('/course/list', [App\Http\Controllers\CourseController::class, 'index'])->middleware(['auth'])->name('course-list');
Route::get('/course/new', [App\Http\Controllers\CourseController::class, 'new'])->middleware(['auth'])->name('new-course');
Route::post('/course/add', [App\Http\Controllers\CourseController::class, 'store'])->middleware(['auth'])->name('add-course');
Route::post('/course/search', [App\Http\Controllers\CourseController::class, 'search'])->middleware(['auth'])->name('add-course');
Route::put('/course/edit/{id}', [App\Http\Controllers\CourseController::class, 'edit'])->middleware(['auth'])->name('edit-course');
Route::post('/course/sponsor/add', [App\Http\Controllers\CourseController::class, 'addSponsor'])->middleware(['auth'])->name('add-course-sponsor');
Route::get('/course/detail/{id}', [App\Http\Controllers\CourseController::class, 'detail'])->middleware(['auth'])->name('course-detail');
Route::get('/course/course-detail/{id}', [App\Http\Controllers\CourseController::class, 'detailPage'])->middleware(['auth'])->name('course-detail-page');
Route::delete('/course/delete/sponsor/', [App\Http\Controllers\CourseController::class, 'deleteSponsor'])->middleware(['auth'])->name('delete-course-sponsor');
Route::delete('/course/delete/', [App\Http\Controllers\CourseController::class, 'delete'])->middleware(['auth'])->name('delete-course');
Route::get('/course/export/{id}', [App\Http\Controllers\CourseController::class, 'export'])->middleware(['auth'])->name('course-export');
Route::get('/course/export-total/{id}', [App\Http\Controllers\CourseController::class, 'exportTotal'])->middleware(['auth'])->name('course-export-total');
Route::get('/course/export-no-credits/{id}', [App\Http\Controllers\CourseController::class, 'exportNoCredits'])->middleware(['auth'])->name('course-export-no-credits');
Route::get('/course/compile', [App\Http\Controllers\CourseController::class, 'compile'])->middleware('auth')->name('compile-course');
Route::get('/course/certificate/generate/{id}', [App\Http\Controllers\CourseController::class, 'certificate'])->middleware('auth')->name('course-certificate');
Route::get('/course/test', [App\Http\Controllers\CourseController::class, 'test'])->middleware(['auth'])->name('test-attestati');
Route::get('/course/certificate/{id}', [App\Http\Controllers\CourseController::class, 'certificateDetail'])->middleware(['auth'])->name('course-certificates-list');
Route::post('/course/converter', [App\Http\Controllers\CourseController::class, 'convertToLetter'])->middleware(['auth'])->name('text-converter');
Route::delete('/certificate/delete/', [App\Http\Controllers\CourseController::class, 'deleteCertificate'])->middleware(['auth'])->name('delete-certificate');
Route::get('/certificate/download/{id}', [App\Http\Controllers\CourseController::class, 'download'])->middleware(['auth'])->name('download-certificate');
Route::post('/certificate/send/', [App\Http\Controllers\CourseController::class, 'send'])->middleware(['auth'])->name('send-certificate');
Route::post('/massive-send-certificates', [App\Http\Controllers\CourseController::class, 'massiveSend'])->middleware(['auth'])->name('massive-send-certificates');

//COMPANIES ROUTES
Route::get('/companies/add', [App\Http\Controllers\CourseController::class, 'index'])->middleware(['auth'])->name('add-company');
Route::get('/companies/', [App\Http\Controllers\CompanyController::class, 'index'])->middleware(['auth'])->name('companies-list');
Route::get('/companies/detail/{id}', [App\Http\Controllers\CompanyController::class, 'detail'])->middleware(['auth'])->name('company-detail');
Route::get('/companies/add', [App\Http\Controllers\CompanyController::class, 'new'])->middleware(['auth'])->name('company-new');
Route::post('/companies/store', [App\Http\Controllers\CompanyController::class, 'store'])->middleware(['auth'])->name('company-store');
Route::put('/companies/edit/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->middleware(['auth'])->name('edit-company');
Route::delete('/companies/delete/{id}', [App\Http\Controllers\CompanyController::class, 'delete'])->middleware(['auth'])->name('company-delete');

//FREQUENCIES ROUTES
Route::post('/frequency/add/', [App\Http\Controllers\FrequencyController::class, 'store'])->middleware(['auth'])->name('add-frequency');
Route::get('/frequency/detail/{id}', [App\Http\Controllers\FrequencyController::class, 'detail'])->middleware(['auth'])->name('frequency-detail');
Route::post('/frequency/delete', [App\Http\Controllers\FrequencyController::class, 'delete'])->middleware(['auth'])->name('frequency-delete');

//DISCIPLINES ROUTES
Route::post('/discipline/add/', [App\Http\Controllers\DisciplineController::class, 'store'])->middleware(['auth'])->name('add-discipline');
Route::post('/discipline/delete/', [App\Http\Controllers\DisciplineController::class, 'delete'])->middleware(['auth'])->name('delete-discipline');

//STUDY GROUP ROUTES
Route::post('/study-group/add/', [App\Http\Controllers\StudyGroupController::class, 'store'])->middleware(['auth'])->name('add-study-group');
Route::post('/study-group/delete/', [App\Http\Controllers\StudyGroupController::class, 'delete'])->middleware(['auth'])->name('delete-study-group');
Route::post('/study-group/settings/add/', [App\Http\Controllers\StudyGroupController::class, 'addSetting'])->middleware(['auth'])->name('add-setting-study-group');
Route::post('/study-group/settings/delete/', [App\Http\Controllers\StudyGroupController::class, 'deleteSetting'])->middleware(['auth'])->name('delete-setting-study-group');

//Committee ROUTES
Route::post('/committee/add/', [App\Http\Controllers\CommitteeController::class, 'store'])->middleware(['auth'])->name('add-study-group');
Route::post('/committee/delete/', [App\Http\Controllers\CommitteeController::class, 'delete'])->middleware(['auth'])->name('delete-study-group');

//REGION ROUTES
Route::post('/region/add/', [App\Http\Controllers\RegionController::class, 'add'])->middleware(['auth'])->name('add-region');
Route::post('/region/delete/', [App\Http\Controllers\RegionController::class, 'delete'])->middleware(['auth'])->name('delete-region');

//SETTINGS ROUTES
Route::get('/settings/', [App\Http\Controllers\SettingsController::class, 'index'])->middleware(['auth'])->name('settings');
Route::get('/settings/adduser', [App\Http\Controllers\SettingsController::class, 'adduser'])->middleware(['auth'])->name('add-user');
Route::get('/settings/smtp', [App\Http\Controllers\SettingsController::class, 'smtp'])->middleware(['auth'])->name('smtp');

//EMAIL ROUTES
Route::post('/email/test', [App\Http\Controllers\EmailController::class, 'testSmtp'])->middleware(['auth'])->name('send-test-email');

//ROLE ROUTES
Route::post('/role/add/', [App\Http\Controllers\RoleController::class, 'addToUser'])->middleware(['auth'])->name('add-role');

//USER ROUTES
Route::post('/user/add/', [App\Http\Controllers\UserController::class, 'add'])->middleware(['auth'])->name('add-user');

//ACTIVITY LOG ROUTES
Route::get('/activity/', [App\Http\Controllers\ActivityLogController::class, 'index'])->middleware(['auth'])->name('activity');

//REPORT ROUTES
Route::get('/report/', [App\Http\Controllers\ReportController::class, 'index'])->middleware(['auth'])->name('report');

require __DIR__.'/auth.php';
