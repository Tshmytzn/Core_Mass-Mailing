<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        .staff {
            background: url("{{ asset('brochure_img/staff.png') }}") no-repeat center center fixed;
            background-size: auto 100%;
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="staff"></div>

    <div>
        {!! $signature !!} <!-- This will render the signature HTML -->
    </div>
</body>

</html>
