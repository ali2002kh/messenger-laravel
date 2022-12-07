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
                @foreach ($users as $u) 
                    <a id="chat_{{$u->id}}"  class="chats" href="{{ route('chat', $u->id) }}">
                        <img src="{{ asset('storage/profile/'.$u->profile->image) }}" alt="profile">
                        <div class="nameandlastmassage">
                        <p class="name">{{ $u->profile->first_name }} {{ $u->profile->last_name }}</p><br>
                    

                    @if ($u->last_message($user->id))
                        @php
                            $sender = $all_users->find($u->last_message($user->id)->sender)
                        @endphp
                        @if ($sender != auth()->user() && $u->last_message($user->id)->seen == false) 
                            <script>
                                
                                // document.getElementById("chat_{{$u->id}}")
                            </script>
                        @endif
                        {{ $sender->username }}:
                        {{ $u->last_message($user->id)->body }}
                    @endif
                        </div>
                    </a>
                @endforeach   
            </div>
        </div>
        <div class="chat">
            @yield('chat')
        </div>
    @yield('end')
</body>
</html>