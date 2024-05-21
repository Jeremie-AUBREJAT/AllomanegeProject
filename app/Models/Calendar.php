<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Calendar extends Model
{
    protected $table = 'calendar';

    protected $fillable = [
        'debut_date', 
        'fin_date', 
        'carousel_id', 
        'user_id', 
        'status'];

    public function carousel()
    {
        return $this->belongsTo(Carousel::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}