<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublicMediaController;
use App\Http\Controllers\WholesaleController;
use Illuminate\Support\Facades\Route;

// Do not rely on public/storage being a usable symlink: many shared hosts
// disable following symlinks and answer those image requests with HTTP 403.
Route::get('/media/{path}', PublicMediaController::class)
    ->where('path', '.*')
    ->name('media.show');

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
Route::get('/projects/{slug}', [PageController::class, 'projectShow'])->name('projects.show');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{slug}', [PageController::class, 'newsShow'])->name('news.show');

Route::get('/wholesale', [PageController::class, 'wholesale'])->name('wholesale');
Route::post('/wholesale', [WholesaleController::class, 'store'])->name('wholesale.store');

Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::post('/careers', [CareerController::class, 'store'])->middleware('throttle:6,1')->name('careers.store');

Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Legacy URLs from the previous "مجموعة شركة شورى" site structure
Route::permanentRedirect('/story', '/about');
Route::permanentRedirect('/products', '/sectors');
Route::permanentRedirect('/companies', '/brands');
Route::permanentRedirect('/branches', '/contact');

// Admin Auth Routes
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SectorController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TimelineNodeController;
use App\Http\Controllers\Admin\WholesaleRequestController;

Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Messages Inbox
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Wholesale (B2B) Inbox
    Route::get('/wholesale-requests', [WholesaleRequestController::class, 'index'])->name('wholesale.index');
    Route::get('/wholesale-requests/{wholesaleRequest}', [WholesaleRequestController::class, 'show'])->name('wholesale.show');
    Route::post('/wholesale-requests/{wholesaleRequest}/read', [WholesaleRequestController::class, 'markRead'])->name('wholesale.read');
    Route::delete('/wholesale-requests/{wholesaleRequest}', [WholesaleRequestController::class, 'destroy'])->name('wholesale.destroy');

    // Job Applications Inbox
    Route::get('/applications', [JobApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{jobApplication}', [JobApplicationController::class, 'show'])->name('applications.show');
    Route::get('/applications/{jobApplication}/cv', [JobApplicationController::class, 'downloadCv'])->name('applications.cv');
    Route::post('/applications/{jobApplication}/read', [JobApplicationController::class, 'markRead'])->name('applications.read');
    Route::delete('/applications/{jobApplication}', [JobApplicationController::class, 'destroy'])->name('applications.destroy');

    // Global Settings (Texts & Stories)
    Route::get('/settings', [HomeContentController::class, 'index'])->name('settings.index');
    Route::post('/settings', [HomeContentController::class, 'update'])->name('settings.update');

    // CRUD Resources
    Route::resource('stats', StatController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('sectors', SectorController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('timeline', TimelineNodeController::class)->parameters(['timeline' => 'timelineNode']);
    Route::resource('categories', CategoryController::class);
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('news', NewsController::class);
});
