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
    <div class="form"> 
        <h1>جستجو</h1>
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
            @if (!$result || $result==auth()->user())
            <div class="notfound">not found</div>
            @else
            <div class="user">
                <div class="username">{{ $result->username }}</div>
                @if ($result->is_friend(auth()->id()))
                    <a href="{{ route('friend.remove', $result->id) }}">
                        <button class="user-btn">remove</button>
                    </a>
                @else
                    @if (auth()->user()->requested_to($result->id))
                        <a href="{{ route('friend.undo_request', $result->id) }}">
                            <button class="user-btn">undo</button>
                        </a>
                    @else
                        @if ($result->requested_to(auth()->id()))
                            <a href="{{ route('friend.accept', $result->id) }}">
                                <button class="user-btn">accept</button> 
                            </a>   
                        @else
                            <a href="{{ route('friend.send_request', $result->id) }}">
                                <button class="user-btn">request</button>
                            </a>
                        @endif
                    @endif
                @endif
            </div>
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
    </div>
</body>
</html>
