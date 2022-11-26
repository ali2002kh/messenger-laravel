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
            <a class="chats" id="prf" href="{{ route('show_profile', $target->id) }}">
                <img src="{{ asset('storage/profile/'.$target->profile->image) }}">
                <p class="name">{{ $target->profile->first_name }} {{ $target->profile->last_name }}</p>
            </a>
            <form action="{{ route('clear', $target->id) }}" method='Post'>
                @csrf
                <button type='submit'>Clear</button>
            </form>
            <a href="{{ route('home') }}"><button>Back</button></a>
        </h3>
    </div>
    @foreach ($messages as $m) 
    @php
        $sender = $all_users->where('id', $m->sender)->first();
    @endphp
        <div 
        @if ($sender->id == $user->id)
        class="massage self"
        @else 
        class="massage other"
        @endif
        >
            {{ $m->body }}
        </div>
        {{-- <form action="{{ route('delete_message', $m->id) }}" method='Post'>
            @csrf
            <input type='submit' value="delete">
        </form> --}}
    @endforeach
@endsection