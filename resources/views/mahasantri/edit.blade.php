<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($users as $user)
    @if ($idd == $user['id'])
    <li>ID : {{$user['id']}} </li>
    <li>Nama :  {{$user['nama']}}</li>
    @endif
    @endforeach
</body>
</html>
