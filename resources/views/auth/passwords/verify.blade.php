<!DOCTYPE html>
<html long="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initail-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Email </title>
</head>
<body>

    <h1>HELLO {{ $user -> name }}</h1>
    <p> To verify your email pleace click the link below </p>
    <hr />

    <a href="{{ url('user/verify',$user->verifyUser->token )}}"> Verify your Email </a>
</body>
</html>
