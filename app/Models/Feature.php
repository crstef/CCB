<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'image',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Accessor pentru URL-ul imaginii
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Scope pentru features active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope pentru sortare
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
