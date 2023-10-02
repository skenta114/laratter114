<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Auth;

class FavoriteController extends Controller
{
    public function store(Tweet $tweet)
    {
        $tweet->users()->attach(Auth::id());
        return redirect()->back();
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->users()->detach(Auth::id());
        return redirect()->back();
    }
}
