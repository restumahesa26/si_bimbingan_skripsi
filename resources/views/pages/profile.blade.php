@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
</div>

<div class="card mb-5">
    <div class="card-body">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->nama }}" placeholder="Masukkan Nama" @if (Auth::user()->role == 'MAHASISWA' || Auth::user()->role == 'DOSEN') disabled @endif>
            </div>
            @if (Auth::user()->role == 'MAHASISWA')
            <div class="form-group">
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" class="form-control" value="{{ $item->mahasiswa->npm }}" placeholder="Masukkan NPM" disabled>
            </div>
            <div class="form-group">
                <label for="judul_skripsi">Judul Skripsi</label>
                <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control" value="{{ $item->mahasiswa->judul_skripsi }}" placeholder="Masukkan Judul Skripsi" disabled>
            </div>
            @elseif (Auth::user()->role == 'DOSEN')
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" value="{{ $item->dosen->nip }}" placeholder="Masukkan NPM" disabled>
            </div>
            @endif
            @if (Auth::user()->role == 'DOSEN')
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $item->dosen->jabatan }}" placeholder="Masukkan Jabatan">
            </div>
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" name="prodi" id="prodi" class="form-control" value="{{ $item->dosen->prodi }}" placeholder="Masukkan Prodi">
            </div>
            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <input type="text" name="fakultas" id="fakultas" class="form-control" value="{{ $item->dosen->fakultas }}" placeholder="Masukkan Fakultas">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="1" @if ($item->dosen->status == 1) selected @endif>Aktif</option>
                    <option value="0" @if ($item->dosen->status == 0) selected @endif>Tidak Aktif</option>
                </select>
            </div>
            @endif
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $item->username }}" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $item->email }}" placeholder="Masukkan Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="Masukkan Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Masukkan Konfirmasi Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-edit">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-edit').on('click', function (e) {
        e.preventDefault(); // prevent form submit
        var form = event.target.form;
        Swal.fire({
        title: 'Yakin Menyimpan Perubahan?',
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
@endpush
