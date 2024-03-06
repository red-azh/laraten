@extends('master.app')

@section('header')
<p class="mb-0">Selamat datang</p>
<h3>Aplikasi....</h3>

@endsection


@section('konten')
<h3>Data ..</h3>


<div class="table-responsive">
    <table class="table table-lg">
        <thead>
            <tr>
                <th>NAME</th>
                <th>RATE</th>
                <th>SKILL</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-bold-500">Michael Right</td>
                <td>$15/hr</td>
                <td class="text-bold-500">UI/UX</td>
                <td class="text-end">
                    <a href="">
                        <button type="button" class="btn btn-primary" style="margin-right:5px;"><i
                                class="bi bi-info-circle"></i></button></a>
                    <a href="">
                        <button type="button" class="btn btn-warning" style="margin-right:5px;"><i
                                class="bi bi-pencil"></i></button>
                    </a>
                    <a href="">
                        <button type="button" class="btn btn-danger " onclick="return confirm('Yakin nih?')"><i
                                class="bi bi-trash"></i></button>
                    </a>
                </td>

            </tr>
        </tbody>
    </table>
</div>





@endsection
