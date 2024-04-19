<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'message',       
    ];
    public function quoteCarouselMany()
    {
        return $this->hasMany(Carousel::class);
    }
}
