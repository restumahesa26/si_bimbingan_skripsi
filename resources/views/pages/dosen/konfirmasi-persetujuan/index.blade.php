@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Konfirmasi Persetujuan</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Konfirmasi Persetujuan</li>
    </ol>
</div>

@if ($items || $items2)
@foreach ($items as $item)
<div class="card w-50">
    <div class="card-body">
        <p>Prodi memilih kesediaan anda menjadi Dosen Pembimbing Utama untuk Mahasiswa {{ $item->mahasiswa->nama }}</p>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalUtama">
            Lihat Detail
        </button>
    </div>
</div>
@endforeach

@foreach ($items2 as $item2)
<div class="card w-50 mt-3">
    <div class="card-body">
        <p>Prodi memilih kesediaan anda menjadi Dosen Pembimbing Pendamping untuk Mahasiswa {{ $item2->mahasiswa->nama }}</p>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPendamping">
            Lihat Detail
        </button>
    </div>
</div>
@endforeach

@foreach ($items as $ite)
<div class="modal fade" id="modalUtama" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permohonan Persetujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Dimohon Kepada saudara/i untuk kesediannya sebagai <b>Pembimbing Utama</b> dari mahasiswa atas</p>
                <p>Nama : {{ $ite->mahasiswa->nama }}</p>
                <p>NPM : {{ $ite->mahasiswa->mahasiswa->npm }}</p>
                <p>Judul Skripsi : {{ $ite->mahasiswa->mahasiswa->judul_skripsi }}</p>
                <br>
                <p>Atas perhatiannya kami ucapkan terima kasih.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('bimbingan.konfirmasi_persetujuan', ['id' => $ite->id, 'tipe' => 'Pembimbing-Utama']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary btn-konfirmasi">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($items2 as $ite2)
<div class="modal fade" id="modalPendamping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Permohonan Persetujuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Dimohon Kepada saudara/i untuk kesediannya sebagai <b>Pembimbing Pendamping</b> dari mahasiswa atas</p>
                <p>Nama : {{ $ite2->mahasiswa->nama }}</p>
                <p>NPM : {{ $ite2->mahasiswa->mahasiswa->npm }}</p>
                <p>Judul Skripsi : {{ $ite2->mahasiswa->mahasiswa->judul_skripsi }}</p>
                <br>
                <p>Atas perhatiannya kami ucapkan terima kasih.</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('bimbingan.konfirmasi_persetujuan', ['id' => $ite2->id, 'tipe' => 'Pembimbing-Pendamping']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary btn-konfirmasi-2">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
    <div class="card">
        <div class="card-body">
            <h4>Tidak ada konfirmasi persetujuan</h4>
        </div>
    </div>
@endif
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-konfirmasi').on('click', function (e) {
        e.preventDefault(); // prevent form submit
        var form = event.target.form;
        Swal.fire({
        title: 'Yakin Ingin Mengkonfirmasi?',
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

<script>
    $('.btn-konfirmasi-2').on('click', function (e) {
    e.preventDefault(); // prevent form submit
    var form = event.target.form;
    Swal.fire({
    title: 'Yakin Ingin Mengkonfirmasi?',
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
