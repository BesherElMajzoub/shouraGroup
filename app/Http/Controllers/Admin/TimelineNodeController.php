<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineNode;
use Illuminate\Http\Request;

class TimelineNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nodes = TimelineNode::orderBy('order')->get();
        return view('admin.timeline.index', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.timeline.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_date' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'order' => ['required', 'integer'],
        ]);

        TimelineNode::create($validated);

        return redirect()->route('admin.timeline.index')->with('success', 'تم إضافة حدث الخط الزمني بنجاح.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimelineNode $timelineNode)
    {
        return view('admin.timeline.edit', compact('timelineNode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TimelineNode $timelineNode)
    {
        $validated = $request->validate([
            'event_date' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'description_en' => ['required', 'string'],
            'order' => ['required', 'integer'],
        ]);

        $timelineNode->update($validated);

        return redirect()->route('admin.timeline.index')->with('success', 'تم تحديث حدث الخط الزمني بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimelineNode $timelineNode)
    {
        $timelineNode->delete();
        return redirect()->route('admin.timeline.index')->with('success', 'تم حذف حدث الخط الزمني بنجاح.');
    }
}
