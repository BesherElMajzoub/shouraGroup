<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    /**
     * Store a newly created contact message in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'department_name' => ['required', 'string', 'max:255'],
            'department_email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        // The browser echoes back the chosen department's inbox; only accept
        // addresses the site itself publishes so the field can't be forged.
        if (! in_array(strtolower($validated['department_email']), $this->allowedDepartmentEmails(), true)) {
            throw ValidationException::withMessages(['department_email' => trans('validation.in', ['attribute' => 'department_email'])]);
        }

        ContactMessage::create($validated);

        return response()->json(['ok' => true]);
    }

    /**
     * @return list<string>
     */
    private function allowedDepartmentEmails(): array
    {
        return collect([setting('contact_email'), setting('sales_email')])
            ->merge(Sector::where('is_active', true)->get()->pluck('contact_email'))
            ->filter()
            ->map(fn ($email) => strtolower($email))
            ->unique()
            ->values()
            ->all();
    }
}
