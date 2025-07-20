<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo', 'facebook_link','instagram_link', 'description', 'objective', 
        'responsable_user_id', 'status'
    ];

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'club_members')
            ->withPivot('status', 'function', 'joined_at', 'left_at','facebook_link','instagram_link');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}