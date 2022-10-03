<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'user_id',
        'title',
        'amount',
        'year',
        'period',
        'status',
        'paid'
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->IsoFormat('Do MMM YYYY H:m:s')
        );
    }

}
