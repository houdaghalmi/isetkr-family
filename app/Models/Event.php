<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id', 'title', 'intervenant', 'description',
        'datetime', 'location', 'poster', 'status', 'certificated'
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'certificated' => 'boolean'
    ];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }
}