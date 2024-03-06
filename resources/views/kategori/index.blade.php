@extends('master.app')

@section('header')


@endsection


@section('konten')
<h3>Data Kategori</h3>


<div class="d-flex justify-content-between">
    <a href="{{ url('/kategori/create') }}">
        <button class="btn btn-success"><i class="fa fa-plus-circle"></i> tambah data</button>
    </a>

    <p></p>


    <form action="{{route('kategori')}}" method="get" class="d-flex">

        <input type="text" class="form-control" name="search" placeholder="Search .." style="width: 200px">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-search me-1"></i>Cari
        </button>

    </form>

</div>

{{-- kalau data berhasil di simpan maka akan tampil pesan alert
dan memakai if > session(isi dari functionnnya with) --}}
{{-- alert --}}
{{-- @if (session('status'))
<div class="alert alert-success alert-dismissible show fade">
    <i class="fa fa-circle-check"></i>{{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}

{{-- output search --}}
{{-- {{$cari}} --}}
<table class="table table-md">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Kategori</th>
            <th></th>
        </tr>
    </thead>
    {{-- --}}
    {{-- {{$tes}} --}}
    <tbody>
        {{-- @php
        $no = 1;
        @endphp --}}

        @foreach ($data as $kategori)
        {{-- kalo pake query builder, gunakan -> --}}

        <tr>
            <td>{{ ++$no; }}</td>
            <td class="text-start"> {{$kategori->kategori}}</td>
            <td class="text-end">
                {{-- tombol detail --}}
                <a href="{{ route('kategori.show', $kategori->id) }}">
                    <button type="button" class="btn btn-primary"><i class="bi bi-info-circle"></i></button></a>
                <a href="{{ route('kategori.update', $kategori->id) }}">
                    <button type="button" class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                </a>
                <a href="{{route('kategori.hapus', $kategori->id)}}">
                    <button type="button" class="btn btn-danger " onclick="return confirm('Yakin nih?')"><i
                            class="bi bi-trash"></i></button>
                </a>
                {{-- onclick = return confrim() buat bikin kykk funggsi alert di javascript --}}
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>

        <tr> {{-- tambahin method query string biar bikin pagination engga ke refresh dan engga error --}}
            <td></td>
            <td></td>
            <td>{!! $data->withQueryString()->links('pagination::bootstrap-5') !!}</td>
        </tr>
    </tfoot>
</table>
{{-- {{ $data->withQueryString()->links() }} --}}
{{-- ^^ ini opsi lain dari withQueryString yang membuat
linknya tidak terrefresh jika ada perubahan data filter --}}





@endsection