<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WholesaleRequest;

class WholesaleRequestController extends Controller
{
    /**
     * Display a listing of wholesale requests.
     */
    public function index()
    {
        $requests = WholesaleRequest::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.wholesale.index', compact('requests'));
    }

    /**
     * Display the specified request (and mark it as read).
     */
    public function show(WholesaleRequest $wholesaleRequest)
    {
        if (! $wholesaleRequest->is_read) {
            $wholesaleRequest->update(['is_read' => true]);
        }
        return view('admin.wholesale.show', ['request' => $wholesaleRequest]);
    }

    /**
     * Mark the request as read.
     */
    public function markRead(WholesaleRequest $wholesaleRequest)
    {
        $wholesaleRequest->update(['is_read' => true]);
        return redirect()->back()->with('success', 'تم تحديد الطلب كمقروء بنجاح.');
    }

    /**
     * Remove the specified request from storage.
     */
    public function destroy(WholesaleRequest $wholesaleRequest)
    {
        $wholesaleRequest->delete();
        return redirect()->route('admin.wholesale.index')->with('success', 'تم حذف الطلب بنجاح.');
    }
}
