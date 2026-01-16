<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyLegalController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTemplateController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\LegalDocumentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AUTHENTICATION ROUTES ---
// Route untuk Halaman Depan
Route::get('/', [LandingController::class, 'index'])->name('home');

// Route untuk Detail Pages
Route::get('/services/{id}', [LandingController::class, 'showService'])->name('service.detail');
Route::get('/portfolio/{id}', [LandingController::class, 'showPortfolio'])->name('portfolio.detail');
Route::get('/about', [LandingController::class, 'about'])->name('about');

// Route untuk Blog/Artikel
Route::get('/blog', [LandingController::class, 'blogIndex'])->name('blog.index');
Route::get('/blog/{slug}', [LandingController::class, 'blogDetail'])->name('blog.detail');

// Route untuk Submit Contact Form (Masuk ke tabel Leads/Contacts)
Route::post('/contact-submit', [LandingController::class, 'storeLead'])->name('contact.submit');

// // Halaman Root -> Login Form
// Route::get('/', [AuthController::class, 'showLoginForm']);

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

    // Document Templates
    Route::resource('document-templates', DocumentTemplateController::class)->except(['show']);

    // Agreements
    Route::resource('agreements', AgreementController::class);

    // Documents (Incoming & Outgoing)
    Route::resource('documents', DocumentController::class);

    // Legal Documents
    Route::resource('legal-documents', LegalDocumentController::class);

    // Employees (SDM)
    Route::resource('employees', EmployeeController::class);
    Route::post('employees/{employee}/documents', [EmployeeController::class, 'uploadDocument'])->name('employees.documents.upload');
    Route::delete('employees/{employee}/documents/{document}', [EmployeeController::class, 'deleteDocument'])->name('employees.documents.delete');

    // Contacts (Pesan dari Landing Page)
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Posts & Categories (Artikel/Blog)
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Master Data Resources
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::resource('clients', ClientController::class);
    Route::resource('projects', \App\Http\Controllers\ProjectController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
    Route::resource('payments', PaymentController::class);
    Route::get('/reports/finance', [ReportController::class, 'finance'])->name('reports.finance');
    Route::resource('leads', LeadController::class);
    Route::resource('expenses', \App\Http\Controllers\ExpenseController::class);
    Route::resource('salary-slips', \App\Http\Controllers\SalarySlipController::class);
    
    // Menggunakan name 'settings.index' agar sesuai dengan menu di layout dashboard
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    // Route untuk update (POST/PUT)
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});
