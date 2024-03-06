@extends('master.app')

@section('header')


@endsection

@section('konten')
<div class="row">
    <div class="col-7 order-md-1 order-last">
        <div style="float: right">
            <a href="{{ route('kategori') }}">
                <button class="btn btn-warning mt-2">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </button>
            </a>
        </div>
        <h3>Tambah Data</h3>
    </div>
</div>

<section class="section">
    <div class="row" id="basic-table">
        <div class="col-md-7">
            <form action="{{route('kategori.store')}}" method="post">
                @csrf
                {{-- csrf buat securiti form --}}
                <div class="form-group">
                    <label for="basicInput">Nama kategori</label>
                    <input type="text" value="{{@old('nama_kategori')}}" name="nama_kategori" class="form-control"
                        @error('nama_kategori') is-invalid @enderror>
                    @error('nama_kategori')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <button class="btn btn-primary mt-3">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection