<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ContactMessage;
use App\Models\JobApplication;
use App\Models\News;
use App\Models\Project;
use App\Models\Sector;
use App\Models\WholesaleRequest;

class DashboardController extends Controller
{
    /**
     * Display the main admin dashboard view.
     */
    public function index()
    {
        return view('admin.dashboard', [
            'sectorsCount' => Sector::count(),
            'brandsCount' => Brand::count(),
            'projectsCount' => Project::count(),
            'newsCount' => News::count(),

            'unreadMessagesCount' => ContactMessage::where('is_read', false)->count(),
            'unreadWholesaleCount' => WholesaleRequest::where('is_read', false)->count(),
            'unreadApplicationsCount' => JobApplication::where('is_read', false)->count(),

            'recentMessages' => ContactMessage::orderBy('created_at', 'desc')->take(5)->get(),
        ]);
    }
}
