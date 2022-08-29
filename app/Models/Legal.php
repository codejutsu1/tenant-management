<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
