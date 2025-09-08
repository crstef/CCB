<?php

namespace Wave;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $table = 'events';
    public $guarded = [];

    protected $casts = [
        'event_start_date' => 'date',
        'booking_start_date' => 'date',
        'booking_end_date' => 'date',
        'disciplines' => 'array',
        'judges' => 'array',
    ];

    public function link()
    {
        // Since an event can have multiple categories, we'll link to the event page directly.
        // The page itself can then display all its categories.
        return url('/evenimente/' . $this->slug);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('\Wave\User', 'author_id');
    }

    public function image()
    {
        return Storage::url($this->image);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_event');
    }

    public function getStatusAttribute()
    {
        if (!$this->event_start_date) {
            return ['text' => '', 'class' => ''];
        }

        $now = Carbon::now()->startOfDay();
        $eventDate = Carbon::parse($this->event_start_date)->startOfDay();

        if ($now->isAfter($eventDate)) {
            return ['text' => 'Terminat', 'class' => 'bg-red-600'];
        } else {
            $daysRemaining = $now->diffInDays($eventDate);
            if ($daysRemaining == 0) {
                return ['text' => 'Astăzi', 'class' => 'bg-green-500 bg-opacity-90'];
            }
            $days_text = ($daysRemaining == 1) ? 'zi' : 'zile';
            return ['text' => 'Mai sunt ' . $daysRemaining . ' ' . $days_text, 'class' => 'bg-green-500 bg-opacity-90'];
        }
    }
}
