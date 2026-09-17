@extends('layouts.staff')

@section('title', 'Staff Messages')

@section('content')
<div class="container">
    <h2 class="mb-4">Messages</h2>

    <div class="list-group">
        @foreach($messages as $m)
            <a href="{{ route('staff.messages.show', $m->id) }}" class="list-group-item list-group-item-action">{{ $m->name }} — <small class="text-muted">{{ $m->created_at->diffForHumans() }}</small>
                <div class="mt-1 text-truncate">{{ \Illuminate\Support\Str::limit($m->message, 120) }}</div>
            </a>
        @endforeach
    </div>

    <div class="mt-3">{{ $messages->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
