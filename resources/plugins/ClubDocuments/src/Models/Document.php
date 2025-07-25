<?php
namespace Plugins\ClubDocuments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model {
    protected $fillable = ['title', 'file_path', 'category_id', 'meeting_id'];

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function meeting(): BelongsTo {
        return $this->belongsTo(Meeting::class);
    }
}
