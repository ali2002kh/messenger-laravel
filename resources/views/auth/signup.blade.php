<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singup</title>
    <link rel="stylesheet" href="css/singup.css">
</head>
<body>
    <form action="{{ route('signup') }}" method='Post'>
        <h1>Signup Here</h1>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @csrf
        <label for="Phone">Phone Number</label>
        <input type="text" name='number' placeholder="number" id="tel" required>

        <label for="Username">Username</label>
        <input type="text" name='username' placeholder="username" id="text" required>

        <label for="password">Password</label>
        <input type="password" name='password1' placeholder="password" id="password" required>

        <label for="cpassword">Confirm Password</label>
        <input type="password" name="password2" placeholder="confirm password" id="cpassword" required>

        <button type="submit">Sign Up</button>

        <a href="{{ route('login_page') }}">Log in</a>
    </form>
</body>
</html>