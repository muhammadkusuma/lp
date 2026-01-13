<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyLegalController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AUTHENTICATION ROUTES ---

// Halaman Root -> Login Form
Route::get('/', [AuthController::class, 'showLoginForm']);

// Halaman Login (Nama route 'login' penting untuk redirect middleware)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Proses Login (POST)
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PROTECTED ROUTES (Hanya bisa diakses setelah login) ---
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Company
    Route::get('/company/profile', [CompanyProfileController::class, 'index'])->name('company.profile');
    Route::put('/company/profile', [CompanyProfileController::class, 'update'])->name('company.profile.update');
    Route::get('/company/legal', [CompanyLegalController::class, 'index'])->name('company.legal');
    Route::put('/company/legal', [CompanyLegalController::class, 'update'])->name('company.legal.update');

    // Master Data Resources
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/reports/finance', [ReportController::class, 'finance'])->name('reports.finance');
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('portfolios', PortfolioController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('leads', LeadController::class);
    Route::resource('contacts', App\Http\Controllers\ContactController::class)->only(['index', 'show', 'destroy']);
    // Menggunakan name 'settings.index' agar sesuai dengan menu di layout dashboard
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // Route untuk update (POST/PUT)
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
