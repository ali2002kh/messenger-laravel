<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create profile</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    <form   action="{{ route('store_profile') }}" method='Post' 
            enctype="multipart/form-data">
        @csrf
        <img src="{{ asset('storage/img/default.jpg') }}">
        <input type="file" class="myfile" name="file" required><br>
        <input type="text" class="fname" name="fname" placeholder="first name" required><br>
        <input type="text" class="lname" name="lname" placeholder="last name" required><br>
        <textarea name='bio' placeholder='bio' required></textarea>
        <input type='submit'>
    </form>
</body>
</html>