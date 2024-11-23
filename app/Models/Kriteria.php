<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'data_kriteria';
    protected $primaryKey = 'id_kriteria';

    protected $fillable = [
        'kode_kriteria',
        'nama_kriteria',
        'nilai_bobot',
        'keterangan',
    ];

    public $timestamps = false;

    public function alternatifs()
    {
        return $this->belongsToMany(Alternatif::class, 'alternatif_kriteria', 'id_kriteria', 'id_alternatif')
            ->withPivot('nilai_rating');
    }
}
