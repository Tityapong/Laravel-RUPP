<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $features = Feature::all(); // Fetch all features
        return view('theme.services', compact('features')); // Pass $features to the view
    }
}