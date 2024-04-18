<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'stand_game',
        'stand_food',
        'carousel_child',
        'carousel_familly',
        'carousel_extreme',
    ];
    public function categoryCarouselMany()
    {
        return $this->hasMany(Carousel::class);
    }
}
