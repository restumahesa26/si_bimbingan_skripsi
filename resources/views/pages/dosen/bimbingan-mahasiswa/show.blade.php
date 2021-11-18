@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bimbingan Mahasiswa</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item"><a href="./">Bimbingan Mahasiswa</a></li>
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
        <a href="{{ asset('storage/assets/file-mahasiswa/' . $item->file_mahasiswa) }}" class="btn btn-info" target="_blank">Lihat File Yang Dikirim Mahasiswa</a>
    </div>
</div>
@if ($item->status === 'Dibaca')
<div class="card mt-3 mb-5">
    <div class="card-body">
        <form action="{{ route('bimbingan.update_bimbingan', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="komentar_dosen">Komentar Dosen</label>
                <textarea name="komentar_dosen" id="komentar_dosen" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="ACC">ACC</option>
                    <option value="Revisi">Revisi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file_dosen">File</label>
                <input type="file" name="file_dosen" id="file_dosen" class="form-control">
                @error('file_dosen')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endif

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
            <a href="{{ asset('storage/assets/file-dosen/' . $item->file_dosen) }}" class="btn btn-info" target="_blank">Lihat File Yang Dikirim Dosen</a>

        </div>
    </div>
@endif

@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('komentar_dosen');
</script>
@endpush
