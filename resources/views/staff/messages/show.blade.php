@extends('layouts.staff')

@section('title', 'Message')

@section('content')
<div class="container">
    <h3>{{ $message->name }}</h3>
    <div class="text-muted mb-3">{{ $message->email }} • {{ $message->created_at->format('M d, Y h:i A') }}</div>
    <div class="card p-3">{!! nl2br(e($message->message)) !!}</div>
</div>
@endsection
