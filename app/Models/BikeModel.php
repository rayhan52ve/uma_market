<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeModel extends Model
{
    use HasFactory;
    public function brand()
    {
        return $this->belongsTo(BikeBrand::class);
    }
}
