<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdResource;
use App\Models\User;


class AdvertiserController extends Controller
{

    public function fetchAds(User $user)
    {
         $ads = $user->ads;

        return response()->json(AdResource::collection($ads), 200);
    }
}
