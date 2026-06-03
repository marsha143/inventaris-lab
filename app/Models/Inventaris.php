<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'kategori_id',
        'kondisi_id',
        'kode_barang',
        'nama_barang',
        'merek',
        'lokasi',
        'jumlah',
        'tanggal_pengadaan',
        'keterangan',
         'foto_path',
         'dokumen_path',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class);
    }
}