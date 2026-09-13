<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WholesaleController;

Route::get('/language/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['ar', 'en'], true), 404);

    session(['locale' => $locale]);

    return redirect()->back();
})->name('language.switch');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/sectors', [PageController::class, 'sectors'])->name('sectors');
Route::get('/sectors/{slug}', [PageController::class, 'sectorShow'])->name('sectors.show');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/brands', [PageController::class, 'brands'])->name('brands');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{slug}', [PageController::class, 'newsShow'])->name('news.show');

Route::get('/wholesale', [PageController::class, 'wholesale'])->name('wholesale');
Route::post('/wholesale', [WholesaleController::class, 'store'])->name('wholesale.store');

Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::post('/careers', [CareerController::class, 'store'])->middleware('throttle:6,1')->name('careers.store');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Legacy URLs from the previous "مجموعة شورى" site structure
Route::permanentRedirect('/story', '/about');
Route::permanentRedirect('/products', '/sectors');
Route::permanentRedirect('/companies', '/brands');
Route::permanentRedirect('/branches', '/contact');

// Admin Auth Routes
use App\Http\Controllers\Admin\AuthController;
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Messages Inbox
    Route::get('/messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/read', [\App\Http\Controllers\Admin\MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');

    // Wholesale (B2B) Inbox
    Route::get('/wholesale-requests', [\App\Http\Controllers\Admin\WholesaleRequestController::class, 'index'])->name('wholesale.index');
    Route::get('/wholesale-requests/{wholesaleRequest}', [\App\Http\Controllers\Admin\WholesaleRequestController::class, 'show'])->name('wholesale.show');
    Route::post('/wholesale-requests/{wholesaleRequest}/read', [\App\Http\Controllers\Admin\WholesaleRequestController::class, 'markRead'])->name('wholesale.read');
    Route::delete('/wholesale-requests/{wholesaleRequest}', [\App\Http\Controllers\Admin\WholesaleRequestController::class, 'destroy'])->name('wholesale.destroy');

    // Job Applications Inbox
    Route::get('/applications', [\App\Http\Controllers\Admin\JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{jobApplication}', [\App\Http\Controllers\Admin\JobApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{jobApplication}/cv', [\App\Http\Controllers\Admin\JobApplicationController::class, 'downloadCv'])->name('applications.cv');
    Route::post('/applications/{jobApplication}/read', [\App\Http\Controllers\Admin\JobApplicationController::class, 'markRead'])->name('applications.read');
    Route::delete('/applications/{jobApplication}', [\App\Http\Controllers\Admin\JobApplicationController::class, 'destroy'])->name('applications.destroy');

    // Global Settings (Texts & Stories)
    Route::get('/settings', [\App\Http\Controllers\Admin\HomeContentController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\HomeContentController::class, 'update'])->name('settings.update');

    // CRUD Resources
    Route::resource('stats', \App\Http\Controllers\Admin\StatController::class);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('sectors', \App\Http\Controllers\Admin\SectorController::class);
    Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('branches', \App\Http\Controllers\Admin\BranchController::class);
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
    Route::resource('timeline', \App\Http\Controllers\Admin\TimelineNodeController::class)->parameters(['timeline' => 'timelineNode']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
});
