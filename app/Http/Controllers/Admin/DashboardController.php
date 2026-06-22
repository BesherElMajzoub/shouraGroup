<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the main admin dashboard view.
     */
    public function index()
    {
        $servicesCount = Service::count();
        $projectsCount = Project::count();
        $newsCount = News::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();

        $recentMessages = ContactMessage::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'servicesCount',
            'projectsCount',
            'newsCount',
            'unreadMessagesCount',
            'recentMessages'
        ));
    }
}
