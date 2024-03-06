<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" href="css/style.css">  cara 1 menggunkan css atau js di dalam folder public--}}
    {{-- cara 2 bisa pakai asset trus tinggal ketik folder/filenya --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <h1>Header Aplikasi</h1>
    @yield('konten')
    {{-- <div>
        <p>ini tampilan dashboard</p>
    </div> --}}
    <h6>Footer Aplikasi</h6>
</body>
</html>
