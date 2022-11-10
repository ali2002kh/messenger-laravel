@extends('layouts.app')

@section('title')
create profile
@endsection

@section('content')

<form action="{{ route('update_profile') }}" method='Post' 
enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control" 
    value="{{ asset('storage/profile/'.$profile->image) }}">
    <input type='text' name='fname' placeholder='fname'
    value="{{ $profile->first_name }}">
    <input type='text' name='lname' placeholder='lname'
    value="{{ $profile->last_name }}">
    <textarea name='bio' placeholder='bio'>
        {{ $profile->bio }}
    </textarea>
    <input type='submit'>
</form>

@endsection