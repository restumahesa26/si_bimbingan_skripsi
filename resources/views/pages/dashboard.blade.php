@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</div>
@if (Auth::user()->role === 'ADMIN')
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mahasiswa
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswa }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Dosen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dosen }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mahasiswa Sudah Bimbingan</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">--</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mahasiswa Masih Bimbingan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">--</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Row-->
@endif

@if (Auth::user()->role === 'MAHASISWA' && Auth::user()->dosen_utama == NULL && Auth::user()->dosen_pendamping == NULL)
    <div class="card mb-5">
        <div class="card-body">
            <form action="{{ route('bimbingan.set-pembimbing') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="dosen_pembimbing_utama">Dosen Pembimbing Utama</label>
                    <select name="dosen_pembimbing_utama" id="dosen_pembimbing_utama" class="form-control">
                        <option value="">-- Pilih Dosen Pembimbing Utama --</option>
                        @foreach ($dosens as $item_dosen_utama)
                            <option value="{{ $item_dosen_utama->user->id }}" @if(old('dosen_pembimbing_utama') == $item_dosen_utama->user->id) selected @endif>{{ $item_dosen_utama->user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="dosen_pembimbing_pendamping">Dosen Pembimbing Pendamping</label>
                    <select name="dosen_pembimbing_pendamping" id="dosen_pembimbing_pendamping" class="form-control">
                        <option value="">-- Pilih Dosen Pembimbing Pendamping --</option>
                        @foreach ($dosens as $item_dosen_pendamping)
                            <option value="{{ $item_dosen_pendamping->user->id }}" @if(old('dosen_pembimbing_pendamping') == $item_dosen_pendamping->user->id) selected @endif>{{ $item_dosen_pendamping->user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="judul_skripsi">Judul Skripsi</label>
                    <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control" value="{{ old('judul_skripsi') }}" placeholder="Masukkan Judul Skripsi">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endif

@if (Auth::user()->role === 'MAHASISWA' && Auth::user()->dosen_utama && Auth::user()->dosen_utama->status_persetujuan === '0' )
    <div class="card">
        <div class="card-body">
            <h4>Dosen Pembimbing Utama Belum Menkonfirmasi</h4>
        </div>
    </div>
@endif

@if (Auth::user()->role === 'MAHASISWA' && Auth::user()->dosen_pendamping && Auth::user()->dosen_pendamping->status_persetujuan === '0' )
    <div class="card mt-3">
        <div class="card-body">
            <h4>Dosen Pembimbing Pendamping Belum Menkonfirmasi</h4>
        </div>
    </div>
@endif
@endsection
