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
    $sender = $all_users->where('id', $m->sender)->first();
@endphp
    {{ $sender->username }}:
    {{ $m->body }}
    <form action="{{ route('delete_message', $m->id) }}" method='Post'>
        @csrf
        <input type='submit' value="delete">
    </form>
    <br>
@endforeach

<hr>
<form action="{{ route('send_message', $target->id) }}" method='Post'>
    @csrf
    <textarea id="txt" name='body' placeholder='type your message...'></textarea>
    <input type='submit' value="send">
</form>
<hr>
<form action="{{ route('clear', $target->id) }}" method='Post'>
    @csrf
    <input type='submit' value="clear history">
</form>

<script>
    refresh()
    document.getElementById('txt').addEventListener('keydown', function(e) {
        clearInterval(interval)
        refresh()
    })
    function refresh() {
        interval = setInterval(() => {
            if (document.getElementById('txt').value == '') {
                location.reload()
            }
        },10000)
    }
</script>

@endsection