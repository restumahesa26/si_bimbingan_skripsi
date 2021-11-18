@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item"><a href="./">Kelola Data</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Dosen</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <a href="{{ route('data-dosen.create') }}" class="btn btn-info mb-3">Tambah Data Dosen</a>
        <div class="table table-responsive">
            <table class="table table-bordered text-nowrap">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->user->nama }}</td>
                        <td>{{ $item->prodi }}</td>
                        <td>{{ $item->fakultas }}</td>
                        <td>
                            <a href="{{ route('data-dosen.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('data-dosen.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
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
