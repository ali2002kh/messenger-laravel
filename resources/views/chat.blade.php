@extends('layouts.menu')

@section('title')
    panel
@endsection

@section('css')
../css/panel.css
@endsection

@section('all')
<div class="all">
@endsection

@section('end')
</div>
@endsection

@section('chat')
    <div class="head">
        <h3 class="header">
            <a class="chats" id="prf" href="{{ route('show_profile', $target->id) }}">
                <img src="{{ asset('storage/profile/'.$target->profile->image) }}">
                <p class="name">{{ $target->profile->first_name }} {{ $target->profile->last_name }}</p>
            </a>
            <form action="{{ route('clear', $target->id) }}" method='Post'>
                @csrf
                <button type='submit'>Clear</button>
            </form>
            <a href="{{ route('home') }}"><button>Back</button></a>
        </h3>
    </div>
    @foreach ($messages as $m) 
        <div 
        @if ($m->is_sender($user->id))
        class="massage self"
        @else 
        class="massage other"
        @endif
        >
            {{ $m->body }}
        </div>
        {{-- <form action="{{ route('delete_message', $m->id) }}" method='Post'>
            @csrf
            <input type='submit' value="delete">
        </form> --}}
    @endforeach
    {{-- <div class="msgbox">
        <textarea></textarea>
        <div class="send"><a>send</a></div>
    </div> --}}
    {{-- <hr> --}}
<form class="msgbox" id="myForm" action="{{ route('send_message', $target->id) }}" method='Post'>
    @csrf
    <textarea id="txt" name='body' placeholder='type your message...'></textarea>
    <input class="send" type='button' value="send" onclick="sendAndDelete()">
</form>
{{-- <hr> --}}
{{-- <form action="{{ route('clear', $target->id) }}" method='Post'>
    @csrf
    <input type='submit' value="clear history">
</form> --}}

<script>
    // var txt = document.getElementById('txt')
    // // refresh()
    // txt.addEventListener('keyup', function(e) {
    //     clearInterval(interval)
    //     refresh()
    //     localStorage.setItem('txt', txt.value)
    //     var cursorPosition = txt.selectionStart
    //     localStorage.setItem('cursor', cursorPosition)
    // })

    // function old(v) { 
    //     if (!localStorage.getItem(v)) {
    //         return ""
    //     } else {
    //         return localStorage.getItem(v)
    //     }
    // }

    // txt.focus()
    // txt.value = old("txt")
    // txt.selectionEnd = localStorage.getItem('cursor')

    // function refresh() {
    //     interval = setInterval(() => {
    //         if (txt.value == '') {
    //             location.reload()
    //         }
    //     },3000)
    // }

    // setTimeout(() => {
    //     location.reload()
    // }, 5000);

    function sendAndDelete() {
        var x = document.forms["myForm"]["body"].value;
        if (!(x == "" || x == null)){
            localStorage.removeItem('txt')
            document.getElementById('myForm').submit()
        }
    }
</script>
@endsection