<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class analisi_pendapatan extends Model
{
    use HasFactory;
    protected $table = 'analisis_pendapatans';
    protected $fillable = [
        'user_id',
        'biaya_tetap',
        'biaya_variabel_per_unit',
        'harga_jual_per_unit',
        'bep_unit',
        'bep_rupiah',
        'total_pendapatan',
        // 'biaya_operasional',
        'total_investasi',
        'laba_bersih',
        'roi',
        'periode_analisis'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
