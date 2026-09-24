<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            'slots_available' => 12,
            'advertisers' => \App\Models\Invoice::where('status', 'paid')->distinct('advertiser_name')->count('advertiser_name'),
        ];
        return view('landing', compact('stats'));
    }
}