<?php

namespace Wave;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'disciplines' => 'array',
        'judges' => 'array',
        'event_start_date' => 'datetime',
        'event_end_date' => 'datetime',
        'booking_start_date' => 'datetime',
        'booking_end_date' => 'datetime',
    ];

    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->author_id && Auth::user()) {
            $this->author_id = Auth::user()->getKey();
        }

        parent::save();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function authorId()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }

    public function link()
    {
        return url('evenimente/' . $this->slug);
    }

    public function image()
    {
        return Storage::url($this->image);
    }
}