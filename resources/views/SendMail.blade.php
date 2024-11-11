<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('sendEmail')}}" method="POST">
        @csrf
        <label for="">email</label>
        <input type="email" name="mail" id="">
        <br>
        <label for="">title</label>
        <input type="text" name="title" id="">
        <br>
        <label for="">body</label>
        <textarea name="body" id="" cols="30" rows="10"></textarea>
        <br>
        <button type="submit">submit</button>
    </form>
</body>
</html>