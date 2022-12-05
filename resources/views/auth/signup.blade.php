<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link rel="stylesheet" href="css/singup.css">
</head>
<body>
    <form action="{{ route('signup') }}" method='Post'>
        <h1>ساخت حساب کاربری</h1>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @csrf
        <label for="Phone">شماره تلفن</label>
        <input type="text" name='number' placeholder="شماره تلفن" id="tel" required>

        <label for="Username">نام کاربری</label>
        <input type="text" name='username' placeholder="نام کاربری" id="text" required>

        <label for="password">رمز عبور</label>
        <input type="password" name='password1' placeholder="رمز عبور" id="password" required>

        <label for="cpassword">تایید رمز عبور</label>
        <input type="password" name="password2" placeholder="تایید رمز عبو" id="cpassword" required>

        <button type="submit">ثبت نام</button>

        <a href="{{ route('login_page') }}">حساب کاربری دارم</a>
    </form>
</body>
</html>