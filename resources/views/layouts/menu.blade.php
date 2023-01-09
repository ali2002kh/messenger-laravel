<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="@yield('css')">
</head>
<body>
    @yield('all')
        <div class="menu">
            <div class="head">
                <h3 class="header">
                    نیلی
                    <a href="{{ route('show_profile', auth()->id()) }}">{{auth()->user()->username}}</a>
                    <a href="{{ route('logout') }}"><button>خارج شدن</button></a>
                </h3>
                
            </div>
            <div class="chatlist">
                @foreach (auth()->user()->menu() as $u) 
                    @if ($u->is_user())
                        <a class="chats" href="{{ route('chat', $u->id) }}">
                        @if ($u == auth()->user())
                            <img src="{{ asset('storage/img/saved-messages.jpg') }}" alt="profile">
                        @else
                            <img src="{{ asset('storage/profile/'.$u->profile->image) }}" alt="profile">
                        @endif   
                    @else
                        <a class="chats" href="{{ route('group.chat', $u->id) }}">
                            <img src="{{ asset('storage/group/'.$u->image) }}" alt="group">
                    @endif
                        
                        <div class="nameandlastmassage">

                            @if ($u->is_user() && $u == auth()->user())
                            <p class="name">پیام های ذخیره شده</p><br>
                            @else
                                <p class="name">{{ $u->name() }}</p><br>
                            @endif
                        
                            @if ($u->last_message(auth()->id()))
                                @if (!$u->is_user() || $u != auth()->user())
                                <div class="last-mag-box">
                                <div class="lastmassageandsender">
                                    {{-- @if (!$u->last_message(auth()->id())->is_sender(auth()->id()) && $u->last_message(auth()->id())->seen == false)
                                        <div class="unread"></div>
                                    @endif --}}
                                    @if (!$u->is_user()) 
                                        @if (!$u->last_message(auth()->id())->is_sender(auth()->id()))
                                            <div class="sendername">{{ $u->last_message(auth()->id())->sender()->name() }}: </div>
                                        @else
                                            <div class="sendername">شما: </div>
                                        @endif
                                    @endif
                                    <div class="lastmassage">{{ $u->last_message(auth()->id())->body() }}</div>
                                </div>
                                @if (!$u->last_message(auth()->id())->is_sender(auth()->id()) && $u->last_message(auth()->id())->seen == false)
                                    <div class="unread"></div>
                                 @endif
                                </div>
                                @endif
                            @endif

                        </div>
                    </a>
                @endforeach   
            </div>
            <input type="checkbox" id="hambergur-toggle">
            <label for="hambergur-toggle" class="hambergur">
                <div class="cross"> &#10006; </div>
            </label>
            <a class="firend" href="{{ route('friend.index') }}">
                دوست
            </a>
            <a class="group" href="{{ route('group.create') }}">
                ایجاد گروه
            </a>
        </div>
        <div class="chat">
            @yield('chat')
        </div>
    @yield('end')
</body>
</html>