<?php

use App\Livewire\StoryPage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\GuildPage;
use App\Livewire\LandingPage;
use App\Livewire\VerbsBugDemo;

Route::get('/', LandingPage::class)->name('landing-page');
Route::get('/guild/{guild}/story/{story}', StoryPage::class)->name('story.show');

Route::get('/dashboard', VerbsBugDemo::class)->name('demo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/guilds/{guild}', GuildPage::class)->name('guild.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
