@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="d-flex justify-content-start">
        <a href="{{ route('bimbingan.index_bimbingan') }}" class="btn btn-sm btn-primary mr-2">Kembali</a>
        <h1 class="h3 mb-0 text-gray-800">Bimbingan Mahasiswa</h1>
    </div>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('bimbingan.index_bimbingan') }}">Bimbingan Mahasiswa</a></li>
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
                <label for="">Bab Pembahasan</label>
            </div>
            <div class="col-8">
                <label for="">{{ $item->bab_pembahasan }}</label>
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
        <a href="{{ asset('storage/assets/file-mahasiswa/' . $item->file_mahasiswa) }}" class="btn btn-info btn-sm" target="_blank">Download File Yang Dikirim Mahasiswa</a>
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
                <textarea name="komentar_dosen" id="komentar_dosen" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="ACC">ACC</option>
                    <option value="Revisi">Revisi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="file_dosen">File</label>
                <input type="file" name="file_dosen" id="file_dosen" class="form-control" required>
                @error('file_dosen')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label class="" for="">Silahkan membuat tandatangan  :
                </label>
                <br/>
                <div id="sig" style="width: 350px;"></div>
                <br/>
                <button id="clear" class="btn btn-danger btn-sm">Hapus
                    Tandatangan
                </button>
                <textarea id="signature64" name="tanda_tangan" style="display: none">
                </textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
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
            <div class="form-group row">
                <div class="col-2">
                    <label for="">Tanda Tangan</label>
                </div>
                <div class="col-8">
                    <img src="{{ asset('tanda-tangan/' . $item->tanda_tangan) }}" alt="">
                </div>
            </div>
            <a href="{{ asset('storage/assets/file-dosen/' . $item->file_dosen) }}" class="btn btn-info" target="_blank">Lihat File Yang Dikirim Dosen</a>

        </div>
    </div>
@endif

@endsection

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    <link type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <style>
        .kbw-signature {
            width: 100%;
            height: 200px;
        }
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
    </style>
@endpush

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <script type="text/javascript"
     src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script type="text/javascript"
       src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
    </script>
    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js">
    </script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>
        CKEDITOR.replace('komentar_dosen');
    </script>

    <script>
        var sig = $('#sig').signature(
            {
                syncField: '#signature64',
                syncFormat: 'PNG'
            }
        );
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature64").val('');
        });
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
