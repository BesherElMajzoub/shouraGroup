<?php

namespace App\Http\Controllers;

use App\Models\WholesaleRequest;
use Illuminate\Http\Request;

class WholesaleController extends Controller
{
    /**
     * Store a B2B wholesale / distributor request.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'product_interest' => ['required', 'string', 'max:255'],
            'governorate' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        WholesaleRequest::create($validated);

        return response()->json(['ok' => true]);
    }
}
