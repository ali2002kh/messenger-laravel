<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit profile</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    <a href="{{route('home') }}">بازگشت</a>
    <form class="form" action="{{ route('update_profile') }}" method='Post' 
            enctype="multipart/form-data">
        @csrf
        <img src="{{ asset('storage/profile/'.$profile->image) }}">
        <div class="info">
            <label for="file">عکس پروفایل</label>
            <input type="file" class="myfile" name="file"
            value="{{ asset('storage/profile/'.$profile->image) }}"><br>
            <label for="fname">نام</label>
            <input type="text" class="fname" name="fname" placeholder="نام" required 
            value="{{ $profile->first_name }}"><br>
            <label for="lname">نام خانوادگی</label>
            <input type="text" class="lname" name="lname" placeholder="نام خانوادگی" required
            value="{{ $profile->last_name }}"><br>
            <label for="bio">بایو</label>
            <textarea name='bio' placeholder='بایو' required>{{ $profile->bio }}</textarea>
            <input type='submit' value="ثبت"  class="submit">
        </div>
    </form>
</body>
</html>