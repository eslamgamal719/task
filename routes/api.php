<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::ApiResource('ads', \App\Http\Controllers\AdsController::class);
Route::ApiResource('categories', \App\Http\Controllers\CategoriesController::class);
Route::ApiResource('tags', \App\Http\Controllers\TagsController::class);

Route::get('advertiser-ads/{user}', [\App\Http\Controllers\AdvertiserController::class, 'fetchAds']);

Route::get('test', function() {
     $advertisers = \App\Models\User::whereHas('ads', function($q) {
        $q->where('start_date', '>', \Carbon\Carbon::now()->subDays(1));
    })->get();

       foreach($advertisers as $advertiser) {
           \Illuminate\Support\Facades\Mail::to($advertiser)->send(new \App\Mail\AdvertiserMail($advertiser));
       }

});
