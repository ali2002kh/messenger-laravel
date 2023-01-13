@extends('layouts.menu')

@section('title')
    panel
@endsection

@section('css')
../../css/panel.css
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
            <a class="chats" id="prf" href="{{ route('group.show', $group->id) }}">
                <img src="{{ asset('storage/group/'.$group->image) }}">
                <div class="group-name">
                <p class="name">{{ $group->name }}</p>
                <p style="font-size: 10px">تعداد اعضا: {{ $group->members_count() }} </p>
                </div>
            </a>
            @if (!auth()->user()->is_owner($group->id))
                <a href="{{ route('group.leave', $group->id) }}"><button>ترک گروه</button></a>
            @endif
            <a style="scale:1.5 " href="{{ route('home') }}"><button >&#11148;</button></a>
        </h3>
    </div>
    @foreach ($messages as $m) 
        @if ($m->is_sender(auth()->id()))
        <div class="massage self">
            <form class="delete" action="{{ route('group.delete_message', $m->id) }}" method='Post'>
                @csrf
                <input class="delete-btn" type='submit' value="&#10008;">
            </form>
            <p>{!! nl2br($m->body()) !!}</p>
        </div>
        @else 
        <div class="massage other">
            <a class="chats groups" href="{{ route('show_profile', $m->sender) }}">
                <img class="user-img" src="{{ asset('storage/profile/'.$m->sender()->profile->image) }}" alt="profile">
                <p class="name">{{ $m->sender()->name() }}</p>
            </a>
            <div>
                <p>{!! nl2br($m->body()) !!}</p>
            </div>
        </div>
        @endif
    @endforeach
<form class="msgbox" id="myForm" action="{{ route('group.send_message', $group->id) }}" method='Post'>
    @csrf
    <textarea id="txt" name='body' placeholder='type your message...'></textarea>
    <input style="scale: 1.6" class="send" type='button' value="&#10148;" onclick="sendAndDelete()">
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
    var objDiv = document.getElementById("chatpage");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
@endsection