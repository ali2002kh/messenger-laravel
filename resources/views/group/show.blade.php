<a href={{ route('group.leave', $group->id) }}>
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

<a href="{{ route('group.chat', $group->id) }}">back</a>