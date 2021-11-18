@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konfirmasi Persetujuan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Persetujuan</li>
    </ol>
</div>

@if ($items && $items2)
    <div class="card">
        <div class="card-body">
            <h5>Tidak ada yang perlu dikonfirmasi</h5>
        </div>
    </div>
@endif

@foreach ($items as $item)
<div class="card w-50">
    <div class="card-body">
        <p>Prodi memilih kesediaan anda menjadi Dosen Pembimbing Utama untuk Mahasiswa {{ $item->mahasiswa->nama }}</p>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalUtama">
            Lihat Detail
        </button>
    </div>
</div>
@endforeach

@foreach ($items2 as $item2)
<div class="card w-50 mt-3">
    <div class="card-body">
        <p>Prodi memilih kesediaan anda menjadi Dosen Pembimbing Pendamping untuk Mahasiswa {{ $item2->mahasiswa->nama }}</p>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPendamping">
            Lihat Detail
        </button>
    </div>
</div>
@endforeach

@foreach ($items as $ite)
<div class="modal fade" id="modalUtama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permohonan Persetujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Dimohon Kepada saudara/i untuk kesediannya sebagai Pembimbing Utama dari mahasiswa atas</p>
                <p>Nama : {{ $ite->mahasiswa->nama }}</p>
                <p>NPM : {{ $ite->mahasiswa->mahasiswa->npm }}</p>
                <p>Judul Skripsi : {{ $ite->mahasiswa->mahasiswa->judul_skripsi }}</p>
                <br>
                <p>Atas perhatiannya kami ucapkan terima kasih.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('bimbingan.konfirmasi_persetujuan', ['id' => $ite->id, 'tipe' => 'Pembimbing-Utama']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($items2 as $ite2)
<div class="modal fade" id="modalPendamping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permohonan Persetujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Dimohon Kepada saudara/i untuk kesediannya sebagai Pembimbing Pendamping dari mahasiswa atas</p>
                <p>Nama : {{ $ite->mahasiswa->nama }}</p>
                <p>NPM : {{ $ite->mahasiswa->mahasiswa->npm }}</p>
                <p>Judul Skripsi : {{ $ite->mahasiswa->mahasiswa->judul_skripsi }}</p>
                <br>
                <p>Atas perhatiannya kami ucapkan terima kasih.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('bimbingan.konfirmasi_persetujuan', ['id' => $ite->id, 'tipe' => 'Pembimbing-Pendamping']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
