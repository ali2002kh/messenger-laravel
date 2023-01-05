{{-- @foreach ($senders as $sender)
    {{ $sender->profile->user_id }}
    {{ auth()->user()->requested_to($sender->profile->user_id) }}
    {{ $sender->requested_to(auth()->id()) }}
    <br>
@endforeach --}}

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
    <form>
        <h1>مخاطبین</h1>
        <div class="searchbox">
            <input class="search" type="search" name="search" placeholder="   جستجو....">
            <button class="search-btn" type="submit">
                Search
            </button>
        </div>
        <ul>
            <li> مخاطبی وجود ندارد</li>
        </ul>
            <div class="chats">
                <a class="chats" href="">
                    <img src="" alt="profile">
                    <div class="nameandlastmassage">
                        <p class="name">نیما شاهرخی</p>
                    </div>
                </a>
                <button>قبول</button>
            </div>
            <div class="chats">
                <a class="chats" href="">
                    <img src="" alt="profile">
                    <div class="nameandlastmassage">
                        <p class="name">نیما شاهرخی</p>
                    </div>
                </a>
                <button>قبول</button>
            </div>
            <div class="chats">
                <a class="chats" href="">
                    <img src="" alt="profile">
                    <div class="nameandlastmassage">
                        <p class="name">نیما شاهرخی</p>
                    </div>
                </a>
                <button>قبول</button>
            </div>
    </form>
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


