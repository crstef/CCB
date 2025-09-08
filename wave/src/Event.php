<?php

namespace Wave;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Event extends Model
{
    use HasFactory,
        Resizable,
        Translatable;

    protected $translatable = ['title', 'excerpt', 'body', 'slug', 'meta_description', 'meta_keywords'];

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

    /**
     * Get the status details for the event (text and color).
     *
     * @return array
     */
    public function getStatusDetails(): array
    {
        $status = '';
        $statusColor = '';
        $now = now();

        if (!$this->event_start_date) {
            return ['text' => '', 'color' => ''];
        }

        $startDate = \Carbon\Carbon::parse($this->event_start_date);
        $endDate = $this->event_end_date ? \Carbon\Carbon::parse($this->event_end_date) : $startDate;

        if ($now->lt($startDate)) {
            $days_left = $now->diffInDays($startDate);
            if ($days_left === 0) {
                $status = 'Azi';
            } elseif ($days_left === 1) {
                $status = 'Maine';
            } else {
                $status = "Mai sunt {$days_left} zile";
            }
            $statusColor = 'bg-blue-600';
        } elseif ($now->between($startDate, $endDate->endOfDay())) {
            $status = 'Live';
            $statusColor = 'bg-green-600';
        } elseif ($now->gt($endDate)) {
            $status = 'Finished';
            $statusColor = 'bg-red-600';
        }

        return ['text' => $status, 'color' => $statusColor];
    }
}