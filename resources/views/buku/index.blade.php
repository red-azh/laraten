@extends('master.app')

@section('header')









@endsection


@section('konten')

{{-- kalau data berhasil di simpan maka akan tampil pesan alert
dan memakai if > session(isi dari functionnnya with) --}}
{{-- alert --}}
{{-- @if (session('status'))
<div class="alert alert-success alert-dismissible show fade">
    <i class="fa fa-circle-check"></i>{{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif --}}

{{-- <table class="table mb-0">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Buku</th>
            <th></th>

        </tr>
    </thead>
    {{$tes}}
    <tbody>
        @php
        $no = 1;
        @endphp

        @foreach ($data as $buku)
        kalo pake query builder, gunakan ->

        <tr>
            <td>{{ $no++ }}</td>
            <td> {{$buku['buku']}}</td>

            <td class="text-end">
                {{--tombol detail
                <a href="{{ route('kategori.show', $kategori->id) }}">
                    <button type="button" class="btn btn-primary"><i class="bi bi-info-circle"></i></button></a>
                <a href="{{ route('kategori.update', $kategori->id) }}">
                    <button type="button" class="btn btn-warning"><i class="bi bi-pencil"></i></button>
                </a>
                <a href="{{route('kategori.hapus', $kategori->id)}}">
                    <button type="button" class="btn btn-danger " onclick="return confirm('Yakin nih?')"><i
                            class="bi bi-trash"></i></button>
                </a>
                onclick = return confrim() buat bikin kykk funggsi alert di javascript
            </td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">{{ $data->links() }}</td>
        </tr>
    </tfoot>
</table> --}}

<h3>Data Buku</h3>
<div class="d-flex justify-content-between">
    <div>
        <a href="{{url('buku/create')}}">
            <button class="btn btn-success"><i class="fa fa-plus-circle"></i> tambah data</button>
        </a>
    </div>


    <p></p>
    <form action="{{route('books')}}" method="get">
        <div class="d-flex">
            <input type="text" class="form-control m-0" placeholder="Search" style="width: 200px">
            <button type="submit" name="search" class="btn btn-success">
                <i class="fa fa-search me-1"></i>Cari
            </button>
        </div>
    </form>
</div>

<div class="table-responsive">
    <table class="table table-lg">
        <thead>
            <tr>
                <th>#</th>
                <th>Sampul Buku</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th style="width: 40%">Deskripsi</th>
                <th style="width: 20%"></th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $item)
            <tr>
                <td class="text-bold-500">{{$no++}}</td>
                <td>
                    <img src="{{asset('upload'). '/'. $item->sampul}}" alt="" width=80 height=100
                        class="rounded-circle" />
                </td>
                <td>{{$item->judul}}</td>
                <td>{{$item->penulis}}</td>
                {{-- ini fungsi buat nampilin nama kategori category di dapat dari models(nama fungsinya) --}}
                <td>{{$item->category->kategori}}</td>
                <td>@if (Str::length($item->deskripsi) > 100)
                    {{ substr($item->deskripsi, 0 , 100). '[...]'}}
                    @else
                    {{$item->deskripsi}}
                    @endif
                </td>


                <td class="text-end">
                    <a href="{{ route('books.show', $item->id) }}">
                        <button type="button" class="btn btn-primary" style="margin-right:5px;"><i
                                class="bi bi-info-circle"></i></button></a>
                    <a href="{{route('books.edit', $item->id)}}">
                        <button type="button" class="btn btn-warning" style="margin-right:5px;"><i
                                class="bi bi-pencil"></i></button>
                    </a>
                    <a href="{{route('books.hapus', $item->id)}}">
                        <button type="button" class="btn btn-danger" onclick="return confirm('Yakin nih?')"><i
                                class="bi bi-trash"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>





@endsection
