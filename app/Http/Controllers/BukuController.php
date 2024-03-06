<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $buku;
    public function __construct()
    {
        $this->buku = new Buku();
    }

    public function index(Request $request)
    {

        $cari = $request->get('search');
        $mite = DB::table('buku')
            ->where('judul', 'LIKE', "%$cari%")
            ->orWhere('deskripsi', 'LIKE', "%$cari%")
            ->orWhere('penulis  ', 'LIKE', "%$cari%");  // inii buat nyari lebihdari satu field table database

        $data = Buku::all();
        return view('buku.index', compact('cari', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ngabil data keseluruhan dari table kategori
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            // max default nya itu kb
            'sampul' => 'required|mimes:jpg,png|max:500 ',
            'judul' => 'max:10|unique:buku,judul'
        ];

        // Bikin pesan error
        $messages = [
            'required' => ':attribute gak boleh kosong maseeh',
            'mimes' => ':attribute jumlah kelebihan',
            'max' => ':attribute ukuran kelebihan',
            'unique' => ':attribute ini sudah ada'
        ];

        // Eksekusi validasi
        $request->validate($rules, $messages);



        // dd($request->all());
        // rename nama gambar
        // $gambar = getClientOriginalName(); // berdasarkan nama asli file
        // $this->buku->sampul = $request->sampul;
        $gambar = $request->sampul;
        // time() buat ngasih tahu waktu nya random
        // rand() buat ngasih tau kode" random
        // $namaFile = buat bikin yang sampul buku
        $namaFile = time() . rand(100, 99) . "." . $gambar->getClientOriginalExtension(); //
        $this->buku->sampul = $namaFile;
        // $this->nama_table = $request->nama dari formnya
        $this->buku->judul = $request->judul;
        $this->buku->penulis = $request->penulis;
        $this->buku->deskripsi = $request->deskripsi;
        $this->buku->kategori_id = $request->kategori;
        // pindahllan
        $gambar->move(public_path() . '/upload', $namaFile);
        $this->buku->save();
        Alert::success('Congratulations', 'Data ini berhasil ditambah');
        return redirect()->route('books');
        // getClientOriginalExtension() ini adalah untuk  mengambil format file yang diupload, misal jpg atau png

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        //  data ke kirim atau gk (method dd)
        // dd($kategori);
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        $update = Buku::findOrFail($id);
        $update->judul = $request->judul;
        $update->deskripsi = $request->deskripsi;
        $update->penulis = $request->penulis;
        $update->kategori_id = $request->kategori;
        // Asumsi menggunakan route model binding, sehingga tidak perlu mencari buku lagi
        $rules = [
            'judul' => 'required|max:30',
            'deskripsi' => 'required|max:100',
        ];

        $messages = [
            'required' => ':attribute gak boleh kosong masseeh',
            'max' => ':attribute ukuran/jumlah tidak sesuai',
        ];

        $this->validate($request, $rules, $messages);

        // Mengecek apakah ada perubahan data
        if ($update->judul != $request->judul || $update->deskripsi != $request->deskripsi || $update->penulis != $request->penulis || $update->kategori_id != $request->kategori || $request->hasFile('sampul')) {

            // Jika ada perubahan data
            $update->judul = $request->judul;
            $update->deskripsi = $request->deskripsi;
            $update->penulis = $request->penulis;
            $update->kategori_id = $request->kategori;

            // Handle file upload
            if ($request->hasFile('sampul')) {
                $gambar = $request->sampul;
                $namaFile = time() . rand(100, 900) . "." . $gambar->getClientOriginalExtension();
                $gambar->move('upload', $namaFile);

                // Hapus file lama jika ada
                if ($update->sampul && file_exists('upload/' . $update->sampul)) {
                    unlink('upload/' . $update->sampul);
                }

                $update->sampul = $namaFile;
            }

            $update->save();

            Alert::success('Sukses', 'Data buku berhasil diupdate');
            return redirect()->route('books')->with('success', 'Data buku berhasil diupdate');
        } else {
            // Jika tidak ada perubahan data
            Alert::info('Info', 'Tidak ada perubahan pada data');
            return redirect()->route('books')->with('info', 'Tidak ada perubahan pada data');
        }
    }

    // public function update(Request $request,$id)
    // {
    //     $update = Buku::findOrFail($id);

    //     $update->nama_pegawai = $request->pegawai;

    //         $rules = [
    //             // max default nya itu kb
    //             'sampul' => 'mimes:jpg,png|max:500 ',
    //             'judul' => 'required|min:3'
    //         ];

    //         // Bikin pesan error
    //         $messages = [
    //             'required' => ':attribute gak boleh kosong maseeh',
    //             'mimes' => ':attribute jumlah kelebihan',
    //             'max' => ':attribute ukuran kelebihan',
    //             'min' => ':attribute minimal karakter'
    //         ];


    //         $request->validate($rules, $messages);
    //         if (!$request->sampul){
    //             // $update->sampul = $namaFile;
    //             // $update_table = $request->nama dari formnya
    //             $update->judul = $request->judul;
    //             $update->penulis = $request->penulis;
    //             $update->deskripsi = $request->deskripsi;
    //             $update->kategori_id = $request->kategori;
    //             // pindahllan
    //             $update->save();
    //             return redirect()->route('books');
    //         }

    //         // gimana kalau nama gambarnya sama sedangkan wujud gambarnya berbeda?
    //         // replace gambar
    //         $gambar = $request->sampul;
    //         $namaFile = time() . rand(100, 99) . "." . $gambar->getClientOriginalExtension();
    //         $gambar->move(public_path() . '/upload', $namaFile);

    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delete = Buku::findOrFail($id);
        $path = 'upload/' . $delete->sampul;
        if (File::exists($path)) {
            File::delete($path);
        }
        $delete->delete();
        Alert::success('Congratulations', 'Data ini berhasil dihapus');
        return redirect()->route('books');
    }
}
