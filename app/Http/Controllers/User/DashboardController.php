<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movie;
use Psy\Readline\Hoa\Console;

class DashboardController extends Controller
{
    public function index()
    // {
    //     $featuredMovies = Movie::whereIsFeatured(true)->get();
    //     $movies = Movie::all();
    //     return [
    //         'featuredMovies' => $featuredMovies,
    //         'movies' => $movies,
    //     ];
    // }
    {
        $featuredMovies = Movie::whereIsFeatured(true)->get();
        $movies = Movie::all();

        return inertia('User/Dashboard/Index', [
            'featuredMovies' => $featuredMovies,
            'movies' => $movies,
        ]);
    }
    
}
