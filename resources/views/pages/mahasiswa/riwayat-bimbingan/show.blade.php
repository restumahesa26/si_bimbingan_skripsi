@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-flex justify-content-start">
        <a href="{{ route('bimbingan.riwayat-bimbingan') }}" class="btn btn-sm btn-primary mr-2">Kembali</a>
        <h1 class="h3 mb-0 text-gray-800">Bimbingan Mahasiswa</h1>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bimbingan.index_bimbingan') }}">Bimbingan Mahasiswa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <div class="form-group row">
            <div class="col-2">
                <label for="">Nama Mahasiswa</label>
            </div>
            <div class="col-8">
                <label for="">{{ $item->mahasiswa->nama }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-2">
                <label for="">Bab Pembahasan</label>
            </div>
            <div class="col-8">
                <label for="">{{ $item->bab_pembahasan }}</label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-2">
                <label for="">Tanggal Bimbingan</label>
            </div>
            <div class="col-8">
                <label for="">{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</label>
            </div>
        </div>
        <div class="form-group">
            <p>Uraian Konsultasi</p>
            <p>{!! $item->uraian_konsultasi !!}</p>
        </div>
        <a href="{{ asset('storage/assets/file-mahasiswa/' . $item->file_mahasiswa) }}" class="btn btn-info btn-sm" target="_blank">Download File Yang Dikirim Mahasiswa</a>
    </div>
</div>
@if ($item->status == 'Revisi' || $item->status == 'ACC')
    <div class="card mt-3 mb-5">
        <div class="card-body">
            <div class="form-group row">
                <div class="col-2">
                    <label for="">Komentar Dosen</label>
                </div>
                <div class="col-8">
                    <label for="">{!! $item->komentar_dosen !!}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-2">
                    <label for="">Status</label>
                </div>
                <div class="col-8">
                    <label for="" class="text-danger">{{ $item->status }}</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-2">
                    <label for="">Tanda Tangan</label>
                </div>
                <div class="col-8">
                    <img src="{{ asset('tanda-tangan/' . $item->tanda_tangan) }}" alt="">
                </div>
            </div>
            <a href="{{ asset('storage/assets/file-dosen/' . $item->file_dosen) }}" class="btn btn-info" target="_blank">Lihat File Yang Dikirim Dosen</a>

        </div>
    </div>
@endif

@endsection
