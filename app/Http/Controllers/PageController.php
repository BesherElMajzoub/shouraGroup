<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Client;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use App\Models\Stat;
use App\Models\TimelineNode;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        $about_body = setting('about_body');
        $vision_text = setting('vision_text');
        $mission_text = setting('mission_text');
        $clients_intro = setting('clients_intro');

        $stats = Stat::where('is_active', true)->orderBy('order')->get();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $clients = Client::where('is_active', true)->orderBy('order')->get();
        $news = News::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();

        return view('welcome', compact(
            'about_body',
            'vision_text',
            'mission_text',
            'clients_intro',
            'stats',
            'services',
            'clients',
            'news'
        ));
    }

    /**
     * Display the story/about-us page.
     */
    public function story()
    {
        $story_overview_body = setting('story_overview_body');
        $story_overview_image = setting('story_overview_image');

        $timeline_nodes = TimelineNode::orderBy('order')->get();
        $stats = Stat::where('is_active', true)->orderBy('order')->get();

        return view('story', compact(
            'story_overview_body',
            'story_overview_image',
            'timeline_nodes',
            'stats'
        ));
    }

    /**
     * Display the services page.
     */
    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();

        return view('services', compact('services'));
    }

    /**
     * Display the projects page.
     */
    public function projects()
    {
        $categories = Category::where('type', 'project')->orderBy('order')->get();
        $projects = Project::where('is_active', true)->with('category')->orderBy('order')->get();
        $stats = Stat::where('is_active', true)->orderBy('order')->get();

        return view('projects', compact('categories', 'projects', 'stats'));
    }

    /**
     * Display the news catalog page.
     */
    public function news()
    {
        $categories = Category::where('type', 'news')->orderBy('order')->get();
        $news = News::where('is_published', true)->with('category')->orderBy('published_at', 'desc')->paginate(6);

        return view('news', compact('categories', 'news'));
    }

    /**
     * Display a single news detail page.
     */
    public function newsShow($slug)
    {
        $article = News::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('news.show', compact('article'));
    }
}
