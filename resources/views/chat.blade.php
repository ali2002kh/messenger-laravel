@extends('layouts.app')

@section('title')
chat
@endsection

@section('content')

<a href="{{ route('home') }}">back</a>
<br>
{{ $target->username }}
<hr>
@foreach ($messages as $m) 
@php
    $sender = $users->where('id', $m->sender)->first();
@endphp
    {{ $sender->username }}:
    {{ $m->body }}
    <br>
@endforeach

<hr>
<form action="{{ route('send_message', $target->id) }}" method='Post'>
    @csrf
    <textarea name='body' placeholder='type your message...'></textarea>
    <input type='submit' value="send">
</form>

@endsection