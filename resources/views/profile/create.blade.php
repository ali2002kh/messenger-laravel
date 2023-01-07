<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ساخت پروفایل</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    <form class="form"  action="{{ route('store_profile') }}" method='Post' 
            enctype="multipart/form-data">
        @csrf
        <img src="{{ asset('storage/img/default.jpg') }}">
        <div class="info">
            <label for="file">عکس پروفایل</label>
            <input type="file" class="myfile" name="file" required><br>
            <label for="fname">نام</label>
            <input type="text" class="fname" name="fname" placeholder="نام" required><br>
            <label for="lname">نام خانوادگی</label>
            <input type="text" class="lname" name="lname" placeholder="نام خانوادگی" required><br>
            <label for="bio">بایو</label>
            <textarea name='bio' placeholder='بایو' required></textarea>
            <input type='submit' value="ثبت" class="submit">
        </div>
    </form>
</body>
</html>