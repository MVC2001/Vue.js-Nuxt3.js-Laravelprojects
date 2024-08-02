<?php

namespace App\Http\Controllers\Api;
use App\Models\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(){
       $totlaFilms = Film::all();

       return response()->json([
        'films' => $totlaFilms,
        'status' => 200
       ]);
    }
}
