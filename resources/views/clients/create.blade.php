@extends('layouts.dashboard')

@section('title', 'Add Client')

@section('content')

    <div class="win-box">
        <div class="win-titlebar">➕ Add Client</div>

        <form method="POST" action="{{ route('clients.store') }}" class="p-3 space-y-3 text-sm">
            @csrf

            @include('clients.form')

            <button class="win-btn">💾 Save</button>
            <a href="{{ route('clients.index') }}" class="win-btn">⬅ Back</a>
        </form>
    </div>

@endsection
