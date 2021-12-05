<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $mahasiswa = Mahasiswa::count();
        $dosen = Dosen::count();
        $dosens = Dosen::where('status', '1')->get();
        $mhsMsBimbingan = Mahasiswa::where('status_bimbingan', 'Masih Bimbingan')->count();
        $mhsSlBimbingan = Mahasiswa::where('status_bimbingan', 'Selesai')->count();

        return view('pages.dashboard', [
            'mahasiswa' => $mahasiswa, 'dosen' => $dosen, 'dosens' => $dosens, 'mhs1' => $mhsMsBimbingan, 'mhs2' => $mhsSlBimbingan
        ]);
    }

    public function home()
    {
        return view('pages.home');
    }
}
