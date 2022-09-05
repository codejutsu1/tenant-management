<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'occupation',
        'gender',
        'state',
        'lga',
        'phone',
        'type',
        'role_id',
        'dob',
        'date_left',
        'rent_due',
        'status',
        'paid',
        'year',
        'room_no',
        'lodge_no',
    ];

    // protected $dateFormat = 'U';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = ['rent_due'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    protected function gender(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value),
        );
    }

    protected function rentDue(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->IsoFormat('Do MMM YYYY')
        );
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->IsoFormat('Do MMM YYYY H:m:s')
        );
    }

    protected function dateLeft(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->IsoFormat('Do MMM YYYY')
        );
    }


}
