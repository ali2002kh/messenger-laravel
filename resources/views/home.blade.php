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
<a href="{{ route('chat', $u->id) }}">
    {{ $u->username }}
</a>
<br>

@if ($u->last_message($user->id))
    @php
        $sender = $all_users
        ->where('id', $u->last_message($user->id)->sender)
        ->first();
    @endphp
    {{ $sender->username }}:
    {{ $u->last_message($user->id)->body }}
@endif

<hr>
@endforeach


@endsection