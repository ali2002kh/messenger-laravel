<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <div class="form">
        <img src="{{ asset('storage/profile/'.$user->profile->image) }}"><br>
        <div class="info">
            <div class="name">
                <h5>نام</h5>
                {{ $user->name() }}
            </div>
            <div class="bio">
                <h5>بایو</h5>
                {{ $user->profile->bio }}
            </div>
            <div class="username">
                <h5>نام کاربری</h5>
                {{ $user->username }}
            </div>
        </div>

        @if ($user->id == auth()->id())
            <a href="{{ route('edit_profile') }}">ویرایش</a>
        @else
            <a href="{{route('chat', $user->id) }}">صفحه گفتگو</a>
        @endif

        @if ($request->session()->get('prev') == 'friends')
            <a href="{{route('friend.index') }}">بازگشت</a>
        @else
            @if ($user->id == auth()->id())
                <a href="{{route('home') }}">بازگشت</a>
            @else
                @if ($request->session()->get('prev') == 'group.chat')
                    <a href="{{route('group.chat', $request->session()->get('group_id')) }}">بازگشت</a>
                @else
                    @if ($request->session()->get('prev') == 'group.show')
                        <a href="{{route('group.show', $request->session()->get('group_id')) }}">بازگشت</a>
                    @else
                        <a href="{{route('chat', $user->id) }}">بازگشت</a>
                    @endif
                @endif
            @endif
        @endif

        @if ($user->id != auth()->id())
            @if ($user->is_friend(auth()->id()))
                <a href="{{ route('friend.remove', $user->id) }}">
                    <button class="user-btn">remove</button>
                </a>
            @else
                @if (auth()->user()->requested_to($user->id))
                    <a href="{{ route('friend.undo_request', $user->id) }}">
                        <button class="user-btn">undo</button>
                    </a>
                @else
                    @if ($user->requested_to(auth()->id()))
                        <a href="{{ route('friend.accept', $user->id) }}">
                            <button class="user-btn">accept</button> 
                        </a>   
                    @else
                        <a href="{{ route('friend.send_request', $user->id) }}">
                            <button class="user-btn">request</button>
                        </a>
                    @endif
                @endif
            @endif
        @endif
    </div>
</body>
</html>