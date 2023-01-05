<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>firend</title>
    <link rel="stylesheet" href="css/friend.css">
</head>
<body>
    {{-- <form> --}}
        <h1>مخاطبین</h1>
        <div class="searchbox">
            <form action="{{ route('friend.search') }}" method='Post'>
                @csrf
                <input class="search" type="search" name="search" placeholder="   جستجو....">
                <button class="search-btn" type="submit">
                    Search
                </button>
            </form>
        </div>
        @if (isset($result))
            @if (!$result)
            <ul>
                <li>not found</li>
            </ul>
            @else
            <ul>
                <li>{{ $result->username }}</li>
            </ul>
            @endif
        @endif
        @foreach ($senders as $s)
            <div class="chats">
                <a class="chats" href="{{ route('show_profile', $s->id) }}">
                    <img src="{{ asset('storage/profile/'.$s->profile->image) }}" alt="profile">
                    <div class="nameandlastmassage">
                        <p class="name">{{ $s->name() }}</p>
                    </div>
                </a>
                <a href="{{ route('friend.deny', $s->id) }}"><button>رد</button></a>
                <a href="{{ route('friend.accept', $s->id) }}"><button>قبول</button></a>
            </div>
        @endforeach
    {{-- </form> --}}
</body>
</html>

{{-- @if ($result->is_friend(auth()->id())) --}}
    {{-- 1 --}}
{{-- @else --}}
    {{-- @if (auth()->user()->requested_to($result->id)) --}}
        {{-- 2 --}}
    {{-- @else --}}
        {{-- @if ($result->requested_to(auth()->id())) --}}
            {{-- 3 --}}
        {{-- @else --}}
            {{-- 4 --}}
        {{-- @endif --}}
    {{-- @endif --}}
{{-- @endif --}}


