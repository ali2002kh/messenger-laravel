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
<hr>
@endforeach


@endsection