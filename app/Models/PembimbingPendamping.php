<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembimbingPendamping extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id', 'mahasiswa_id', 'status_persetujuan'
    ];

    public function dosen()
    {
        return $this->hasOne(User::class, 'id', 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(User::class, 'id', 'mahasiswa_id');
    }
}
