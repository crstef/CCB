<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;

class DocumentsCarousel extends Component
{
    public $documents;
    public $currentIndex = 0;
    public $autoPlay = true;
    public $height = 'h-[400px]';

    public function mount($height = 'h-[400px]', $limit = 6)
    {
        $this->height = $height;
        $this->documents = Document::with('category')
            ->where('is_active', true)
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function nextDocument()
    {
        if ($this->documents->count() > 0) {
            $this->currentIndex = ($this->currentIndex + 1) % $this->documents->count();
        }
    }

    public function previousDocument()
    {
        if ($this->documents->count() > 0) {
            $this->currentIndex = ($this->currentIndex - 1 + $this->documents->count()) % $this->documents->count();
        }
    }

    public function goToDocument($index)
    {
        $this->currentIndex = $index;
    }

    public function render()
    {
        return view('livewire.documents-carousel');
    }
}
