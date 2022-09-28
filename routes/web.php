<?php

use App\Http\Livewire\CreateRecipe;
use App\Http\Livewire\ShowRecipe;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/recipe/create', CreateRecipe::class)->name('recipe.create');
Route::get('/recipe/show/{slug}', ShowRecipe::class)->name('recipe.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/recipes/overview')->name('recipes.overview');
});
