<?php

use App\Http\Controllers\CompanyLegalController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['web'])->group(function () {
    Route::get('/company/profile', [CompanyProfileController::class, 'index'])
        ->name('company.profile');

    Route::put('/company/profile', [CompanyProfileController::class, 'update'])
        ->name('company.profile.update');
});

Route::middleware(['web'])->group(function () {
    Route::get('/company/legal', [CompanyLegalController::class, 'index'])
        ->name('company.legal');

    Route::put('/company/legal', [CompanyLegalController::class, 'update'])
        ->name('company.legal.update');
});

Route::middleware(['web'])->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['web'])->group(function () {
    Route::resource('roles', RoleController::class)->except(['show']);
});

Route::middleware(['web'])->group(function () {
    Route::resource('services', ServiceController::class)->except(['show']);
});

Route::resource('clients', ClientController::class);


Route::get('/projects.index', function () {
    return "projects.index";
})->name('projects.index');
Route::get('/invoices.index', function () {
    return "invoices.index";
})->name('invoices.index');
Route::get('/payments.index', function () {
    return "payments.index";
})->name('payments.index');
Route::get('/reports.index', function () {
    return "reports.index";
})->name('reports.index');
Route::get('/reports.finance', function () {
    return "reports.finance";
})->name('reports.finance');
Route::get('/posts.index', function () {
    return "posts.index";
})->name('posts.index');
Route::get('/categories.index', function () {
    return "categories.index";
})->name('categories.index');
Route::get('/portfolios.index', function () {
    return "portfolios.index";
})->name('portfolios.index');
Route::get('/testimonials.index', function () {
    return "testimonials.index";
})->name('testimonials.index');
Route::get('/leads.index', function () {
    return "leads.index";
})->name('leads.index');
Route::get('/contacts.index', function () {
    return "contacts.index";
})->name('contacts.index');
Route::get('/settings.index', function () {
    return "settings.index";
})->name('settings.index');
Route::get('/logout', function () {
    return "logout";
})->name('logout');
Route::get('/login', function () {
    return "login";
})->name('login');
