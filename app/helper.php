<?php

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('dashboard_user')) {
    function dashboard_user()
    {
        if (Auth::check()) {
            return Auth::user();
        } else {
            return null;
        }
    }
}


if(!function_exists('timeAgo'))
{
    function timeAgo($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }
}

if(!function_exists('cartDetails'))
{
    function cartDetails(){
        
        // Check if the user is authenticated
        if (Auth::check()) {
            $id = Auth::user()->id;
            $cartDetail = Cart::where('user_id', $id)->first();
            if ($cartDetail) {
                $cartCount = $cartDetail->count();
                return $cartCount;
            } else {
                return 0; // If cart details not found, return 0
            }
        } else {
            return 0; // If user is not authenticated, return 0
        }

    }
}