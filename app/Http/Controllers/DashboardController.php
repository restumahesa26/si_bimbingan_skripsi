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

        return view('pages.dashboard', [
            'mahasiswa' => $mahasiswa, 'dosen' => $dosen, 'dosens' => $dosens
        ]);
    }
}
