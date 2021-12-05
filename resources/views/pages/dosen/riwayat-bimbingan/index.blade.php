@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Riwayat Bimbingan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Riwayat Bimbingan</li>
    </ol>
</div>

@forelse ($items as $item)
<div class="card mb-4">
    <div class="card-body">
        <h5>Nama Mahasiswa : {{ $item->mahasiswa->nama }}</h5>
        <h5>Judul Skripsi : {{ $item->mahasiswa->mahasiswa->judul_skripsi }}</h5>
        <h5>Tanggal Kirim : {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</h5>
        <h5>Topik Pembahasan : {{ $item->bab_pembahasan }}</h5>
        <h5>Status : <span class="text-primary">{{ $item->status }}</span></h5>
    </div>
</div>
@empty
    <div class="card mb-4">
        <div class="card-body">
            <h4>Belum ada riwayat bimbingan</h4>
        </div>
    </div>
@endforelse
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('uraian_konsultasi');
</script>
@endpush
