<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatriksKeputusan;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'data_alternatif';
    protected $primaryKey = 'id_alternatif';

    protected $fillable = [
        'kode_alternatif',
        'nama_vendor',
        'pengalaman_proyek',
        'kualitas_layanan',
        'keamanan_layanan',
        'keahlian_teknis',
        'keterlibatan_tim',
    ];

    public $timestamps = false;

    public function matriks()
    {
        return $this->hasMany(MatriksKeputusan::class, 'id_alternatif',);
    }

    public function kriterias()
    {
        return $this->hasManyThrough(Kriteria::class, MatriksKeputusan::class, 'id_alternatif', 'id_kriteria');
    }
}
