<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    
    protected $fillable = [
        'user_id',
        'gender',
        'phone',
        'national_ID',
        'dateofbirth',
        'current_address',
        'permanent_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
