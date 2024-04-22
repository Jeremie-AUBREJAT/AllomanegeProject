<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'size',
        'weight',
        'watt_power',
        'install_time',
        'description',
        'localization',
        'price',
    

    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function carouselPictureMany()
    {
        return $this->hasMany(Picture::class);
    }
    public function carouselUserMany()
    {
        return $this->hasMany(User::class);
    }
    public function carouselQuoteMany()
    {
        return $this->hasMany(Quote::class);
    }
}
