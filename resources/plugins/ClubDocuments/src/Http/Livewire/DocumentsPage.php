<?php
namespace Plugins\ClubDocuments\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Plugins\ClubDocuments\Models\Document;
use Plugins\ClubDocuments\Models\Category;
use Plugins\ClubDocuments\Models\Meeting;

class DocumentsPage extends Component {
    use WithPagination;

    public $categoryId = null;
    public $meetingId = null;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $updatesQueryString = ['categoryId', 'meetingId', 'search', 'sortField', 'sortDirection'];

    public function sortBy($field) {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render() {
        $categories = Category::all();
        $meetings = Meeting::orderBy('date', 'desc')->get();

        $documents = Document::with(['category', 'meeting'])
            ->when($this->categoryId, fn($q) => $q->where('category_id', $this->categoryId))
            ->when($this->meetingId, fn($q) => $q->where('meeting_id', $this->meetingId))
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(9);

        return view('club-documents::livewire.documents-page', compact('categories', 'meetings', 'documents'));
    }
}
