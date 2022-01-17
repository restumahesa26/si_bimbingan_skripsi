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

    public function filter_dashboard(Request $request)
    {
        $query = $request->filter;

        $mahasiswa = Mahasiswa::count();
        $dosen = Dosen::count();
        $dosens = Dosen::where('status', '1')->get();
        $mhsBelumBimbingan = Mahasiswa::where('status_bimbingan', 'Masih Bimbingan')->whereMonth('updated_at', $query)->count();
        $mhsSudahBimbingan = Mahasiswa::where('status_bimbingan', 'Selesai')->whereMonth('updated_at', $query)->count();

        return view('pages.dashboard', [
            'mahasiswa' => $mahasiswa, 'dosen' => $dosen, 'dosens' => $dosens, 'mhs1' => $mhsBelumBimbingan, 'mhs2' => $mhsSudahBimbingan
        ]);
    }

    public function home()
    {
        return view('pages.home');
    }
}
