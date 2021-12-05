@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pembimbing Utama</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bimbingan.show_pembimbing_utama') }}">Bimbingan Skripsi</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pembimbing Utama</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        @if ($check)
        <h3 class="text-danger">Bimbingan Sebelumnya Belum Diverifikasi</h3>
        @else
        <form action="{{ route('bimbingan.store_pembimbing_utama') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="judul_skripsi">Judul Skripsi</label>
                <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control" value="{{ Auth::user()->mahasiswa->judul_skripsi }}" placeholder="Masukkan Judul Skripsi" disabled>
            </div>
            <div class="form-group">
                <label for="bab_pembahasan">Bab Pembahasan</label>
                <input type="text" name="bab_pembahasan" id="bab_pembahasan" class="form-control" value="{{ old('bab_pembahasan') }}" placeholder="Masukkan Bab Pembahasan">
                @error('bab_pembahasan')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="uraian_konsultasi">Uraian Konsultasi</label>
                <textarea name="uraian_konsultasi" id="uraian_konsultasi" class="form-control">{{ old('uraian_konsultasi') }}</textarea>
                @error('uraian_konsultasi')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="file_mahasiswa">File Bimbingan</label>
                <input type="file" name="file_mahasiswa" id="file_mahasiswa" class="form-control">
                @error('file_mahasiswa')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-simpan">Simpan</button>
        </form>
        @endif
    </div>
</div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('uraian_konsultasi');
    </script>

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-simpan').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Yakin Menyimpan Bimbingan?',
            text: "Data Akan Tersimpan",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    Swal.fire('Data Batal Disimpan');
                }
            });
        });
    </script>

    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Perhatikan Lagi Field Yang Diisi'
        })
    </script>
    @endif
@endpush
