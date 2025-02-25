<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biaya_oprasional extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'jenis_biaya', 'jumlah', 'tipe', 'tanggal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
