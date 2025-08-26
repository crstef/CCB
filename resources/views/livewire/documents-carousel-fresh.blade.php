<div>
    <div class="p-4 bg-gray-100 rounded">
        <h2>Documents Carousel Fresh Test</h2>
        <p>Count: {{ $documents->count() }}</p>
        
        @if($documents->count() > 0)
            @php $doc = $documents->first(); @endphp
            <div class="bg-white p-3 rounded mt-2">
                <h3>{{ $doc->title }}</h3>
                <small>{{ $doc->created_at->format('d.m.Y') }}</small>
            </div>
        @endif
    </div>
</div>
