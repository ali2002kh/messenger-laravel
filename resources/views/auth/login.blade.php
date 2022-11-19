<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="{{ route('login') }}" method='Post'>
        <h1>Login Here</h1>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @csrf
        <label for="Phone">Phone Number</label>
        <input id='tel' type='text' name='number' placeholder='number' value="{{ old('number') }}" required>

        <label for="password">Password</label>
        <input type="password" name='password' placeholder="password" id="password" required>

        <button type="submit">Log In</button>

        <a href="{{ route('signup_page') }}">Sing Up</a>
    </form>
</body>
</html>

