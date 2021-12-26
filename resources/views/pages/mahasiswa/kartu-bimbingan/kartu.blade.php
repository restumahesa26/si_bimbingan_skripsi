<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Bimbingan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Times New Roman';
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-3">
                <img src="{{ url('logo-unib.png') }}" alt="" srcset="" style=" width: 180px; margin-left: -280px;">
            </div>
            <div class="col-9 mt-4" style="margin-left: -240px;">
                <h4>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h4>
                <h4 style="margin-top: -12px;">UNIVERSITAS BENGKULU</h4>
                <h4 style="margin-top: -12px;">FAKULTAS TEKNIK</h4>
                <h4 style="margin-top: -12px;">PROGRAM STUDI INFORMATIKA</h4>
                <p style=" margin-top: -10px; font-size: 16px;">Jl. W.R. Supratman Kandang Limun Bengkulu</p>
                <p style="font-size: 16px; margin-top: -20px;">Telp. 0736-344087.21170 Ext. 227 Fax 0736-349134</p>
                <p style="font-size: 16px; margin-top: -20px;">Laman: <a href="">www.informatika.ft.unib.ac.id</a></p>
            </div>
        </div>
        <hr style="border: 1px #000 solid; margin-top: -10px;">
        <h4 class="text-center mb-3">Kartu Bimbingan Skripsi</h4>
        <div class="d-flex justify-content-between">
            <div class="col-lg-6" style="padding-left: 20px;">
                <div class="row">
                    <div class="col-2">
                        <p>Nama</p>
                    </div>
                    <div class="col-9">
                        <p>: {{ Auth::user()->nama }}</p>
                    </div>
                </div>
                <div class="row" style="margin-top: -14px;">
                    <div class="col-2">
                        <p>NPM</p>
                    </div>
                    <div class="col-9">
                        <p>: {{ Auth::user()->mahasiswa->npm }}</p>
                    </div>
                </div>
                <div class="row" style="margin-top: -14px;">
                    <div class="col-2">
                        <p>Prodi</p>
                    </div>
                    <div class="col-9">
                        <p>: Informatika</p>
                    </div>
                </div>
                <div class="row" style="margin-top: -14px;">
                    <div class="col-2">
                        <p>Fakultas</p>
                    </div>
                    <div class="col-9">
                        <p>: Teknik</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="padding-left: 45px;">
                <div class="row">
                    <div class="col-3">
                        <p>Nama Dosen</p>
                    </div>
                    <div class="col-9">
                        @if ($dosen == 'Utama')
                            <p>: {{ Auth::user()->dosen_utama->dosen->nama }}</p>
                        @else
                            <p>: {{ Auth::user()->dosen_pendamping->dosen->nama }}</p>
                        @endif

                    </div>
                </div>
                <div class="row" style="margin-top: -14px;">
                    <div class="col-3">
                        <p>Judul Skripsi</p>
                    </div>
                    <div class="col-9">
                        <p>: {{ Auth::user()->mahasiswa->judul_skripsi }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="table table-responsive">
                <table class="table-bordered mx-auto w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Topik Pembahasan</th>
                            <th>Uraian Konsultasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
                            <td>{{ $item->bab_pembahasan }}</td>
                            <td style="padding-bottom: 0px">{!! $item->uraian_konsultasi !!}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <p style="padding-right: 150px; margin-top: 10px;">Bengkulu, 8 November 2021</p>
        </div>
        <div class="d-flex justify-content-between" style="margin-top: -12px;">
            <div class="col-lg-6" style="padding-left: 20px;">
                <p>Mahasiswa</p>
                <p style="margin-top: 100px;"><strong>{{ Auth::user()->nama }}</strong> </p>
                <p style="margin-top: -20px;">NPM : {{ Auth::user()->mahasiswa->npm }}</p>
            </div>
            <div class="col-lg-6" style="padding-left: 250px;">
                <p>Pembimbing 1</p>
                @if ($dosen == 'Utama')
                    <p style="margin-top: 100px;"><strong>{{ Auth::user()->dosen_utama->dosen->nama }}</strong></p>
                    <p style="margin-top: -20px;">NIP : {{ Auth::user()->dosen_utama->dosen->dosen->nip }}</p>
                @else
                <p style="margin-top: 100px;"><strong>{{ Auth::user()->dosen_pendamping->dosen->nama }}</strong></p>
                <p style="margin-top: -20px;">NIP : {{ Auth::user()->dosen_pendamping->dosen->dosen->nip }}</p>
                @endif
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
    window.print()
</script>
</html>
