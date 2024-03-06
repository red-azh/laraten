@extends('master.app')

@section('header')


@endsection

@section('konten')
<div class="row">
    <div class="col-12 order-md-1 order-last">
        <div style="float: right">
            <a href="{{ route('books') }}">
                <button class="btn btn-warning mt-2">
                    <i class="fa fa-arrow-circle-left"></i> Kembali
                </button>
            </a>
        </div>
        <h3>Edit Data</h3>
    </div>
</div>

<section class="section">
    <div class="row" id="basic-table">
        {{-- <small class="text-danger">(*)Wajib di isi</small> --}}
        <div class="col-md-12">
            {{-- wajib ada enctype ini kalau mau uploud gambar file dll --}}
            <form action="{{route('books.update', $buku->id)}}" enctype="multipart/form-data" method="post">
                @method( 'PUT' )
                @csrf
                {{-- csrf buat securiti form --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="">
                            <label for="basicInput">Judul Buku <small class="text-danger">*</small> </label>
                            <input type="text" value="{{$buku['judul']}}" name="judul" class="form-control"
                                id="basicInput">
                            @error('judul')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="">
                            <label for="basicInput">Penulis <small class="text-danger">*</small></label>
                            <input type="text" value="{{$buku['penulis']}}" name="penulis" class="form-control"
                                id="basicInput">
                        </div>
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="">
                            <label for="basicInput">Kategori <small class="text-danger">*</small></label>
                            <select class="form-select" name="kategori">
                                <option hidden></option>
                                @foreach ($kategori as $item)
                                <option value="{{$item->id}}">{{$item['kategori']}}</option>
                                @endforeach
                                {{-- tengoklah di value dia sebenernya bisa pakai ->id juga bisa pakai ['id'] --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                        <div class="">
                            <label for="basicInput">Sampul Buku <small class="text-danger">*</small></label>
                            <input type="file" name="sampul" @error('sampul') is-invalid @enderror class="form-control">
                            <img src="{{asset('upload'). '/'. $buku->sampul}}" width="300px" alt=""
                                class=" mt-4 mb-3" />
                            @if($buku['sampul'])
                            <p class="text-danger">kalau sudah ada gak usah diganti</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <label for="">Deskripsi <small class="text-danger">*</small></label>
                    <textarea class="form-control" name="deskripsi" id="floatingTextarea2"
                        style="height: 150px">{{$buku['deskripsi']}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection