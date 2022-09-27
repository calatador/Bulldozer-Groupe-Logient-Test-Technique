<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class ShortUrl extends Model
{
    use HasFactory, Prunable;
    protected $fillable = ['original_url', 'short_url'];

    public function log()
    {
        return $this->hasMany(Log::class);
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subDay());
    }

}
