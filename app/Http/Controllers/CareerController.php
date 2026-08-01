<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Store a job application together with its CV file.
     *
     * The CV is stored on the public disk so the admin inbox can download it and
     * the generated e-mail can carry a link to it — `mailto:` cannot attach files.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'preferred_branch' => ['required', 'string', 'max:255'],
            'cover_letter' => ['nullable', 'string'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $validated['cv_path'] = $request->file('cv')->store('uploads/cvs', 'public');
        unset($validated['cv']);

        $application = JobApplication::create($validated);

        return response()->json([
            'ok' => true,
            'cv_url' => $application->cv_url,
        ]);
    }
}
