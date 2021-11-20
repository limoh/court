<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lawyer extends Model
{
    use HasFactory;
    protected $table = 'lawyers';

    protected $fillable = [
        'user_id',
        'gender',
        'phone',
        'dateofbirth',
        'national_ID',
        'current_address',
        'permanent_address',
    ];
     public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
