@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-flex justify-content-start">
        <a href="{{ route('bimbingan.monitoring-bimbingan') }}" class="btn btn-sm btn-primary mr-2">Kembali</a>
        <h1 class="h3 mb-0 text-gray-800">Monitoring Mahasiswa</h1>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Monitoring Mahasiswa</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <div class="table table-responsive">
            <table class="table table-bordered text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama</th>
                        <th>Dosen</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->mahasiswa->mahasiswa->npm }}</td>
                        <td>{{ $item->mahasiswa->nama }}</td>
                        <td>{{ $item->dosen->nama }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('bimbingan.detail-monitoring-bimbingan', $item->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="7">-- Data Masih Kosong --</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
