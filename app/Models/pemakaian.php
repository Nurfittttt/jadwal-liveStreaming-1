<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class pemakaian extends Model
{
    use HasFactory;
    protected $table = 'pemakaian';
    protected $fillable = [
        'Nama_Pemakaian','Nama_barang','tanggal_pakai','jam_mulai','jam_selesai', 'keterangan','pj_pemakaian'
    ];
}