@extends('layouts.app')

@section('title')
profile
@endsection

@section('content')

@if ($user == auth()->user())
    <a href="{{ route('edit_profile') }}">edit</a>
@else
    <a href="{{route('chat', $user->id) }}">chat</a>
@endif


<image src="{{ asset('storage/profile/'.$user->profile->image) }}">
<p>{{ $user->profile->first_name }} {{$user->profile->last_name }}</p>
<p>{{ $user->profile->bio }}</p>

@endsection