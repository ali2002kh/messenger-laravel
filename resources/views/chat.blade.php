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
            @if ($target == auth()->user())
            <a class="chats" id="prf">
                <img src="{{ asset('storage/img/saved-messages.jpg') }}" alt="profile">
                <p class="name">پیام های ذخیره شده</p>
            </a>
            @else
            <a class="chats" id="prf" href="{{ route('show_profile', $target->id) }}">
                <img src="{{ asset('storage/profile/'.$target->profile->image) }}">
                <p class="name">{{ $target->name() }}</p>
            </a>
            @endif
            <form action="{{ route('clear', $target->id) }}" method='Post'>
                @csrf
                <button type='submit'>پاک کردن</button>
            </form>
            <a style="scale:1.5 " href="{{ route('home') }}"><button>&#11148;</button></a>
        </h3>
    </div>
    @foreach ($messages as $m) 
        @if ($m->is_sender(auth()->id()))
        <div class="massage self">
            <form class="delete" action="{{ route('delete_message', $m->id) }}" method='Post'>
                @csrf
                <input class="delete-btn" type='submit' value="&#10008;">
            </form>
            {{ $m->body() }}
        </div>
        @else 
        <div class="massage other">
            {{ $m->body() }}
        </div>
        @endif
    @endforeach
<form class="msgbox" id="myForm" action="{{ route('send_message', $target->id) }}" method='Post'>
    @csrf
    <textarea id="txt" name='body' placeholder='...پیام خود را بنویسید'></textarea>
    <input style="scale: 1.6" class="send" type='button' value="&#10148;" onclick="sendAndDelete()">
</form>

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