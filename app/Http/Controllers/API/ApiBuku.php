<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ApiBuku extends Controller
{
    public function index()
    {
        $data = Buku::all();
        return response()->json([
            'status' => 'Success',
            'kategori' => $data
        ], 200);
    }

    public function show($id)
    {
        $data = Buku::findOrFail($id);
        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|integer',
        ]);

        // Simpan file sampul ke direktori yang sesuai
        $image_path = $request->file('sampul')->store('images/buku', 'public');

        // Buat buku baru
        $buku = Buku::create([
            'sampul' => $image_path,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id
        ]);

        // Berikan respons JSON dengan status dan data buku yang baru saja dibuat
        return response()->json([
            'status' => 'Success',
            'buku' => $buku
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Validasi request
        $request->validate([
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|integer',
        ]);

        // Update data buku
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
        ]);

        // Jika ada file sampul yang diunggah, simpan ke direktori yang sesuai
        if ($request->hasFile('sampul')) {
            $image_path = $request->file('sampul')->store();
            $buku->sampul = $image_path;
        }

        // Simpan perubahan
        $buku->save();

        // Berikan respons JSON dengan status dan data buku yang telah diperbarui
        return response()->json([
            'status' => 'Success',
            'buku' => $buku
        ], 200);
    }

    public function destroy($id)
    {
        $data = Buku::findOrFail($id);
        $data->delete();
        return response()->json([
            'status' => 'Success',
            'buku' => $data
        ], 200);
    }

}
