<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $categories = DocumentCategory::active()
            ->ordered()
            ->withCount('documents')
            ->get();

        $selectedCategory = $request->get('category');
        
        $documentsQuery = Document::with('category')
            ->orderBy('created_at', 'desc');

        if ($selectedCategory) {
            $documentsQuery->whereHas('category', function($query) use ($selectedCategory) {
                $query->where('slug', $selectedCategory);
            });
        }

        $documents = $documentsQuery->paginate(12);

        return view('documents.index', compact('documents', 'categories', 'selectedCategory'));
    }

    public function show(Document $document)
    {
        // Check if document is active
        if (!$document->is_active) {
            abort(404);
        }

        return view('documents.show', compact('document'));
    }
}
