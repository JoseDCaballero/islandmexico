<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourImageController extends Controller
{
    public function getImages($tourId)
    {
        $images = DB::table('tour_images')
            ->where('tour_id', $tourId)
            ->pluck('image_path');

        return response()->json($images);
    }
}
