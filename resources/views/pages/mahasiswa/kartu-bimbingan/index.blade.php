@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kartu Bimbingan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kartu Bimbingan</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <div class="text-center">
            <a href="{{ route('bimbingan.show-kartu_bimbingan', 'Utama') }}" class="btn btn-primary mx-3">Kartu Bimbingan <br> Pembimbing Utama</a>
            <a href="{{ route('bimbingan.show-kartu_bimbingan', 'Pendamping') }}" class="btn btn-primary mx-3">Kartu Bimbingan <br> Pembimbing Pendamping</a>
        </div>
    </div>
</div>
@endsection
