@foreach ($friendsNotInGroup as $f)
    {{ $f->name() }}
    <a href={{ route('group.add', [$group->id, $f->id]) }}>add</a>
    <br>
@endforeach

<a href="{{ route('group.show', $group->id) }}">back</a>