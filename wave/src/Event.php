<?php

namespace Wave;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

// Am eliminat use-urile pentru Resizable si Translatable

class Event extends Model
{
    use HasFactory; // Am eliminat trait-urile de aici

    // Am eliminat array-ul $translatable
    // protected $translatable = ['title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];

    protected $guarded = [];

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

    public function image($storage_path = null)
    {
        if (is_null($storage_path)) {
            $storage_path = $this->image;
        }
        return Voyager::image($storage_path);
    }

    protected $casts = [
        'disciplines' => 'array',
        'judges' => 'array',
        'event_start_date' => 'datetime',
        'event_end_date' => 'datetime',
        'booking_start_date' => 'datetime',
        'booking_end_date' => 'datetime',
    ];
}