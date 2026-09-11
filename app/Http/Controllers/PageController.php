<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Client;
use App\Models\News;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Service;
use App\Models\Stat;
use App\Models\TimelineNode;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        return view('welcome', [
            'about_subtitle' => setting('about_subtitle'),
            'about_body' => setting('about_body'),
            'home_about_main_image' => setting('home_about_main_image', 'images/about_skyscrapers.png'),
            'home_about_secondary_image' => setting('home_about_secondary_image', 'images/industrial_bg.png'),
            'vision_text' => setting('vision_text'),
            'mission_text' => setting('mission_text'),
            'partners_intro' => setting('partners_intro'),
            'clients_intro' => setting('clients_intro'),

            'stats' => Stat::where('is_active', true)->orderBy('order')->get(),
            'sectors' => Sector::where('is_active', true)->orderBy('order')->get(),
            'services' => Service::where('is_active', true)->where('group', 'home')->orderBy('order')->get(),
            'brands' => Brand::where('is_active', true)->where('show_on_home', true)->orderBy('order')->get(),
            'clients' => Client::where('is_active', true)->orderBy('order')->get(),
            'branches' => Branch::where('is_active', true)->orderBy('order')->get(),
            'news' => News::where('is_published', true)->with('category')->orderBy('published_at', 'desc')->take(3)->get(),
        ]);
    }

    /**
     * Display the about-us page (company story and timeline).
     */
    public function about()
    {
        return view('about', [
            'story_overview_body' => setting('story_overview_body'),
            'story_overview_image' => setting('story_overview_image'),
            'about_subtitle' => setting('about_subtitle'),

            'timeline_nodes' => TimelineNode::orderBy('order')->get(),
            'stats' => Stat::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the sectors index page.
     */
    public function sectors()
    {
        return view('sectors.index', [
            'sectors_intro' => setting('sectors_intro'),
            'sectors' => Sector::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    /**
     * Display a single sector detail page.
     */
    public function sectorShow($slug)
    {
        $sector = Sector::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $sector->load('brands');

        return view('sectors.show', [
            'sector' => $sector,
            'other_sectors' => Sector::where('is_active', true)->where('id', '!=', $sector->id)->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the services page.
     */
    public function services()
    {
        return view('services', [
            'services_intro' => setting('services_intro'),
            'services' => Service::where('is_active', true)->where('group', 'pillar')->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the official agencies and brands page.
     */
    public function brands()
    {
        return view('brands', [
            'brands_intro' => setting('brands_intro'),
            'agencies' => Brand::where('is_active', true)->where('is_agency', true)->orderBy('order')->get(),
            'brands' => Brand::where('is_active', true)->with('sectors')->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the projects page.
     */
    public function projects()
    {
        return view('projects', [
            'projects_intro' => setting('projects_intro'),
            'categories' => Category::where('type', 'project')->orderBy('order')->get(),
            'projects' => Project::where('is_active', true)->with('category')->orderBy('order')->get(),
            'stats' => Stat::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the news catalog page.
     */
    public function news()
    {
        return view('news', [
            'categories' => Category::where('type', 'news')->orderBy('order')->get(),
            'news' => News::where('is_published', true)->with('category')->orderBy('published_at', 'desc')->paginate(6),
        ]);
    }

    /**
     * Display a single news detail page.
     */
    public function newsShow($slug)
    {
        $article = News::where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('news.show', compact('article'));
    }

    /**
     * Display the B2B wholesale and distributors page.
     */
    public function wholesale()
    {
        return view('wholesale', [
            'wholesale_intro' => setting('wholesale_intro'),
            'sales_email' => setting('sales_email'),
            'whatsapp' => setting('wholesale_whatsapp'),
            'branches' => Branch::where('is_active', true)->orderBy('order')->get(),
            // Brands are listed inside each sector's dropdown option
            'sectors' => Sector::where('is_active', true)->where('is_coming_soon', false)
                ->with('brands')->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the careers page.
     */
    public function careers()
    {
        return view('careers', [
            'careers_intro' => setting('careers_intro'),
            'hr_email' => setting('hr_email'),
            'branches' => Branch::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return view('contact', [
            'contact_intro' => setting('contact_intro'),
            'contact_email' => setting('contact_email'),
            'sales_email' => setting('sales_email'),
            'working_hours' => setting('working_hours'),
            'branches' => Branch::where('is_active', true)->orderBy('order')->get(),
            'services' => Service::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
