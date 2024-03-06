<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Kategori;
use App\Models\Buku;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    //
    //     $buku = Buku::all();
    // return view('kategori.index', compact('kategori', 'buku'));
    public function app($request)
    {

        $kategori = Kategori::all();

        $buku = Buku::all();
        return view('master.dashboard', compact('kategori', 'buku'));
    }
}
