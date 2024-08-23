<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacilitatorController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\DormitoryController;
use App\Http\Controllers\CanteenController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\FacilityPictureController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\WelcomeController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', [WelcomeController::class, 'welcome']);

Route::resource('registration', RegistrationController::class);
Route::get('studentRegistration', [StudentController::class, 'create']);
Route::get('facilitatorRegistration', [FacilitatorController::class, 'create']);
Route::resource('facilitator', FacilitatorController::class);

Auth::routes();

Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
    Route::resource('user', UserController::class);

    //user
    Route::get('/fetchDormitory', [DormitoryController::class, 'fetchDormitory']);
    Route::get('/viewDormitory/{id}', [DormitoryController::class, 'viewDormitory']);
    Route::get('/fetchInformationForViewDormitory/{id}', [DormitoryController::class, 'fetchInformationForViewDormitory']);
    Route::get('/fetchCanteen', [CanteenController::class, 'fetchCanteen']);
    Route::get('/viewCanteen/{id}', [CanteenController::class, 'viewCanteen']);

    //filter
    Route::get('/fetch1starCanteen', [CanteenController::class, 'fetch1starCanteen']);
    Route::get('/fetch2starCanteen', [CanteenController::class, 'fetch2starCanteen']);
    Route::get('/fetch3starCanteen', [CanteenController::class, 'fetch3starCanteen']);
    Route::get('/fetch4starCanteen', [CanteenController::class, 'fetch4starCanteen']);
    Route::get('/fetch5starCanteen', [CanteenController::class, 'fetch5starCanteen']);
    Route::get('/fetchCanteenDateAscending', [CanteenController::class, 'fetchCanteenDateAscending']);
    Route::get('/fetchCanteenDateDescending', [CanteenController::class, 'fetchCanteenDateDescending']);
    Route::post('/searchCanteen', [CanteenController::class, 'searchCanteen']);

    Route::get('/fetch1starDormitory', [DormitoryController::class, 'fetch1starDormitory']);
    Route::get('/fetch2starDormitory', [DormitoryController::class, 'fetch2starDormitory']);
    Route::get('/fetch3starDormitory', [DormitoryController::class, 'fetch3starDormitory']);
    Route::get('/fetch4starDormitory', [DormitoryController::class, 'fetch4starDormitory']);
    Route::get('/fetch5starDormitory', [DormitoryController::class, 'fetch5starDormitory']);
    Route::get('/fetchDormitoryDateAscending', [DormitoryController::class, 'fetchDormitoryDateAscending']);
    Route::get('/fetchDormitoryDateDescending', [DormitoryController::class, 'fetchDormitoryDateDescending']);
    Route::post('/searchDormitory', [DormitoryController::class, 'searchDormitory']);

    Route::resource('facility', FacilityController::class);
    Route::get('/fetchFacilities', [FacilityController::class, 'fetchFacilities']);
    Route::get('/viewFacility/{id}', [FacilityController::class, 'viewFacility']);
    
    Route::resource('comment', CommentController::class);
    Route::get('/fetchComments/{id}', [CommentController::class, 'fetchComments']);

    Route::resource('rate', RateController::class);
    Route::get('/fetchRates/{id}', [RateController::class, 'fetchRates']);

    Route::resource('reply', ReplyController::class);
    Route::get('/fetchReply/{id}', [ReplyController::class, 'fetchReply']);
    Route::delete('/deleteReply/{id}', [ReplyController::class, 'delete']);

    Route::get('/fetchReplyforComment/{id}', [ReplyController::class, 'fetchReplyforComment']);
    Route::post('/submitReply', [ReplyController::class, 'submitReply']);
    

    Route::get('/fetchFacilityPicture/{id}', [FacilityPictureController::class, 'fetchFacilityPicture']);

    Route::resource('dormitory', DormitoryController::class);
    Route::resource('canteen', CanteenController::class);

    Route::resource('notification', NotificationController::class);
    Route::get('/fetchNotifications', [NotificationController::class, 'fetchNotifications']);
    Route::get('/viewNotification/{id}', [NotificationController::class, 'viewNotification']);

    Route::resource('account', AccountController::class);
    Route::get('/fetchOwnedAccount', [AccountController::class, 'fetchOwnedAccount']);

    Route::post('/updateProfilePicture', [ProfileController::class, 'updateProfilePicture']);
    Route::post('/updateId', [ProfileController::class, 'updateId']);
    Route::post('/updateProfileInfo', [ProfileController::class, 'updateProfileInfo']);
});

Route::group(['middleware'=>['auth', 'role:facilitator']], function(){
    Route::resource('canteen', CanteenController::class);

    Route::get('/fetchOwnedFacilities', [FacilityController::class, 'fetchOwnedFacilities']);
    Route::delete('/deleteFacility/{id}', [FacilityController::class, 'destroy']);
    Route::get('/view/facility/{id}', [FacilityController::class, 'viewOwnedFacility']);
    Route::get('/fetchOwnedFacility/{id}', [FacilityController::class, 'fetchOwnedFacility']);
    Route::get('/editFacilityInfo/{id}', [FacilityController::class, 'editFacilityInfo']);
    Route::put('/updateFacilityInfo/{id}', [FacilityController::class, 'updateFacilityInfo']);
    Route::put('/updateFacilityPicture/{id}', [FacilityController::class, 'updateFacilityPicture']);

    Route::resource('feature', FeatureController::class);
    Route::get('/fetchFeatures/{id}', [FeatureController::class, 'fetchFeatures']);
    Route::post('/deleteFeature', [FeatureController::class, 'delete']);
    
    Route::post('/deleteComment', [CommentController::class, 'deleteComment']);

    Route::resource('facilityPicture', FacilityPictureController::class);
    Route::get('/deleteFacilityPicture/{id}', [FacilityPictureController::class, 'delete']);
    Route::post('/destroyFacilityPicture', [FacilityPictureController::class, 'destroy']);

    Route::resource('certificate', CertificateController::class);
    Route::get('/editCertificate/{id}', [CertificateController::class, 'editCertificate']);
    Route::post('/updateCertificate', [CertificateController::class, 'updateCertificate']);
    Route::post('/deleteReply', [ReplyController::class, 'destroyReply']);
});

Route::group(['middleware'=>['auth', 'role:admin']], function(){
     Route::resource('facilitators', FacilitatorController::class);
     Route::get('fetchFacilitators', [FacilitatorController::class, 'fetchFacilitators']);
     Route::get('/viewFacilitator/{id}', [FacilitatorController::class, 'facilitator']);
     Route::get('/fetchFacilitator/{id}', [FacilitatorController::class, 'fetchFacilitator']);

    Route::post('/updateAccountStatus', [AccountController::class, 'updateStatus']);
    Route::post('/declineAccount', [AccountController::class, 'declineAccount']);
    Route::post('/blockAccount', [AccountController::class, 'blockAccount']);
    Route::post('/approveAccount', [AccountController::class, 'approveAccount']);
    Route::get('/viewAccount/{id}', [AccountController::class, 'viewAccount']);


    Route::post('/searchAccount', [AccountController::class, 'search']);

    Route::post('/fetchPendingAccount', [AccountController::class, 'fetchPending']);
    Route::post('/fetchDeclinedAccount', [AccountController::class, 'fetchDeclined']);
    Route::post('/fetchApprovedAccount', [AccountController::class, 'fetchApproved']);
    Route::post('/fetchBlockedAccount', [AccountController::class, 'fetchBlocked']);
    Route::post('/fetchAllAccount', [AccountController::class, 'fetchAll']);

    Route::resource('students', StudentController::class);
    Route::get('/viewStudent/{id}', [StudentController::class, 'student']);

    Route::resource('dormitories', DormitoryController::class);
    Route::resource('canteens', CanteenController::class);

    Route::get('/fetchAllFacilities/{facilityType}', [FacilityController::class, 'fetchAllFacilities']);
    Route::get('/fetchPendingFacilities/{facilityType}', [FacilityController::class, 'fetchPendingFacilities']);
    Route::get('/fetchApprovedFacilities/{facilityType}', [FacilityController::class, 'fetchApprovedFacilities']);
    Route::get('/fetchDeclinedFacilities/{facilityType}', [FacilityController::class, 'fetchDeclinedFacilities']);
    Route::get('/fetchBlockedFacilities/{facilityType}', [FacilityController::class, 'fetchBlockedFacilities']);

    Route::get('/fetch5starFacilities/{facilityType}', [FacilityController::class, 'fetch5starFacilities']);
    Route::get('/fetch4starFacilities/{facilityType}', [FacilityController::class, 'fetch4starFacilities']);
    Route::get('/fetch3starFacilities/{facilityType}', [FacilityController::class, 'fetch3starFacilities']);
    Route::get('/fetch2starFacilities/{facilityType}', [FacilityController::class, 'fetch2starFacilities']);
    Route::get('/fetch1starFacilities/{facilityType}', [FacilityController::class, 'fetch1starFacilities']);

    Route::get('/fetchFacilitiesDateAscending/{facilityType}', [FacilityController::class, 'fetchFacilitiesDateAscending']);

    Route::post('/searchFacility', [FacilityController::class, 'searchFacility']);

    Route::get('/viewFacility/{id}', [FacilityController::class, 'viewFacilityById']);

    Route::get('/fetchFacilityById/{id}', [FacilityController::class, 'fetchFacilityById']);
    Route::put('/updateFacilityStatus/{id}', [FacilityController::class, 'updateFacilityStatus']);
    Route::post('/declineFacility', [FacilityController::class, 'declineFacility']);

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/fetchAccountStatus', [DashboardController::class, 'fetchAccountStatus']);
    Route::get('/fetchStudent', [DashboardController::class, 'fetchStudent']);
    Route::get('/fetchFacilitator', [DashboardController::class, 'fetchFacilitator']);
    Route::get('/fetchFacilityStatus', [DashboardController::class, 'fetchFacilityStatus']);
    Route::get('/fetchDormitory', [DashboardController::class, 'fetchDormitory']);
    Route::get('/fetchCanteen', [DashboardController::class, 'fetchCanteen']);
});



