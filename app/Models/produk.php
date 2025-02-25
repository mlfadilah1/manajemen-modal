<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_produk', 'harga_jual', 'biaya_produksi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendapatan()
    {
        return $this->hasMany(Pendapatan::class);
    }
}
