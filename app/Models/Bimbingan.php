<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'dosen_id', 'mahasiswa_id', 'bab_pembahasan', 'uraian_konsultasi', 'file_mahasiswa', 'file_dosen', 'komentar_dosen', 'status'
    ];

    public function dosen()
    {
        return $this->hasOne(User::class, 'id', 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->hasOne(User::class, 'id', 'mahasiswa_id');
    }

    public function pembimbing_utama()
    {
        return $this->hasOne(PembimbingUtama::class, 'dosen_id', 'dosen_id');
    }

    public function pembimbing_pendamping()
    {
        return $this->hasOne(PembimbingPendamping::class, 'dosen_id', 'dosen_id');
    }
}
