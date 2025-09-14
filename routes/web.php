<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ShiftController;
use App\Http\Controllers\SchoolClassController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/login',[AdminController::class,'login'])->name('admin.login.submit');

Route::middleware('admin')->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admins.admin_dashboard');
    Route::post('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::resource('classes', SchoolClassController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('shifts', ShiftController::class);
    //Route::resource('cars', CarController::class);
    //Route::resource('categories', CategoryController::class);
    //Route::delete('/cars/photos/{photo}', [CarImageController::class, 'destroy'])->name('cars.photos.delete');
    //Route::put('cars/{car}', [CarController::class, 'update'])->name('cars.update');
    //Route::get('/cars/{id}/details',[CarController::class,'car_details'])->name('car.details');
    //Route::get('admin/bookings',[BookingController::class,'index'])->name('admin.booking.index');
    //Route::get('admin/customers',[CustomerController::class,'index'])->name('admin.customer.index');
    // Route::get('admin/customers/{id}',[CustomerController::class,'edit'])->name('admin.customer.edit');
});
