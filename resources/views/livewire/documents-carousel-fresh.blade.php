<div>
    <div class="p-4 bg-gray-100 rounded">
        <h2>Documents Carousel Fresh Test</h2>
        <p>Count: {{ $documents->count() }}</p>
        
        <div class="flex gap-2 mt-2">
            @foreach($documents as $document)
                <div class="bg-white p-3 rounded">
                    <h3>{{ $document->title }}</h3>
                    <small>{{ $document->created_at->format('d.m.Y') }}</small>
                </div>
            @endforeach
        </div>
    </div>
</div>
