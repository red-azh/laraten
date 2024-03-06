@extends('template')
@section('konten')
<body>
    <h2>Data Mahasantri</h2>
    <form action="{{route('santri')}}" method="get">
    <input type="text" name="cari" id="">
    <button name="">Cari</button>
    </form>



    @foreach ($mahasantri as $item)

    @if (!$cari)
    <li> {{$item['id'] ." " . $item['nama']}}</li>
    @elseif ($cari == $item['nama'])
     <li> {{$item['id'] ." " . $item['nama']}}</li>
     @endif
       @endforeach
</body>
</html>
@endsection


{{-- dibuat di loopingan foreach, parameter looping ini diambil dari
    MahasantriControlller
     --}}
