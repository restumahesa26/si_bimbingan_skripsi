@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-flex justify-content-start">
        <a href="{{ route('bimbingan.monitoring-bimbingan') }}" class="btn btn-sm btn-primary mr-2">Kembali</a>
        <h1 class="h3 mb-0 text-gray-800">Bimbingan Mahasiswa</h1>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bimbingan.monitoring-bimbingan') }}">Bimbingan Mahasiswa</a></li>
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
                <label for="">Nama Dosen</label>
            </div>
            <div class="col-8">
                <label for="">{{ $item->dosen->nama }}</label>
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
            <b>{!! $item->uraian_konsultasi !!}</b>
        </div>
        <a href="{{ asset('storage/assets/file-mahasiswa/' . $item->file_mahasiswa) }}" class="btn btn-info" target="_blank">Lihat File Yang Dikirim Mahasiswa</a>
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
                    <label for="" class="text-danger" style="font-weight: 800">{{ $item->status }}</label>
                </div>
            </div>
            <a href="{{ asset('storage/assets/file-dosen/' . $item->file_dosen) }}" class="btn btn-info" target="_blank">Lihat File Yang Dikirim Dosen</a>

        </div>
    </div>
@endif

@endsection
