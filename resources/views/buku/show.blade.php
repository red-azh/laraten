@extends('master.app')

@section('header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('books')}}"><i class="fa fa-home"></i>Home</a></li>
        <li class="breadcrumb-item"><a href="#">buku</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$buku->judul}}</li>
    </ol>
</nav>

@endsection
@section('konten')
<div class="d-flex justify-content-between">
    <h2 class="mb-0">Detail buku</h2>
    <p></p>
    <a href="{{route('books')}}">
        <button class="btn btn-warning"><i class="fa-regular fa-circle-xmark" style="margin-right: 5px"></i>Back to
            Home</button>
    </a>
</div>


<div class="row">
    <div class="col-md-4">
        <img src="{{asset('upload'). '/'. $buku->sampul}}" width="300px" alt="" class=" mt-4 mb-3"/>
    </div>
    <div class="col-md-8" >
        <div class="table-responsive">
            <table class="table-lg">
                    <tr>
                        <th>Judul :</th>
                        <td>{{$buku['judul']}}</td>
                    </tr>
                    <tr>

                        <th>Penulis :</th>
                        <td>{{$buku['penulis']}}</td>
                    </tr>
                    <tr>

                        <th>Kategori:</th>
                        <td>{{$buku->category->kategori}}</td>
                    </tr>
                    <tr>

                        <th>Tanggal :</th>
                        <td>{{$buku->created_at->isoFormat('dddd, MMMM YYYY');}}</td>
                    </tr>
                    <tr>

                        <th>Deskripsi :</th>
                        <td>{{$buku['deskripsi']}}</td>
                    </tr>


            </table>
        </div>

    </div>
</div>




@endsection
