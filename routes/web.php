<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPanel\DashboardController;
use App\Http\Controllers\UserPanel\ProfileController;
use App\Http\Controllers\UserPanel\NetworkController;
use App\Http\Controllers\UserPanel\ActivateController;
use App\Http\Controllers\UserPanel\TransactionsController;
use App\Http\Controllers\UserPanel\RoyaltyRewardsController;
use App\Http\Controllers\UserPanel\IncomesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InvestmentRequestController;

// Public routes
Route::get('/', [UserController::class, 'index']);
Route::get('login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Protected routes with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/UploadDocument', [ProfileController::class, 'UploadDocument'])->name('UploadDocument');
    Route::get('/TeamList', [NetworkController::class, 'TeamList'])->name('TeamList');
    Route::get('/LevelTree', [NetworkController::class, 'LevelTree'])->name('LevelTree');
    Route::get('/WithdrawalRequest', [TransactionsController::class, 'index'])->name('WithdrawalRequest');
    Route::get('/DepositHistory', [TransactionsController::class, 'DepositHistory'])->name('DepositHistory');
    Route::get('/WithdrawalHistory', [TransactionsController::class, 'WithdrawalHistory'])->name('WithdrawalHistory');
    Route::get('/TransactionSummary', [TransactionsController::class, 'TransactionSummary'])->name('TransactionSummary');
    Route::get('/addfund', [TransactionsController::class, 'addfund'])->name('addfund');
    Route::get('/ReportROI', [IncomesController::class, 'index'])->name('ReportROI');
    Route::get('/DirectIncome', [IncomesController::class, 'DirectIncome'])->name('DirectIncome');
    Route::get('/ReportSponsorLevelIncome', [IncomesController::class, 'ReportSponsorLevelIncome'])->name('ReportSponsorLevelIncome');
    Route::get('/ReportROILevelIncome', [IncomesController::class, 'ReportROILevelIncome'])->name('ReportROILevelIncome');
    Route::post('/invest', [ActivateController::class, 'invest'])->name('invest');
    Route::post('/withdraw', [TransactionsController::class, 'withdraw'])->name('withdraw');
    Route::get('/Royalty', [RoyaltyRewardsController::class, 'Royalty'])->name('Royalty');
    Route::post('/claim-reward/{reward}', [RoyaltyRewardsController::class, 'claimReward'])->name('claim.reward');


    Route::get('/claimDaily', [ActivateController::class, 'claimDaily'])->name('claimDaily');


    // Resource routes with 'auth' middleware
    Route::resource('profile', ProfileController::class);
    Route::resource('Network', NetworkController::class);
    Route::resource('Activate', ActivateController::class);
});
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm']);
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');

    // Add other admin routes that require authentication
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/active', [InvestmentRequestController::class, 'active'])->name('admin.active');
        Route::get('/reject', [InvestmentRequestController::class, 'reject'])->name('admin.reject');
        Route::post('/reject_request/{id}', [InvestmentRequestController::class, 'reject_request'])->name('reject_request');

        Route::resource('invest_req', InvestmentRequestController::class);
    });
});
