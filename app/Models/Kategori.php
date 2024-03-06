<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = ['kategori'];
    // ngasih tau laravel buat yang
    // dipake itu tabel kategori bukan kategoris pake s
    protected $table = "kategori";
    // buat ngilangin created_at dan update_at
    public $timestamps = false;
    // protected $fillable = ['nama_kategori'];
    // protected $primaryKey = 'id_kategori';
    public function buku()
    {
        return $this->hasMany(Buku::class, 'kategori_id', 'id');
    }//buat relasi
}
