@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Monitoring Mahasiswa</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
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
                        <th>Dosen Pembimbing 1</th>
                        <th>Dosen Pembimbing 2</th>
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
                        <td>{{ $item->pembimbing_utama->dosen->nama }}</td>
                        <td>{{ $item->pembimbing_pendamping->dosen->nama }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
