<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش گروه</title>
    <link rel="stylesheet" href="../../css/edit.css">
</head>
<body>
    <a href="{{route('home') }}">بازگشت</a>
    <form   action="{{ route('group.update', $group->id) }}" method='Post' 
            enctype="multipart/form-data">
        @csrf
        <img src="{{ asset('storage/group/'.$group->image) }}">
        <div class="info">
            <label for="file">عکس گروه</label>
            <input type="file" class="myfile" name="file"
            value="{{ asset('storage/profile/'.$group->image) }}"><br>
            <label for="name">نام گروه</label>
            <input type="text" class="fname" name="name" placeholder="نام گروه" required 
            value="{{ $group->name }}"><br>
            <label for="info">یادداشت</label>
            <textarea name='info' placeholder='یادداشت' required>{{ $group->info }}</textarea>
            <input type='submit' value="ثبت"  class="submit">
        </div>
    </form>
</body>
</html>