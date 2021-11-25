<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kesi extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'filedate',
        'first_hearing',
        'next_hearing',
        'p_gender',
        'judge_id',
        'lawyer_id',
        'p_name',
        'p_email',
        'p_phone',
        'p_dob',
        'p_id',
        'd_name',
        'd_email',
        'd_phone',
        'd_dob',
        'd_id',
        'd_gender'
    ];
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function lawyer() 
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function judge() 
    {
        return $this->belongsTo(Judge::class);
    }
}
