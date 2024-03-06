


@extends('master.app')

@section('header')


@endsection
@section('konten')
<div class="d-flex justify-content-between">
    <h4 class="mb-0">Data selengkapnya ..</h4>
<p></p>
<a href="{{route('kategori')}}">
    <button class="btn btn-warning"><i class="fa-regular fa-circle-xmark" style="margin-right: 5px"></i>Back to Home</button>
</a>
</div>

<h2 class="mt-0 ">Kategori : {{$kategori['kategori']}}</h2>



@endsection
