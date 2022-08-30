<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Legal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_no',
        'year',
        'link'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->IsoFormat('Do MMM YYYY H:m:s')
        );
    }
}
