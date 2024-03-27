<?php

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