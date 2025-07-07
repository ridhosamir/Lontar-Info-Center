<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    /**
     * Retrieve all active posters for the carousel
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPosters()
    {
        return Poster::all();
    }
}