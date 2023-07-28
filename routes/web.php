<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReplenishBalanceController;
use App\Http\Controllers\ChangeUserController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\AdditionalInformationController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//main
Route::get('/', [MainController::class, 'index'])->name('main');
Route::post('/', [MainController::class, 'send'])->name('main');

//profile
Route::get('profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::post('profile', [ProfileController::class, 'confirm_teacher'])->middleware('auth')->name('confirm_teacher');

//study
Route::get('study', [StudyController::class, 'index'])->middleware('auth')->name('study');
Route::post('study', [StudyController::class, 'create_lesson'])->middleware('auth')->name('study');

//work
Route::get('work', [WorkController::class, 'index'])->middleware('auth')->name('work');
Route::get('work_filter', [WorkController::class, 'work_filter'])->middleware('auth')->name('work_filter');
Route::post('work', [WorkController::class, 'accept_lesson'])->middleware('auth')->name('work');


//history
Route::get('history', [HistoryController::class, 'index'])->middleware('auth')->name('history');

//chat
Route::get('chat/', [ChatController::class, 'index'])->middleware('auth')->name('chat');
Route::get('chat/{user_id}', [ChatController::class, 'check_chat'])->middleware('auth')->name('check_chat');
Route::post('chat/', [ChatController::class, 'send_message'])->middleware('auth')->name('chat');

//admin
Route::get('settings/', [AdminController::class, 'index'])->middleware('auth')->name('settings');
Route::post('settings/add_subject', [AdminController::class, 'add_subject'])->name('settings.add_subject');
Route::post('settings/delete_subject', [AdminController::class, 'delete_subject'])->name('settings.delete_subject');
Route::post('settings/add_class', [AdminController::class, 'add_class'])->name('settings.add_class');
Route::post('settings/delete_class', [AdminController::class, 'delete_class'])->name('settings.delete_class');
Route::post('settings/change_minute_cost', [AdminController::class, 'change_minute_cost'])->name('settings.change_minute_cost');

//replenish_balance
Route::get('replenish_balance', [ReplenishBalanceController::class, 'index'])->middleware('auth')->name('replenish_balance');
Route::post('replenish_balance', [ReplenishBalanceController::class, 'replenish'])->middleware('auth')->name('replenish_balance');

//change_user
Route::get('change_user', [ChangeUserController::class, 'index'])->middleware('auth')->name('change_user');
Route::post('change_user', [ChangeUserController::class, 'change'])->middleware('auth')->name('change_user');


//update_password
Route::get('update_password', [UpdatePasswordController::class, 'index'])->middleware('auth')->name('update_password');
Route::post('update_password', [UpdatePasswordController::class, 'update_password'])->middleware('auth')->name('update_password');

//change_additional_information
Route::get('change_additional_information', [AdditionalInformationController::class, 'index'])->middleware('auth')->name('change_additional_information');
Route::post('change_additional_information', [AdditionalInformationController::class, 'change'])->middleware('auth')->name('change_additional_information');


//alert
Route::get('alert', [AlertController::class, 'index'])->middleware('auth')->name('alert');
Route::post('permissions', [AlertController::class, 'permissions'])->middleware('auth')->name('permissions');


//support
Route::get('support', [SupportController::class, 'index'])->middleware('auth')->name('support');
Route::post('support', [SupportController::class, 'send'])->middleware('auth')->name('support');


// login
Route::get('login', function () {
    if (Auth::check()) {
        return redirect('profile');
    }
    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])->name('login.store');

//logout
Route::get('logout', function() {
    Auth::logout();
    return redirect('login');
})->name('logout');

//register
Route::get('register', function () {
    if (Auth::check()) {
        return redirect('profile');
    }
    return view('register');
})->name('register');

Route::post('register', [RegisterController::class, 'save'])->name('register.store');


//сброс пароля
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// если ни один другой маршрут не подошёл под запрос
Route::fallback(function () {
    return view('404');
});
