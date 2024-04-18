<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TemplateDataController;
use App\Http\Controllers\UserFilledTemplateFormController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Auth;



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
    if (Auth::user()) {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
    //return view('welcome');
});


/*Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
})->name('verification.verify');*/


Route::get('email/verify/{token}', [DriverController::class, 'verifyEmail'])->name('email.verify');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [DriverController::class, 'welcome'])->name('welcome');
    Route::get('/dashboard', [DriverController::class, 'driver_record'])->name('dashboard');
    Route::get('/downloadpdf', [PDFController::class, 'index'])->name('pdf.createpdf');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*vehicle code*/
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::get('/vehicle/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::post('/vehicle/create', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::get('/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::get('/vehicle/view/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::put('/vehicle/update/{id}', [VehicleController::class, 'update'])->name('vehicles.update');
    Route::delete('/vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');
    /*End of code*/

    Route::get('/drivers', [DriverController::class, 'index'])->name('drivers');
    Route::get('/driver/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/driver/create', [DriverController::class, 'store'])->name('drivers.store');
    Route::get('/driver/edit/{id}', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::get('/driver/view/{id}', [DriverController::class, 'show'])->name('drivers.show');
    Route::put('/driver/update/{id}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('/driver/delete/{id}', [DriverController::class, 'destroy'])->name('drivers.destroy');
    Route::put('/driver/isActive/{id}', [DriverController::class, 'isactive'])->name('drivers.isactive');

    Route::get('/driver/assign-templates/{user_id}', [DriverController::class, 'assign_templates'])->name('drivers.assign_templates');
    Route::get('/driver/completed-templates/{user_id}/{template_id}/{form_number}', [DriverController::class, 'completed_templates'])->name('drivers.completed_templates');

    Route::get('/driver/form-filled-by-users/{user_id}/{template_id}/', [UserFilledTemplateFormController::class, 'user_filled_form'])->name('user_filled_form');

    Route::get('/templates', [TemplateController::class, 'index'])->name('templates');
    Route::get('/templates/create/', [TemplateController::class, 'create'])->name('templates.create');
    Route::post('/templates/create/', [TemplateController::class, 'store'])->name('templates.store');

    Route::get('/templates/edit/{id}', [TemplateController::class, 'edit'])->name('templates.edit');
    Route::get('/templates/view/{id}', [TemplateController::class, 'show'])->name('templates.show');
    Route::put('/templates/update/{id}', [TemplateController::class, 'update'])->name('templates.update');
    Route::put('/templates/assigndriver/{id}', [TemplateController::class, 'assigndriver'])->name('templates.assigndriver');
    Route::delete('/templates/delete/{id}', [TemplateController::class, 'destroy'])->name('templates.destroy');

    /*Create Form */
    Route::get('/templates/{id}/create', [TemplateDataController::class, 'create'])->name('templates.forms.create');
    Route::post('/templates/{id}/create', [TemplateDataController::class, 'store'])->name('templates.forms.store');
    Route::get('/templates/forms/view/{id}', [TemplateDataController::class, 'show'])->name('templates.forms.show');
    //Route::get('/templates/{id}/view/{form_count}', [TemplateDataController::class, 'show'])->name('templates.froms.show');
    Route::get('/templates/{id}/edit/{form_id}', [TemplateDataController::class, 'edit'])->name('templates.forms.edit');
    Route::put('/templates/forms/update/{id}', [TemplateDataController::class, 'update'])->name('templates.forms.update');
    Route::delete('/templates/forms/delete/{id}', [TemplateDataController::class, 'destroy'])->name('templates.forms.destroy');
    /* Upload media */
    // Route::get('/media', [MediaController::class, 'index'])->name('media');
});

require __DIR__ . '/auth.php';
