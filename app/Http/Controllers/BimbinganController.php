<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\PembimbingPendamping;
use App\Models\PembimbingUtama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BimbinganController extends Controller
{
    public function set_pembimbing(Request $request)
    {
        $request->validate([
            'dosen_pembimbing_utama' => ['required'],
            'dosen_pembimbing_pendamping' => ['required'],
            'judul_skripsi' => ['required', 'string', 'max:255'],
        ]);

        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $item = PembimbingUtama::where('mahasiswa_id', Auth::user()->id)->first();
        $item2 = PembimbingPendamping::where('mahasiswa_id', Auth::user()->id)->first();

        if ($item == NULL && $item2 == NULL) {
            PembimbingUtama::create([
                'dosen_id' => $request->dosen_pembimbing_utama,
                'mahasiswa_id' => Auth::user()->id
            ]);

            PembimbingPendamping::create([
                'dosen_id' => $request->dosen_pembimbing_pendamping,
                'mahasiswa_id' => Auth::user()->id
            ]);

            $mahasiswa->update([
                'judul_skripsi' => $request->judul_skripsi
            ]);
        }

        return redirect()->route('dashboard');
    }

    public function show_konfirmasi_persetujuan()
    {
        $items = PembimbingUtama::where('dosen_id', Auth::user()->id)->where('status_persetujuan', '0')->get();

        $items2 = PembimbingPendamping::where('dosen_id', Auth::user()->id)->where('status_persetujuan', '0')->get();

        return view('pages.dosen.konfirmasi-persetujuan.index', [
            'items' => $items, 'items2' => $items2
        ]);
    }

    public function konfirmasi_persetujuan($id, $tipe)
    {
        if ($tipe === 'Pembimbing-Utama') {
            $item = PembimbingUtama::findOrFail($id);

            $item->status_persetujuan = '1';
            $item->save();
        }elseif ($tipe === 'Pembimbing-Pendamping') {
            $item = PembimbingPendamping::findOrFail($id);

            $item->status_persetujuan = '1';
            $item->save();
        }

        return redirect()->route('bimbingan.show_konfirmasi_persetujuan');
    }

    public function show_pembimbing_1()
    {
        $check = PembimbingUtama::where('mahasiswa_id', Auth::user()->id)->where('status_persetujuan', '1')->first();

        $check2 = Bimbingan::where('mahasiswa_id', Auth::user()->id)->where('dosen_id', $check->dosen_id)->where('status', 'Dibaca')->orWhere('status', 'Terkirim')->first();

        if ($check) {
            return view('pages.mahasiswa.pembimbing-1.index', [
                'check' => $check2
            ]);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function store_pembimbing_1(Request $request)
    {
        $request->validate([
            'bab_pembahasan' => ['required', 'string'],
            'uraian_konsultasi' => ['required', 'string'],
            'file_mahasiswa' => ['required', 'mimes:pdf', 'max:1048']
        ]);

        if ($request->file('file_mahasiswa')) {
            $value = $request->file('file_mahasiswa');
            $extension = $value->extension();
            $fileNames = uniqid('pdf_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/file-mahasiswa', $value, $fileNames);
        }

        $item = PembimbingUtama::where('mahasiswa_id', Auth::user()->id)->first();

        Bimbingan::create([
            'dosen_id' => $item->dosen_id,
            'mahasiswa_id' => Auth::user()->id,
            'bab_pembahasan' => $request->bab_pembahasan,
            'uraian_konsultasi' => $request->uraian_konsultasi,
            'file_mahasiswa' => $fileNames,
            'status' => 'Terkirim'
        ]);

        return redirect()->route('dashboard');
    }

    public function show_pembimbing_2()
    {
        $check = PembimbingPendamping::where('mahasiswa_id', Auth::user()->id)->where('status_persetujuan', '1')->first();

        $check2 = Bimbingan::where('mahasiswa_id', Auth::user()->id)->where('dosen_id', $check->dosen_id)->where('status', 'Dibaca')->orWhere('status', 'Terkirim')->first();

        if ($check) {
            return view('pages.mahasiswa.pembimbing-2.index', [
                'check' => $check2
            ]);
        }else {
            return redirect()->route('dashboard');
        }
    }

    public function store_pembimbing_2(Request $request)
    {
        $request->validate([
            'bab_pembahasan' => ['required', 'string'],
            'uraian_konsultasi' => ['required', 'string'],
            'file_mahasiswa' => ['required', 'mimes:pdf', 'max:1048']
        ]);

        if ($request->file('file_mahasiswa')) {
            $value = $request->file('file_mahasiswa');
            $extension = $value->extension();
            $fileNames = uniqid('pdf_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/file-mahasiswa', $value, $fileNames);
        }

        $item = PembimbingPendamping::where('mahasiswa_id', Auth::user()->id)->first();

        Bimbingan::create([
            'dosen_id' => $item->dosen_id,
            'mahasiswa_id' => Auth::user()->id,
            'bab_pembahasan' => $request->bab_pembahasan,
            'uraian_konsultasi' => $request->uraian_konsultasi,
            'file_mahasiswa' => $fileNames,
            'status' => 'Terkirim'
        ]);

        return redirect()->route('dashboard');
    }

    public function index_bimbingan()
    {
        $items = Bimbingan::where('dosen_id', Auth::user()->id)->orderByRaw("FIELD(status , 'Terkirim', 'Dibaca', 'Revisi', 'ACC') ASC")->get();

        return view('pages.dosen.bimbingan-mahasiswa.index', [
            'items' => $items
        ]);
    }

    public function detail_bimbingan($id)
    {
        $item = Bimbingan::where('dosen_id', Auth::user()->id)->where('id', $id)->first();

        if ($item->status === 'Terkirim') {
            $item->status = 'Dibaca';
            $item->save();
        }

        return view('pages.dosen.bimbingan-mahasiswa.show', [
            'item' => $item
        ]);
    }

    public function update_bimbingan(Request $request, $id)
    {
        $item = Bimbingan::where('dosen_id', Auth::user()->id)->where('id', $id)->first();

        $request->validate([
            'komentar_dosen' => ['required', 'string'],
            'status' => ['required', 'in:ACC,Revisi'],
            'file_dosen' => ['required', 'mimes:pdf', 'max:1048']
        ]);

        if ($request->file('file_dosen')) {
            $value = $request->file('file_dosen');
            $extension = $value->extension();
            $fileNames = uniqid('pdf_', microtime()) . '.' . $extension;
            Storage::putFileAs('public/assets/file-dosen', $value, $fileNames);
        }

        $item->status = $request->status;
        $item->komentar_dosen = $request->komentar_dosen;
        $item->file_dosen = $fileNames;
        $item->save();

        return redirect()->route('bimbingan.index_bimbingan');
    }

    public function riwayat_bimbingan()
    {
        $items = Bimbingan::where('mahasiswa_id', Auth::user()->id)->orderByRaw("FIELD(status , 'Terkirim', 'Dibaca', 'Revisi', 'ACC') ASC")->get();

        return view('pages.mahasiswa.riwayat-bimbingan.index', [
            'items' => $items
        ]);
    }

    public function riwayat_bimbingan_dosen()
    {
        $items = Bimbingan::where('dosen_id', Auth::user()->id)->orderByRaw("FIELD(status , 'Terkirim', 'Dibaca', 'Revisi', 'ACC') ASC")->get();

        return view('pages.dosen.riwayat-bimbingan.index', [
            'items' => $items
        ]);
    }

    public function monitoring_bimbingan()
    {
        $items = Bimbingan::orderByRaw("FIELD(status , 'Terkirim', 'Dibaca', 'Revisi', 'ACC') ASC")->get();

        return view('pages.admin.monitoring-bimbingan.index', [
            'items' => $items
        ]);
    }
}
