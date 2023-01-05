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
                @php
                    $i = 0;
                @endphp
                @foreach ($contacts as $u) 
                    @php
                        $i++;
                    @endphp
                    @if ($u->is_user())
                        <a id="chat_{{$i}}"  class="chats" href="{{ route('chat', $u->id) }}">
                            <img src="{{ asset('storage/profile/'.$u->profile->image) }}" alt="profile">
                    @else
                        <a id="chat_{{$i}}"  class="chats" href="{{ route('group.chat', $u->id) }}">
                            <img src="{{ asset('storage/group/'.$u->image) }}" alt="group">
                    @endif
                        
                        <div class="nameandlastmassage">

                            @if ($u->is_user())
                                <p class="name">{{ $u->->name() }}</p><br>
                            @else
                                <p class="name">{{ $u->name }}</p><br>
                            @endif
                        
                            @if ($u->last_message($user->id))
                                @if (!$u->last_message($user->id)->is_sender($user->id) && $u->last_message($user->id)->seen == false) 
                                    <script>
                                        
                                        // document.getElementById("chat_{{$i}}")
                                    </script>
                                @endif
                                <div class="lastmassageandsender">
                                    <div class="sendername">{{ $u->last_message($user->id)->sender()->name() }}:</div>
                                    <div class="lastmassage">{{ $u->last_message($user->id)->body }}</div>
                                </div>
                            @endif

                        </div>
                    </a>
                @endforeach   
            </div>
            <a class="firend" href="{{ route('friend.index') }}">
                firends
            </a>
        </div>
        <div class="chat">
            @yield('chat')
        </div>
    @yield('end')
</body>
</html>