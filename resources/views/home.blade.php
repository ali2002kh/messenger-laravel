@extends('layouts.app')

@section('title')
home
@endsection

@section('content')

    <a href="{{ route('logout') }}">logout</a>
    <br>
    {{$user->username}}
    <hr>
    @foreach ($users as $u) 
        <a id="chat_{{$u->id}}" href="{{ route('chat', $u->id) }}">
            {{ $u->username }}
        </a>
        <br>

        @if ($u->last_message($user->id))
            @php
                $sender = $all_users->find($u->last_message($user->id)->sender)
            @endphp
            @if ($sender != auth()->user() && $u->last_message($user->id)->seen == false) 
                <script>
                    
                    document.getElementById("chat_{{$u->id}}").style.background = red;
                </script>
            @endif
            {{ $sender->username }}:
            {{ $u->last_message($user->id)->body }}
        @endif

        <hr>
    @endforeach

    <script>
        refresh()
        function refresh() {
            interval = setInterval(() => {
                location.reload()
            },5000)
        }
    </script>

@endsection