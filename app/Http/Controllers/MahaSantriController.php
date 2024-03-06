<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahaSantriController extends Controller
{ //parameters request itu wajib ada mau itu pake get atau post
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $mahasantri =  [
            [
                'id' => 1,
                'nama' => 'asep'
            ],
            [
                'id' => 2,
                'nama' => 'samsul'   //membuat loopingan/array di routing
            ],
            [
                'id' => 3,
                'nama' => 'bopak'
            ]
        ];
        return view('mahasantri.index',  compact('mahasantri', 'cari'));
        // compact adalah jika ada data yang mau
        // dibawa ke view dan isian compact itu harus sama kyk variable nya
        // compact harus sama dengan nama variable
        // nanti di redirect ke folder view
    }



    // editt
    public function getid($id) #kalo pakai array asosiatif yang dipanggil si parameter
    {
        $idd = $id; #nama variabel dan compact harus sama

        $users = [
            [
                'id' => 1,
                'nama' => 'Basuki'
            ],
            [
                'id' => 2,
                'nama' => 'Cahya'
            ],
            [
                'id' => 3,
                'nama' => 'Purnama'
            ],
        ];

        return view('mahasantri', compact('users')); #untuk redirect

    }

    public function cari(Request $request)
    {
        $cari = $request->get('cari');
        return view('mahasantri', compact('cari'));
    }

    public function kategori()
    {
        return view('master.kategori');
    }
}
