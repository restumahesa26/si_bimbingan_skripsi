@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-flex justify-content-start">
        <a href="{{ route('data-dosen.index') }}" class="btn btn-sm btn-primary mr-2">Kembali</a>
        <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('data-dosen.index') }}">Kelola Data</a></li>
        <li class="breadcrumb-item"><a href="{{ route('data-dosen.index') }}">Data Dosen</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
    </ol>
</div>

<div class="card mb-5">
    <div class="card-body">
        <form action="{{ route('data-dosen.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $item->user->nama }}" placeholder="Masukkan Nama">
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" value="{{ $item->nip }}" placeholder="Masukkan NPM">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $item->user->username }}" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $item->user->email }}" placeholder="Masukkan Email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}" placeholder="Masukkan Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" placeholder="Masukkan Konfirmasi Password">
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control" value="{{ $item->jabatan }}" placeholder="Masukkan Jabatan">
            </div>
            <div class="form-group">
                <label for="prodi">Prodi</label>
                <input type="text" name="prodi" id="prodi" class="form-control" value="{{ $item->prodi }}" placeholder="Masukkan Prodi">
            </div>
            <div class="form-group">
                <label for="fakultas">Fakultas</label>
                <input type="text" name="fakultas" id="fakultas" class="form-control" value="{{ $item->fakultas }}" placeholder="Masukkan Fakultas">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="1" @if ($item->status == 1) selected @endif>Aktif</option>
                    <option value="0" @if ($item->status == 0) selected @endif>Tidak Aktif</option>
                </select>
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
