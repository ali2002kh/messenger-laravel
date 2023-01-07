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
    <a href="{{route('home') }}">بازگشت</a>
    <div class="form">
        <img src="{{ asset('storage/group/'.$group->image) }}"><br>
            {{-- <div class="fname">
                {{ $user->profile->first_name }}
            </div>
            <div class="lname">
                {{$user->profile->last_name }}
            </div> --}}
        <div class="info">
                تعداد اعضای گروه : {{ $group->members_count() }}<br><br> : اعضای گروه
                @foreach ($members as $u)
                    <br>
                    <div class="member">{{ $u->name() }}
                        @if (!$u->is_owner($group->id) && auth()->user()->is_owner($group->id))
                            <a href={{ route('group.remove', [$group->id, $u->id]) }}>remove</a>
                        @endif
                    </div>
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
            {{-- <div class="name">
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
            </div> --}}
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