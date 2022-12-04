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
    <form   action="{{ route('update_profile') }}" method='Post' 
            enctype="multipart/form-data">
        @csrf
        <img src="{{ asset('storage/img/default.jpg') }}">
        <input type="file" class="myfile" name="file"
        value="{{ asset('storage/profile/'.$profile->image) }}"><br>
        <input type="text" class="fname" name="fname" placeholder="first name" required 
        value="{{ $profile->first_name }}">><br>
        <input type="text" class="lname" name="lname" placeholder="last name" required
        value="{{ $profile->last_name }}">><br>
        <textarea name='bio' placeholder='bio' required>{{ $profile->bio }}</textarea>
        <input type='submit'>
    </form>
</body>
</html>