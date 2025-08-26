<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;

class DocumentsCarouselFresh extends Component
{
    public $documents;
    public $currentIndex = 0;
    public $autoPlay = true;
    public $height = 'h-[400px]';

    public function mount($height = 'h-[400px]', $limit = 10)
    {
        $this->height = $height;
        $this->documents = Document::with('category')
            ->where('is_active', true)
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function render()
    {
        return view('livewire.documents-carousel-fresh');
    }
}
