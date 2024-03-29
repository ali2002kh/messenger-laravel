<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اطلاعات گروه</title>
    <link rel="stylesheet" href="../../css/groupInfo.css">
</head>
<body>
    <div class="form">
        
        <div class="info">
            <img src="{{ asset('storage/group/'.$group->image) }}">
            <br><br>
            تنظیمات گروه
            <div class="setting">
            @if (auth()->user()->is_owner($group->id))
                <a href={{ route('group.add_page', $group->id) }}>افزودن عضو</a>
            @endif
            @if (auth()->user()->is_owner($group->id))
                <a href={{ route('group.edit', $group->id) }}>&#9998;</a>
            @endif
            <a href={{ route('group.leave', $group->id) }}>
                @if (auth()->user()->is_owner($group->id))
                    حذف گروه
                @else
                    ترک گروه
                @endif
            </a>
            <a href="{{ route('group.chat', $group->id) }}">&#11148;</a>
            </div>
        </div>
        <div class="members"><br>
        اعضای گروه
            @foreach ($members as $u)
            {{-- <div class="chats">
                <a class="chats" href="{{ route('show_profile', $s->id) }}">
                    <img src="{{ asset('storage/profile/'.$s->profile->image) }}" alt="profile">
                    <div class="nameandlastmassage">
                        <p class="name">{{ $s->name() }}</p>
                    </div>
                </a>
                <a href="{{ route('friend.deny', $s->id) }}"><button class="reject-btn">&#10008;</button></a>
                <a href="{{ route('friend.accept', $s->id) }}"><button class="accept-btn">&#10004;</button></a>
            </div> --}}
                {{-- <a class="chats"
                @if ($u->id != auth()->id())
                    href="{{ route('show_profile', $u->id) }}"
                @endif
                > --}}
                <div class="member">
                <a class="chats" href="{{ route('show_profile', $u->id) }}">
                <img src="{{ asset('storage/profile/'.$u->profile->image) }}" alt="profile">
                    <p class="name">{{ $u->name() }}</p>
                </a>
                @if (!$u->is_owner($group->id) && auth()->user()->is_owner($group->id))
                    <a class="remove-btn" href={{ route('group.remove', [$group->id, $u->id]) }}>حذف</a>
                @endif
                </div>
                {{-- <div class="member">{{ $u->name() }}
                    @if (!$u->is_owner($group->id) && auth()->user()->is_owner($group->id))
                        <a href={{ route('group.remove', [$group->id, $u->id]) }}>&#10008;</a>
                    @endif
                </div> --}}
            @endforeach
            </div>
    </div>
</body>
</html>


{{-- <a href={{ route('group.leave', $group->id) }}>
@if (auth()->user()->is_owner($group->id))
    delete group
@else
    leave group
@endif
</a>

<br>

@if (auth()->user()->is_owner($group->id))
    <a href={{ route('group.edit', $group->id) }}>edit group</a>
@endif

<br>

@if (auth()->user()->is_owner($group->id))
    <a href={{ route('group.add_page', $group->id) }}>add member</a>
@endif

<br>

@foreach ($members as $u)
    {{ $u->name() }}
    @if (!$u->is_owner($group->id) && auth()->user()->is_owner($group->id))
        <a href={{ route('group.remove', [$group->id, $u->id]) }}>remove</a>
    @endif
    <br>
@endforeach

{{ $group->members_count() }}

<br>

<a href="{{ route('group.chat', $group->id) }}">back</a> --}}