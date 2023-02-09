<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'channel_id',
        'email',
        'link',
        'status',
        'already_registered',
        'is_sent',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
