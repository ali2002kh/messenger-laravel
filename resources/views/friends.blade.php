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
        <h2>دوستان</h2>
        <div class="searchbox">
            <form class="search-div" action="{{ route('friend.search') }}" method='Post'>
                @csrf
                <input class="search" type="search" name="search" placeholder="   جستجو....">
                <button class="search-btn" type="submit">
                    &#128269;
                </button>
            </form>
        </div>
        @if (isset($result))
            @if (!$result || $result==auth()->user())
            <div class="notfound">یافت نشد</div>
            @else
            <div class="user">
                <div class="chats">
                    <a class="chats" href="{{ route('show_profile', $result->id) }}">
                        <img src="{{ asset('storage/profile/'.$result->profile->image) }}" alt="profile">
                        <div class="nameandlastmassage">
                            <p class="name">{{ $result->name() }}</p>
                        </div>
                    </a>
                </div>
                @if ($result->is_friend(auth()->id()))
                    <a href="{{ route('friend.remove', $result->id) }}">
                        <button class="user-btn">حذف</button>
                    </a>
                @else
                    @if (auth()->user()->requested_to($result->id))
                        <a href="{{ route('friend.undo_request', $result->id) }}">
                            <button class="user-btn">لغو</button>
                        </a>
                    @else
                        @if ($result->requested_to(auth()->id()))
                            <a href="{{ route('friend.accept', $result->id) }}">
                                <button class="user-btn">قبول</button> 
                            </a>   
                        @else
                            <a href="{{ route('friend.send_request', $result->id) }}">
                                <button class="user-btn">درخواست</button>
                            </a>
                        @endif
                    @endif
                @endif
            </div>
            @endif
        @endif
        <br><br>لیست درخواست ها<br><br>
        @foreach ($senders as $s)
            <div class="chats">
                <a class="chats" href="{{ route('show_profile', $s->id) }}">
                    <img src="{{ asset('storage/profile/'.$s->profile->image) }}" alt="profile">
                    <div class="nameandlastmassage">
                        <p class="name">{{ $s->name() }}</p>
                    </div>
                </a>
                <a href="{{ route('friend.deny', $s->id) }}"><button class="reject-btn">&#10008;</button></a>
                <a href="{{ route('friend.accept', $s->id) }}"><button class="accept-btn">&#10004;</button></a>
            </div>
        @endforeach
        <br>
        <a class="back-btn" href="{{route('home') }}">&#11148;</a>
    </div>
</body>
</html>
