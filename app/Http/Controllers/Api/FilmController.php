<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::select([
            'id',
            'title',
            'subtitle',
            'year',
            'rating',
            'genre',
            'description',
            'image_url',
        ])->get()->map(function ($film) {
            // Perbaiki genre
            $film->genre = json_decode($film->genre, true) ?: [$film->genre];
            
            // Ubah image_url jadi URL penuh
            $film->image = url($film->image_url);
            unset($film->image_url);
            return $film;
        });

        return response()->json($films);
    }

    public function show($id)
    {
        $film = Film::find($id);

        if (!$film) {
            return response()->json(['error' => 'Film tidak ditemukan'], 404);
        }

        // Perbaiki genre
        $film->genre = json_decode($film->genre, true) ?: [$film->genre];
        
        // Ubah image_url jadi URL penuh
        $film->image = url($film->image_url);
        unset($film->image_url);

        return response()->json($film);
    }
}