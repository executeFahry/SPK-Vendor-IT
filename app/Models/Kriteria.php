<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MatriksKeputusan;

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

    public function matriks()
    {
        return $this->hasMany(MatriksKeputusan::class, 'id_kriteria');
    }
}
