<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>

<body>
    <div>
        <img src="{{ asset('brochure_img/staff.png') }}" alt="Staff Image" style="width: 100%; height: auto;">
    </div>
    <div>
        {!! $signature !!} <!-- This will render the signature HTML -->
    </div>
</body>

</html>
