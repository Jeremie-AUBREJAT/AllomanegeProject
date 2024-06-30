<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'length',
        'width',
        'weight',
        'watt_power',
        'install_time',
        'description',
        'street_number', 
        'street_name', 
        'postal_code', 
        'city', 
        'country',
        'price',
        'category_id',
        'picture_id',
        'quote_id',
        'user_id',
        'status',
        'latitude',
        'longitude'
    

    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function carouselPictureMany()
    {
        return $this->hasMany(Picture::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function carouselQuoteMany()
    {
        return $this->hasMany(Quote::class);
    }
    public function reservations()
    {
        return $this->hasMany(Calendar::class, 'carousel_id');
    }

}
