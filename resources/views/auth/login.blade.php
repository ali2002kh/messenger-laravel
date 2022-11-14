@extends('layouts.app')

@section('title')
login
@endsection

@section('content')

@include('layouts.partials.error')

<form action="{{ route('login') }}" method='Post'>
    @csrf
    <input type='text' name='number' placeholder='number' value="{{ old('number') }}">
    <input type='password' name='password' placeholder='password'>
    <input type='submit'>
</form>

<a href="{{ route('signup_page') }}">sign up</a>

@endsection