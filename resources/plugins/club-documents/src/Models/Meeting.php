<?php
namespace Plugins\ClubDocuments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Meeting extends Model {
    protected $fillable = ['title', 'date'];

    public function documents(): HasMany {
        return $this->hasMany(Document::class);
    }
}
