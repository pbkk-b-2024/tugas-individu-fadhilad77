@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <!-- Grid layout untuk ucapan selamat datang yang mengikuti ukuran web -->
    <div class="bg-gradient-to-r from-gray-700 via-gray-500 to-gray-300 shadow-lg rounded-lg mt-8">
        <div class="p-8 text-white text-center grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col justify-center">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-4">
                    Welcome to Exposure Photograph Catalog!
                </h1>
                <p class="text-lg md:text-xl lg:text-2xl">
                    Explore the finest collections and capture the moments that last forever.
                </p>
                <div class="mt-6">
                    <a href="{{ route('photography.photos.index') }}" class="bg-white text-gray-700 font-bold py-3 px-6 rounded-lg shadow hover:bg-gray-300 transition duration-300">
                        Start Exploring
                    </a>
                </div>
            </div>
            <div class="hidden md:block">
                <img src="{{ Storage::url('OWN08697-Enhanced-NR.jpg') }}" alt="Photography" class="w-full h-auto rounded-lg">
            </div>
        </div>
    </div>
@endsection
