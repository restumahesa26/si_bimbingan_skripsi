@extends('layouts.admin')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Dosen</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('data-dosen.index') }}">Kelola Data</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Dosen</li>
    </ol>
</div>

<div class="card">
    <div class="card-body">
        <a href="{{ route('data-dosen.create') }}" class="btn btn-info mb-3">Tambah Data Dosen</a>
        <div class="table table-responsive">
            <table class="table table-bordered text-nowrap" id="table">
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
                                <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
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

@push('addon-script')
    <script>
        $(document).ready( function () {
            $('#table').DataTable({
                ordering: false
            });
        });
    </script>

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-hapus').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Yakin Menghapus Data?',
            text: "Data Akan Terhapus Permanen",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    Swal.fire('Data Batal Dihapus');
                }
            });
        });
    </script>

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
