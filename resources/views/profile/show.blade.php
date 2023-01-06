@if ($user == auth()->user())
    <a href="{{ route('edit_profile') }}">ویرایش</a>
@else
    <a href="{{route('chat', $user->id) }}">صفحه گفتگو</a>
@endif

@if ($request->session()->get('prev') == 'friends')
    <a href="{{route('friend.index') }}">بازگشت</a>
@else
    @if ($user == auth()->user())
        <a href="{{route('home') }}">بازگشت</a>
    @else
        <a href="{{route('chat', $user->id) }}">بازگشت</a>
    @endif
@endif

@if ($user != auth()->user())
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



{{-- شرط های بالا فقط بیرون فورم پایین کار میکنن --}}

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
    <form>
        <img src="{{ asset('storage/profile/'.$user->profile->image) }}"><br>
            {{-- <div class="fname">
                {{ $user->profile->first_name }}
            </div>
            <div class="lname">
                {{$user->profile->last_name }}
            </div> --}}
        <div class="info">
            <div class="name">
                <h3>نام</h3>
                {{ $user->profile->first_name }} {{ $user->profile->last_name }}
            </div>
            <div class="bio">
                <h3>بایو</h3>
                {{ $user->profile->bio }}
            </div>
            <div class="username">
                <h3>نام کاربری</h3>
                {{ $user->username }}
            </div>
        </div>
    </form>
</body>
</html>