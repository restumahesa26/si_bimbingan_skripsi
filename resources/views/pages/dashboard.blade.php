@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
</div>
@if (Auth::user()->role === 'ADMIN')
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mahasiswa
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mahasiswa }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Dosen</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $dosen }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mahasiswa Sudah Bimbingan</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            @if ($mhs2 != 0)
                                {{ $mhs2 }}
                            @else
                                Belum Ada
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Mahasiswa Masih Bimbingan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if ($mhs1 != 0)
                                {{ $mhs1 }}
                            @else
                                Belum Ada
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Row-->
@endif

@if (Auth::user()->role === 'MAHASISWA')
    <div class="card">
        <div class="card-body">
            <h3>Selamat Datang, Mahasiswa {{ Auth::user()->nama }}</h3>
        </div>
    </div>
@elseif (Auth::user()->role === 'DOSEN')
<div class="card">
    <div class="card-body">
        <h3>Selamat Datang, Dosen {{ Auth::user()->nama }}</h3>
    </div>
</div>
@endif

@if (Auth::user()->role === 'MAHASISWA' && Auth::user()->dosen_utama == NULL && Auth::user()->dosen_pendamping == NULL)
    <div class="card mb-5 mt-3">
        <div class="card-body">
            <form action="{{ route('bimbingan.set-pembimbing') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dosen_pembimbing_utama">Dosen Pembimbing Utama</label>
                            <select name="dosen_pembimbing_utama" id="dosen_pembimbing_utama" class="form-control" required>
                                <option hidden>-- Pilih Dosen Pembimbing Utama --</option>
                                @foreach ($dosens as $item_dosen_utama)
                                    <option value="{{ $item_dosen_utama->user->id }}" @if(old('dosen_pembimbing_utama') == $item_dosen_utama->user->id) selected @endif>{{ $item_dosen_utama->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dosen_pembimbing_pendamping">Dosen Pembimbing Pendamping</label>
                            <select name="dosen_pembimbing_pendamping" id="dosen_pembimbing_pendamping" class="form-control" required>
                                <option hidden>-- Pilih Dosen Pembimbing Pendamping --</option>
                                @foreach ($dosens as $item_dosen_pendamping)
                                    <option value="{{ $item_dosen_pendamping->user->id }}" @if(old('dosen_pembimbing_pendamping') == $item_dosen_pendamping->user->id) selected @endif>{{ $item_dosen_pendamping->user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="judul_skripsi">Judul Skripsi</label>
                    <input type="text" name="judul_skripsi" id="judul_skripsi" class="form-control" value="{{ old('judul_skripsi') }}" placeholder="Masukkan Judul Skripsi" required>
                </div>
                <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
            </form>
        </div>
    </div>
@endif
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-simpan').on('click', function (e) {
        e.preventDefault(); // prevent form submit
        var form = event.target.form;
        Swal.fire({
        title: 'Yakin Menyimpan?',
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

    @if ($message = Session::get('success-login'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ $message }}'
        })
    </script>
    @endif

    @if ($message = Session::get('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
