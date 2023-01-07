<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اطلاعات گروه</title>
    <link rel="stylesheet" href="../../css/friend.css">
</head>
<body>
    <a href="{{ route('group.show', $group->id) }}">بازگشت</a>
    <div class="form">
        @foreach ($friendsNotInGroup as $f)
            {{-- {{ $f->name() }} --}}
            <div class="user">
                <div class="chats">
                    <div class="chats">
                        <img src="{{ asset('storage/profile/'.$f->profile->image) }}" alt="profile">
                        <div class="nameandlastmassage">
                            <p class="name">{{ $f->name() }}</p>
                        </div>
                    </div>
                </div>
                <a href={{ route('group.add', [$group->id, $f->id]) }}>
                    <button class="user-btn">add</button>
                </a>
            </div>
        @endforeach
        {{-- <a href="{{ route('group.show', $group->id) }}">back</a> --}}
    </div>
</body>
</html>

{{-- @foreach ($friendsNotInGroup as $f)
    {{ $f->name() }}
    <a href={{ route('group.add', [$group->id, $f->id]) }}>add</a>
    <br>
@endforeach

<a href="{{ route('group.show', $group->id) }}">back</a> --}}