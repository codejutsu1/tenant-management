<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Legal extends Model
{
    use HasFactory;
    use BelongsToUser;

    protected $fillable = [
        'user_id',
        'room_no',
        'year',
        'link'
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->IsoFormat('Do MMM YYYY H:m:s')
        );
    }
}
