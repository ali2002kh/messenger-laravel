<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اطلاعات گروه</title>
    <link rel="stylesheet" href="../../css/profile.css">
</head>
<body>
    <div class="form">
        <img src="{{ asset('storage/group/'.$group->image) }}"><br>
        <div class="info">
            @foreach ($members as $u)
                <br>
                <a class="chats"
                @if ($u->id != auth()->id())
                    href="{{ route('show_profile', $u->id) }}"
                @endif
                >
                <div class="member">{{ $u->name() }}
                    @if (!$u->is_owner($group->id) && auth()->user()->is_owner($group->id))
                        <a href={{ route('group.remove', [$group->id, $u->id]) }}>remove</a>
                    @endif
                </div>
                </a>
            @endforeach
            <a href={{ route('group.leave', $group->id) }}>
                @if (auth()->user()->is_owner($group->id))
                    delete group
                @else
                    leave group
                @endif
            </a>
            @if (auth()->user()->is_owner($group->id))
                <a href={{ route('group.edit', $group->id) }}>edit group</a>
            @endif
            @if (auth()->user()->is_owner($group->id))
                <a href={{ route('group.add_page', $group->id) }}>add member</a>
            @endif
            <a href="{{ route('group.chat', $group->id) }}">back</a>
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