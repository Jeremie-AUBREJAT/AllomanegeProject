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
        'status',
    

    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function carouselPictureMany()
    {
        return $this->hasMany(Picture::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function carouselQuoteMany()
    {
        return $this->hasMany(Quote::class);
    }
}
