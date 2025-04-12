@extends('layouts.tampilan')

@push('styles')
<style>
    .pagetitle {
        margin-bottom: 20px;
    }

    .card-header {
        background-color: #f1f1f1;
        padding: 15px 20px;
        font-size: 1.2rem;
    }

    .card-body {
        padding: 25px;
    }

    .table th, .table td {
        vertical-align: middle;
        text-align: center;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .btn-outline-success {
        transition: all 0.3s ease;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: white;
        border-color: #28a745;
    }

    .dropdown-menu {
        min-width: 150px;
    }

    .dropdown-item {
        padding: 10px 20px;
        font-size: 14px;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .breadcrumb {
        margin-bottom: 15px;
        background-color: transparent;
    }

    .breadcrumb-item a {
        color: #007bff;
    }

    .breadcrumb-item a:hover {
        text-decoration: underline;
    }
</style>

<!-- Vendor CSS dan lainnya -->
<link href="{{ asset('backend/assets/img/favicon.png') }}" rel="icon">
<link href="{{ asset('backend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">
<link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="pagetitle">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">List Kategori</h5>
        <a href="{{ route('backend.kategori.create') }}" class="btn btn-primary ms-auto">Tambah Kategori</a>
    </div>
</div>

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('backend.kategori.index') }}">Kategori</a></li>
    </ol>
</nav>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Kategori</h5>

                    <table class="table table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($kategori as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->kategori }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots-vertical"></i> Pilih
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.kategori.edit', $data->id) }}">
                                                    <i class="bi bi-pencil-square"></i> Edit 
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.kategori.show', $data->id) }}">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('backend.kategori.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bi bi-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data kategori</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonText: 'OK'
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: `{!! session('error') !!}`,
            confirmButtonText: 'OK'
        });
    @endif
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
        });
    });
</script>
@endpush

