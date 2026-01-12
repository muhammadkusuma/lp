@extends('layouts.dashboard')

@section('title', 'Edit Client')

@section('content')

    <div class="win-box">
        <div class="win-titlebar">✏️ Edit Client</div>

        <form method="POST" action="{{ route('clients.update', $client) }}" class="p-3 space-y-3 text-sm">
            @csrf
            @method('PUT')

            @include('clients.form', ['client' => $client])

            <button class="win-btn">💾 Update</button>
            <a href="{{ route('clients.index') }}" class="win-btn">⬅ Back</a>
        </form>
    </div>

@endsection
