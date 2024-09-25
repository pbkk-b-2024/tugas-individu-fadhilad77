@extends('layouts.app')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-semibold mb-4">Photos</h1>

    @can('create', App\Models\Photo::class)
        <a href="{{ route('photography.photos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Upload New Photo
        </a>
    @endcan

    <!-- Grid layout untuk foto -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @forelse($photos as $photo)
            <!-- Card foto dengan gambar tidak terpotong -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Menampilkan gambar dengan object-contain -->
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="{{ $photo->title }}" class="w-full h-48 object-contain">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $photo->title }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($photo->description, 100) }}</p>
                    <a href="#" class="text-blue-600 hover:underline">View Details</a>

                    @can('delete', $photo)
                        <!-- Form untuk menghapus foto -->
                        <form action="{{ route('photography.photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">No photos available.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $photos->links() }}
    </div>
</div>
@endsection
