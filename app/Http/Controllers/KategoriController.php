<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

use Illuminate\Http\Request;

use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\DB;
// untuk membuat controller yang langsung lengkap(fungsi CRUD)
//php artisan make:controller ResourceController --resource



class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $kategori;
    public function __construct()
    {
        $this->kategori = new Kategori();
    }
    public function index(Request $request)
    {
        // menampilkan data dari tabel kategori
        // menggunalan sintaks eloquent
        // $data = Kategori::all();

        // membuat search data dan jangan lupa di compact
        $cari = $request->get('search');


        // query builder nih
        $data = DB::table('kategori')
            // query where untuk sama aja kayak select * from kategori where like
            ->where('kategori', 'LIKE', "%$cari%")
            // ->orWhere('jumlah', 'LIKE', "%$cari%") // inii buat nyari lebihdari satu field table database
            ->paginate(5);
        // kalo pake pagination harus ada di ke providers dan ke app abistu
        // tambahin bootsrap" gitu. tapi kalau misalkan gamau ribet pake simplepagination aja
        $no = 5 * ($data->currentPage() - 1);
        // $tes = $data->currentPage();

        return view('kategori.index', compact('data', 'no', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // buat redirect ke form  tambah
        return view('kategori.create');
    }

    // buat nerima request dan membagikan respon

    /**
     * Store a newly created resource in storage.
     */




    public function store(Request $request)
    {
        // buat nyimpen data
        // dd($request->all()); untuk debuging, nampilin semua
        // tangkep dulu inputa user
        // dd($request->all());
        // pasangkan ke field dengan kiriman user
        // $this->kategori->kategori = $request->nama_kategori;
        // lalu simpan ke database
        // $this->kategori->save();
        // redirect
        // return redirect()->route('kategori');
        // validasi.1
        // $validated = $request->validate([
        //     'nama_kategori' => 'required'
        // ]);

        // Validasi v2 (versi ini bisa bikin kita custom pesannya apa)

        // Aturan main
        $rules = [
            // kategori berdasarkan field kategori dii database
            // format penulisan untuk fied yang unik = unique :table,field
            'nama_kategori' => 'required|min:3|max:20|unique:kategori,kategori'
            // 'jenis' => 'required|max:20|unique'
        ];

        // Bikin pesan error
        $messages = [
            'required' => ':attribute gak boleh kosong maseeh',
            'min' => ':attribute minimal harus 3 huruf',
            'max' => ':attribute nama kategori maksimal 20 huruf',
            'unique' => ':attribute ini sudah ada'
        ];

        // Eksekusi validasi
        $request->validate($rules, $messages);

        // Pasangkan ke field table kiriman user
        $this->kategori->kategori = $request->nama_kategori;

        // Simpan ke database
        $this->kategori->save();

        Alert::success('Congratulations', 'Data Berhasil di Buat');

        // Redirect
        return redirect()->route('kategori');
        // with buat mirip mirp kayak tag session di web lanjutan
    }

    /**
     * Display the specified resource.
     */

    //  parameter $id udah pasti mau nyari id database dan udah
    // pastidi route nya ada {id}
    public function show(string $id)
    {
        // untuk menampilkan data secara selengkapnya
        //kalo parameter nya id udah pasti kayak buat ngambil sesuai sama id user

        $kategori = Kategori::findOrFail($id);
        //  data ke kirim atau gk (method dd)
        // dd($kategori);
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // GET METHODNYA
    public function edit(string $id)
    {
        //  rdirect ke halaman edit
        $kategori = Kategori::findOrFail($id);
        return view('kategori.update', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    // POST METHODNYA
    public function update(Request $request, $id)
    {

        $update = Kategori::findOrFail($id);

        $update->kategori = $request->nama_kategori;
        // buat bikin perbandingan apakah data ini ada atau tidak
        if ($update->isDirty()) {
            $rules = [
                'nama_kategori' => 'required|min:3|max:20|unique:kategori,kategori'
            ];

            $messages = [
                'required' => ':attribute tidak boleh kosong ',
                'min' => ':attribute minimal harus 3 huruf',
                'max' => ':attribute maksimal hanya 20 huruf',
                'unique' => ':attribute sudah dipakai silahkan coba yang lain'
            ];


            $request->validate($rules, $messages);

            $update->kategori  = $request->nama_kategori;
            // simpan ke database
            $update->save();


            Alert::info('Congratulations', 'Data ini berhasil diupdate');

            return redirect()->route('kategori');
        } else {
            Alert::error('Ooppss!!', 'Data ini tidak diupdate');
            return redirect()->route('kategori');
        }

        // $change = $update->getChange();
        // if (!empty($change)) {
        //     # code...
        //     Alert::warning('Warning', 'Data ini tidak diupdate');
        // } else {
        // }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // hapus data berdasarkan id
        $delete = Kategori::findOrFail($id);
        // delete() = buat ngapus data
        $delete->delete();

        Alert::success('Congratulations', 'Data ini berhasil dihapus');
        // $delete->save();
        return redirect()->route('kategori');
    }

    public function history()
    {
        //
    }
}
