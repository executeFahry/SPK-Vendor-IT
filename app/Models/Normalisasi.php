<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Normalisasi extends Model
{
    use HasFactory;

    protected $table = 'normalisasi';
    protected $primaryKey = 'id_normalisasi';
    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'nilai_normalisasi',
    ];

    public $timestamps = false;

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria');
    }
}
