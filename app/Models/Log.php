<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Log extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'user_id' , 'ip' , 'country' , 'user_agent'];

    public function shortUrl()
    {
        return $this->hasOne(ShortUrl::class);
    }
    public function user()
    {
        return $this->hasOne(User::class , 'id' , 'user_id');
    }

}
