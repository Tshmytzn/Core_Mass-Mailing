<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
</head>
<body>
    {!! $mailBody !!}
    <div>
        {!! $signature !!} <!-- This will render the signature HTML -->
    </div>
</body>
</html>
