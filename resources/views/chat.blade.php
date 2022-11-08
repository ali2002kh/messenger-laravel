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
<form id="myForm" action="{{ route('send_message', $target->id) }}" method='Post'>
    @csrf
    <textarea id="txt" name='body' placeholder='type your message...'></textarea>
    <input type='button' value="send" onclick="sendAndDelete()">
</form>
<hr>
<form action="{{ route('clear', $target->id) }}" method='Post'>
    @csrf
    <input type='submit' value="clear history">
</form>

<script>
    var txt = document.getElementById('txt')
    refresh()
    txt.addEventListener('keyup', function(e) {
        clearInterval(interval)
        refresh()
        localStorage.setItem('txt', txt.value)
    })

    function old(v) { 
        if (!localStorage.getItem(v)) {
            return ""
        } else {
            return localStorage.getItem(v)
        }
    }

    txt.value = old("txt")

    function refresh() {
        interval = setInterval(() => {
            if (txt.value == '') {
                location.reload()
            }
        },5000)
    }

    setTimeout(() => {
        location.reload()
    }, 30000);

    function sendAndDelete() {
        localStorage.removeItem('txt')
        document.getElementById('myForm').submit()
    }
</script>

@endsection