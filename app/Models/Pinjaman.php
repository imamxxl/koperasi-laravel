<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    // use HasFactory;

    protected $fillable = [
        'id', 'no_pinjaman', 'user_id', 'tanggal', 'jumlah_pinjaman', 'tenor', 'total_angsuran', 'keterangan', 'status'
    ];
}
