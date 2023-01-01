{{-- @foreach ($senders as $sender)
    {{ $sender->profile->user_id }}
    {{ auth()->user()->requested_to($sender->profile->user_id) }}
    {{ $sender->requested_to(auth()->id()) }}
    <br>
@endforeach --}}

@if ($result->is_friend(auth()->id()))
    {{-- 1 --}}
@else
    @if (auth()->user()->requested_to($result->id))
        {{-- 2 --}}
    @else
        @if ($result->requested_to(auth()->id()))
            {{-- 3 --}}
        @else
            {{-- 4 --}}
        @endif
    @endif
@endif


