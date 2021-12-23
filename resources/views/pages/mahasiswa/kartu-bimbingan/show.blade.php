@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Kartu Bimbingan Dosen {{ $dosen }}</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bimbingan.kartu-bimbingan') }}">Kartu Bimbingan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dosen {{ $dosen }}</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="text-center mb-4">Kartu Bimbingan</h3>
        <div class="row justify-content-start">
            <div class="col-lg-6" style="padding-left: 60px">
                <p>Nama : {{ Auth::user()->nama }}</p>
                <p>NPM : {{ Auth::user()->mahasiswa->npm }}</p>
                <p>Prodi : Informatika</p>
                <p>Fakultas : Teknik</p>
            </div>
            <div class="col-lg-6" style="padding-left: 90px">
                @if ($dosen == 'Utama')
                    <p>Nama Dosen : {{ Auth::user()->dosen_utama->dosen->nama }}</p>
                @else
                    <p>Nama Dosen : {{ Auth::user()->dosen_pendamping->dosen->nama }}</p>
                @endif
                <p>Judul Skripsi : {{ Auth::user()->mahasiswa->judul_skripsi }}</p>
            </div>
        </div>
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Tanggal Bimbingan</th>
                        <th>Topik Pembahasan</th>
                        <th>Uraian Konsul</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $item->bab_pembahasan }}</td>
                        <td>{!! $item->uraian_konsultasi !!}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                    @empty
                    <tr class="text-center">
                        <td colspan="7">-- Data Masih Kosong --</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center mt-3">
            <button type="button" class="btn btn-primary px-5" data-toggle="modal" data-target="#exampleModal">
                Cetak
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cetak Bimbingan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-justify">
                            <p>Jika kamu mencetak kartu bimbingan ini maka kamu dinyatakan telah selesai melakukan bimbingan skripsi.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('bimbingan.cetak-kartu-bimbingan', $dosen) }}" class="btn btn-primary px-5">Cetak</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if ($message = Session::get('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $message }}'
        })
    </script>
    @endif
@endpush
