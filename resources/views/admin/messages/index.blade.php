@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="page-panel p-3">
    <div class="row">
        <div class="col-md-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <h5 class="mb-3">Messages</h5>
            <div class="list-group">
                @foreach($messages as $m)
                    <a href="{{ route('admin.messages.show', $m->id) }}" class="list-group-item list-group-item-action bg-dark border-secondary text-white {{ request()->is('admin/messages/'.$m->id) ? 'active' : '' }}">
                        <div class="d-flex justify-content-between">
                            <div><strong>{{ $m->name }}</strong><div class="small text-muted">{{ $m->email }}</div></div>
                            <div class="small text-muted">{{ $m->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="mt-1 text-truncate">{{ \Illuminate\Support\Str::limit($m->message, 120) }}</div>
                    </a>
                @endforeach
            </div>
            <div class="mt-3">{{ $messages->links('pagination::bootstrap-5') }}</div>
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <div class="card-body">
                    @if($selectedMessage)
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 class="mb-0">{{ $selectedMessage->name }}</h4>
                                <div class="small text-muted">{{ $selectedMessage->email }} • {{ $selectedMessage->created_at->format('M d, Y h:i A') }}</div>
                            </div>
                            <span class="badge bg-warning text-dark">Latest</span>
                        </div>
                        <div class="mb-3">{!! nl2br(e($selectedMessage->message)) !!}</div>
                    @else
                        <h5 class="mb-3">No messages yet</h5>
                        <p class="text-muted">Messages from the contact form will appear here.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
