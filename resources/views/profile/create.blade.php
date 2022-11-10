@extends('layouts.app')

@section('title')
create profile
@endsection

@section('content')

<form action="{{ route('store_profile') }}" method='Post' 
enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control">
    <input type='text' name='fname' placeholder='fname'>
    <input type='text' name='lname' placeholder='lname'>
    <textarea name='bio' placeholder='bio'></textarea>
    <input type='submit'>
</form>

@endsection