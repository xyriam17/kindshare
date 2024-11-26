<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\UserManagement;
use App\Http\Controllers\dashboard\Analytics;

use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\VerifyEmailBasic;
use App\Http\Controllers\donations\DonationController;

use App\Http\Controllers\authentications\ResetPasswordBasic;



// Main Page Route
Route::get('/', [Analytics::class, 'index'])->name('dashboard')->middleware('auth');


// authentication
Route::get('/auth/login', [LoginBasic::class, 'index'])->name('auth-login');
Route::post('/auth/login-request', [LoginBasic::class, 'loginRequest'])->name('login-request');
Route::post('/auth/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::get('/auth/verify-email-basic', [VerifyEmailBasic::class, 'index'])->name('auth-verify-email-basic');
Route::get('/auth/reset-password-basic', [ResetPasswordBasic::class, 'index'])->name('auth-reset-password-basic');

// Users
Route::resource('/user-list', UserManagement::class)->middleware('auth');
Route::get('/users/list', [UserManagement::class, 'UserManagement'])->name('users-list')->middleware('auth');
Route::post('/users/add-update ', [UserManagement::class, 'update'])->name('users-update')->middleware('auth');
Route::post('/users/update-photo ', [UserManagement::class, 'update_profile'])->name('update-photo')->middleware('auth');
Route::get('/user/view/{id}', [UserManagement::class, 'view'])->name('user-view')->middleware('auth');
Route::post('/users/update-password ', [UserManagement::class, 'updatePassword'])->name('update-password')->middleware('auth');


//Donation
Route::get('/donation/donate-now', [DonationController::class, 'index'])->name('donation');
Route::post('/donation/donate-pay', [DonationController::class, 'donateNow'])->name('donation-pay');
Route::get('/donations/money', [DonationController::class, 'moneyDonationlist'])->name('donations-money')->middleware('auth');
Route::get('/money-list', [DonationController::class, 'getMoneyDonation'])->name('money-list')->middleware('auth');
Route::get('/donations/food', [DonationController::class, 'foodDonationlist'])->name('donations-food')->middleware('auth');
Route::get('/food-list', [DonationController::class, 'getFoodDonation'])->name('food-list')->middleware('auth');
Route::post('/approve-list', [DonationController::class, 'approveDonation'])->name('approve-list')->middleware('auth');
Route::get('/donations/inkinds', [DonationController::class, 'clothingDonationlist'])->name('donations-inkinds')->middleware('auth');
Route::get('/clothing-list', [DonationController::class, 'getClotheDonation'])->name('clothing-list')->middleware('auth');
