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
                    Nili
                    <a href="{{ route('show_profile', $user->id) }}">{{$user->username}}</a>
                    <a href="{{ route('logout') }}"><button>Log Out</button></a>
                </h3>
                
            </div>
            <div class="chatlist">
                @foreach ($contacts as $u) 
                    @if ($u->is_user())
                        <a class="chats" href="{{ route('chat', $u->id) }}">
                        @if ($u == $user)
                            <img src="{{ asset('storage/img/saved-messages.jpg') }}" alt="profile">
                        @else
                            <img src="{{ asset('storage/profile/'.$u->profile->image) }}" alt="profile">
                        @endif   
                    @else
                        <a class="chats" href="{{ route('group.chat', $u->id) }}">
                            <img src="{{ asset('storage/group/'.$u->image) }}" alt="group">
                    @endif
                        
                        <div class="nameandlastmassage">

                            @if ($u->is_user() && $u == $user)
                            <p class="name">Saved Messages</p><br>
                            @else
                                <p class="name">{{ $u->name() }}</p><br>
                            @endif
                        
                            @if ($u->last_message($user->id))
                                @if (!$u->is_user() || $u != $user)
                                <div class="lastmassageandsender">
                                    @if (!$u->last_message($user->id)->is_sender($user->id) && $u->last_message($user->id)->seen == false)
                                        <div class="unread"></div>
                                    @endif
                                    @if (!$u->is_user()) 
                                        @if (!$u->last_message($user->id)->is_sender($user->id))
                                            <div class="sendername">{{ $u->last_message($user->id)->sender()->name() }}: </div>
                                        @else
                                            <div class="sendername">you: </div>
                                        @endif
                                    @endif
                                    <div class="lastmassage">{{ $u->last_message($user->id)->body() }}</div>
                                </div>
                                @endif
                            @endif

                        </div>
                    </a>
                @endforeach   
            </div>
            <a class="firend" href="{{ route('friend.index') }}">
                friends
            </a>
            <a class="group" href="{{ route('group.create') }}">
                new group
            </a>
        </div>
        <div class="chat">
            @yield('chat')
        </div>
    @yield('end')
</body>
</html>