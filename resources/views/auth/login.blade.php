<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب کاربری</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="{{ route('login') }}" method='Post'>
        <h1>ورود به حساب کاربری</h1>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @csrf
        <label for="Phone">شماره تلفن</label>
        <input id='tel' type='text' name='number' placeholder='شماره تلفن' value="{{ old('number') }}" required>

        <label for="password">رمز عبور</label>
        <input type="password" name='password' placeholder="رمز عبور" id="password" required>

        <button type="submit">ورود</button>

        <a href="{{ route('signup_page') }}">ساخت حساب کاربری</a>
    </form>
</body>
</html>

