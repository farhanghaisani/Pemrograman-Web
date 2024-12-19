@extends('layouts.app')

@section('title', 'Rumah List')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Available Rumahs</h1>

    @foreach ($rumahs as $rumah)
        <div class="mb-4 border-b pb-4">
            <div class="flex items-center">
                <img src="{{ $rumah->image_url }}" alt="{{ $rumah->name }}" class="w-20 h-20 rounded-md mr-4">
                <div>
                    <h2 class="text-xl font-semibold">{{ $rumah->name }}</h2>
                    <p class="text-gray-600">{{ $rumah->category }}</p>
                    <p class="text-gray-800 font-bold">Price Range: {{ $rumah->price_range }}</p>
                </div>
            </div>
            <p class="mt-2">{{ $rumah->description }}</p>

            <div class="mt-4">
                <a href="{{ route('rumahs.show', $rumah->id) }}" class="text-blue-600 hover:underline">View Details</a>
            </div>
        </div>
    @endforeach

    <div class="mt-6">
        {{ $rumahs->links() }}
    </div>
</div>
@endsection