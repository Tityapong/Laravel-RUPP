<?php

use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ServiceController;
use App\Models\Feature;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('theme.index');  
})->name('home');




// Route for About Page
Route::get('/about', function () {
    return view('theme.about');  
})->name('about');

Route::get('/services', [ServiceController::class, 'index'])->name('services');


Route::get('/pricing', function () {
    return view('theme.pricing');  
})->name('pricing');


Route::get('/newsletter', function () {
    return view('theme.newsletter'); 
})->name('newsletter');

// Route for Login Page

// Route to manage features in the admin panel
Route::resource('admin/features', FeatureController::class);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
