<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Post extends Model
{
    use HasFactory;

    public $fillable = [
        'content'
    ];
    protected $orderBy = 'created_at';
    protected $orderDirection = 'desc';

    public function scopeOrdered ($query)
    {
        return $query->orderBy($this->orderBy, $this->orderDirection);
    }

    public function author ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getDiffForHumansAttribute ()
    {
        $now = Date::now();
        return $this->created_at->diffForHumans($now);
    }
}
