<?php
namespace Plugins\ClubDocuments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    protected $fillable = ['name'];

    public function documents(): HasMany {
        return $this->hasMany(Document::class);
    }
}
