<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'compagny',
        'email',
        'password',
        'phone_number',
        'role',
        'street_number',
        'street_name',
        'postal_code',
        'city',
        'country',
        'rgpd_consent',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's role.
     *
     * @param  string  $value
     * @return string
     */
    public function getRoleAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Set the user's role.
     *
     * @param  string  $value
     * @return void
     */
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = strtolower($value);
    }

    /**
     * Check if the user has a given role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Define a relationship with Carousel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carousels()
    {
        return $this->hasMany(Carousel::class);
    }
}