<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class CompetitionalEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_start',
        'date_end',
        'nume_competitie',
        'locatie',
        'descriere',
        'colaborare',
        'link_inscriere_caniva',
        'is_active',
        'order',
    ];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope pentru evenimente active
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pentru evenimente ordonate
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('date_start')->orderBy('order');
    }

    /**
     * Scope pentru evenimente din anul curent competițional
     */
    public function scopeCurrentSeason($query)
    {
        $currentYear = Carbon::now()->year;
        $nextYear = $currentYear + 1;
        
        // Sezonul competițional începe în septembrie anul curent
        // și se termină în septembrie anul următor
        $seasonStart = Carbon::create($currentYear, 9, 1);
        $seasonEnd = Carbon::create($nextYear, 8, 31);
        
        return $query->whereBetween('date_start', [$seasonStart, $seasonEnd]);
    }

    /**
     * Formatează perioada evenimentului
     */
    public function getFormattedDateAttribute()
    {
        if ($this->date_end && $this->date_start->format('Y-m-d') !== $this->date_end->format('Y-m-d')) {
            // Eveniment de mai multe zile
            if ($this->date_start->format('m') === $this->date_end->format('m')) {
                // Aceeași lună
                return $this->date_start->format('d') . '-' . $this->date_end->format('d M Y');
            } else {
                // Luni diferite
                return $this->date_start->format('d M') . ' - ' . $this->date_end->format('d M Y');
            }
        } else {
            // Eveniment dintr-o singură zi
            return $this->date_start->format('d M Y');
        }
    }

    /**
     * Verifică dacă evenimentul este în viitor
     */
    public function getIsUpcomingAttribute()
    {
        return $this->date_start->isFuture();
    }

    /**
     * Verifică dacă evenimentul este în desfășurare
     */
    public function getIsOngoingAttribute()
    {
        $now = Carbon::now();
        $endDate = $this->date_end ?: $this->date_start;
        
        return $this->date_start->isPast() && $endDate->isFuture();
    }

    /**
     * Obține anul sezonului competițional curent
     */
    public static function getCurrentSeasonYear()
    {
        $currentYear = Carbon::now()->year;
        
        // Dacă suntem după septembrie, sezonul este anul curent - anul următor
        if (Carbon::now()->month >= 9) {
            return $currentYear . '-' . ($currentYear + 1);
        } else {
            // Dacă suntem înainte de septembrie, sezonul este anul trecut - anul curent
            return ($currentYear - 1) . '-' . $currentYear;
        }
    }
}