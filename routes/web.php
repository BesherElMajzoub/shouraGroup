<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/story', [PageController::class, 'story'])->name('story');
Route::view('/companies', 'companies')->name('companies');
Route::view('/products', 'products')->name('products');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::view('/branches', 'branches')->name('branches');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::get('/news', [PageController::class, 'news'])->name('news');
Route::get('/news/{slug}', [PageController::class, 'newsShow'])->name('news.show');

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

    // Global Settings (Texts & Stories)
    Route::get('/settings', [\App\Http\Controllers\Admin\HomeContentController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\HomeContentController::class, 'update'])->name('settings.update');

    // CRUD Resources
    Route::resource('stats', \App\Http\Controllers\Admin\StatController::class);
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);
    Route::resource('timeline', \App\Http\Controllers\Admin\TimelineNodeController::class)->parameters(['timeline' => 'timelineNode']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
});
