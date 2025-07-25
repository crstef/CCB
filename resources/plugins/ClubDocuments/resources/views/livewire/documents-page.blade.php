<div class='max-w-7xl mx-auto py-10 px-4'>
    <h1 class='text-3xl font-bold mb-6 text-gray-800'>📄 Documentele Clubului</h1>

    <div class='flex flex-wrap gap-4 mb-6'>
        <select wire:model='categoryId' class='border rounded-lg p-2'>
            <option value=''>Toate categoriile</option>
            @foreach($categories as $cat)
                <option value='{{ $cat->id }}'>{{ $cat->name }}</option>
            @endforeach
        </select>

        <select wire:model='meetingId' class='border rounded-lg p-2'>
            <option value=''>Toate ședințele</option>
            @foreach($meetings as $m)
                <option value='{{ $m->id }}'>{{ $m->title }} ({{ $m->date }})</option>
            @endforeach
        </select>

        <input type='text' wire:model='search' placeholder='Caută documente...' class='border rounded-lg p-2' />
    </div>

    <div class='grid grid-cols-1 md:grid-cols-3 gap-6'>
        @foreach($documents as $doc)
            <div class='bg-white rounded-lg shadow p-4'>
                <h3 class='font-semibold text-lg mb-2'>{{ $doc->title }}</h3>
                <p><strong>Categorie:</strong> {{ $doc->category->name }}</p>
                <p><strong>Ședință:</strong> {{ $doc->meeting->title }}</p>
                <a href='{{ asset("storage/" . $doc->file_path) }}' target='_blank' class='block mt-3 bg-blue-600 text-white text-center py-2 rounded'>
                    Descarcă
                </a>
            </div>
        @endforeach
    </div>

    <div class='mt-6'>{{ $documents->links() }}</div>
</div>
