<?php

use App\Livewire\StoryPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\LandingPage;

Route::get('/', LandingPage::class)->name('landing-page');
Route::get('/story/{story}', StoryPage::class)->name('story.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
