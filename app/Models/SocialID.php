<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialID extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'social_id', 'access_token', 'page_id', 'page_name', 'expires_at'];


    public function user()
    {
        return $this->belongsTo(User::class); // Assuming your user model is named 'User'
    }
}
