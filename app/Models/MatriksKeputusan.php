<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatriksKeputusan extends Model
{
    use HasFactory;

    protected $table = 'matriks_keputusan';
    protected $primaryKey = 'id_matriks';
    protected $fillable = ['id_alternatif', 'id_kriteria', 'nilai_rating'];

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
