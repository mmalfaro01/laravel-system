@extends('layouts.admin')

@section('title', 'Message')

@section('content')
<div class="page-panel p-3">
    <div class="row">
        <div class="col-md-4">
            <div class="list-group">
                @foreach($messages as $m)
                    <a href="{{ route('admin.messages.show', $m->id) }}" class="list-group-item list-group-item-action bg-dark border-secondary text-white {{ $m->id === $message->id ? 'active' : '' }}">
                        <div class="d-flex justify-content-between">
                            <div><strong>{{ $m->name }}</strong><div class="small text-muted">{{ $m->email }}</div></div>
                            <div class="small text-muted">{{ $m->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="mt-1 text-truncate">{{ \Illuminate\Support\Str::limit($m->message, 120) }}</div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h4 class="mb-0">{{ $message->name }}</h4>
                            <div class="small text-muted">{{ $message->email }} • {{ $message->created_at->format('M d, Y h:i A') }}</div>
                        </div>
                        <div>
                            {{-- Message delete not implemented; disable button for now. --}}
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this message?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" data-confirm="Delete this message?" class="btn btn-sm btn-danger btn-delete">Delete</button>
                                </form>
                        </div>
                    </div>
                    <div class="mb-3">{!! nl2br(e($message->message)) !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
