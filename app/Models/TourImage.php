<?php

// app/Models/TourImage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourImage extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'image_path'];

    // Relación inversa con Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
