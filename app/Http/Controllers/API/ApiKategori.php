<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiKategori extends Controller
{
    public function getData()
    {
        // $data = [
        //     [
        //         'id' => 1,
        //         'name' => 'Samson'

        //     ],
        //     [
        //         'id' => 2,
        //         'name' => 'Samsun'

        //     ],
        //     [
        //         'id' => 3,
        //         'name' => 'Samsen'

        //     ],

        // ];
        $data = Kategori::all();
        // ini yang membedakan dengan route web
        // kalao API salah satunya bisa dibikin json datanya
        return  response()->json([
            'status' => 'Success',
            'family' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Kategori::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'kategori' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $data = Kategori::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'kategori' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        //ada validasi
        $validate = Validator::make($request->all(), [
            'nama_kategori' => 'required|min:3|max:20'
        ]);

        //cek kalau validasi nya bermasalah
        if ($validate->fails()) {
            return response()->json([$validate->errors(), 422]);
        }

        //simpen data
        $kategori = Kategori::create([
            'kategori' => $request->nama_kategori
        ]);

        //return (created)
        return response()->json([
            'status' => 'Success',
            'kategori' => $kategori
        ], 201);
    }

    public function update(Request $request,  $id)
    {
        //ada validasi
        $validate = Validator::make($request->all(), [
            'nama_kategori' => 'required|min:3|max:20|unique:kategori,kategori'
        ]);

        //cek kalau validasi nya bermasalah
        if ($validate->fails()) {
            return response()->json([$validate->errors(), 422]);
        }

        $kategori = Kategori::findOrFail($id);
        //simpen data
        $kategori->update([
            'kategori' => $request->nama_kategori
        ]);

        //return (created)
        return response()->json([
            'status' => 'Success',
            'kategori' => $kategori
        ], 200);
    }
}
