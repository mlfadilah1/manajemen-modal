<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modal extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'nama_usaha', 'jumlah_modal', 'tanggal'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
