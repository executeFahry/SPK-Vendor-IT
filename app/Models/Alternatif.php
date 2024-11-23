<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'alternatif_kriteria', 'id_alternatif', 'id_kriteria')
            ->withPivot('nilai_rating');
    }
}
