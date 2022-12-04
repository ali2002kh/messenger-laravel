@if ($user == auth()->user())
    <a href="{{ route('edit_profile') }}">edit</a>
@else
    <a href="{{route('chat', $user->id) }}">chat</a>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <form>
        <img src="{{ asset('storage/profile/'.$user->profile->image) }}">
        <div class="name">
            <div class="fname">
                {{ $user->profile->first_name }}
            </div>
            <div class="lname">
                {{$user->profile->last_name }}
            </div>
        </div>
        <div class="bio">
            {{ $user->profile->bio }}
        </div>
        <div class="username">
            {{ $user->username }}
        </div>
        <a href="{{route('chat', $user->id) }}">back</a>
    </form>
</body>
</html>