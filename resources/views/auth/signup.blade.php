@extends('layouts.app')

@section('title')
signup
@endsection

@section('content')

<form action="{{ route('signup') }}" method='Post'>
    @csrf
    <input type='text' name='number' placeholder='number'>
    <input type='text' name='username' placeholder='username'>
    <input type='password' name='password1' placeholder='password'>
    <input type='password' name='password2' placeholder='confirm password'>
    <input type='submit'>
</form>

<a href="{{ route('login_page') }}">login</a>

@endsection