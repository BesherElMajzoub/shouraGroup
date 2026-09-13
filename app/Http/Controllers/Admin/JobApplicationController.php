<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of job applications.
     */
    public function index()
    {
        $applications = JobApplication::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Display the specified application (and mark it as read).
     */
    public function show(JobApplication $jobApplication)
    {
        if (! $jobApplication->is_read) {
            $jobApplication->update(['is_read' => true]);
        }

        return view('admin.applications.show', ['application' => $jobApplication]);
    }

    /**
     * Mark the application as read.
     */
    public function markRead(JobApplication $jobApplication)
    {
        $jobApplication->update(['is_read' => true]);

        return redirect()->back()->with('success', 'تم تحديد الطلب كمقروء بنجاح.');
    }

    /**
     * Download a CV through the authenticated admin area.
     */
    public function downloadCv(JobApplication $jobApplication)
    {
        abort_unless($jobApplication->cv_path, 404);

        $disk = Storage::disk('local')->exists($jobApplication->cv_path)
            ? 'local'
            : 'public';

        abort_unless(Storage::disk($disk)->exists($jobApplication->cv_path), 404);

        $extension = pathinfo($jobApplication->cv_path, PATHINFO_EXTENSION);
        $filename = 'CV-'.$jobApplication->id.($extension ? ".{$extension}" : '');

        return Storage::disk($disk)->download($jobApplication->cv_path, $filename);
    }

    /**
     * Remove the application together with its uploaded CV.
     */
    public function destroy(JobApplication $jobApplication)
    {
        if ($jobApplication->cv_path) {
            Storage::disk('local')->delete($jobApplication->cv_path);
            Storage::disk('public')->delete($jobApplication->cv_path);
        }

        $jobApplication->delete();

        return redirect()->route('admin.applications.index')->with('success', 'تم حذف الطلب والسيرة الذاتية بنجاح.');
    }
}
