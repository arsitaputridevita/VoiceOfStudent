@extends('layouts.tampilan')

@push('styles')
<!-- Tambahkan file CSS khusus jika ada -->
<link href="backend/assets/img/favicon.png" rel="icon">
<link href="backend/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="backend/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="backend/assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="backend/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="backend/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="backend/assets/vendor/simple-datatables/style.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="backend/assets/css/style.css" rel="stylesheet">

<!-- Custom CSS -->
<style>
.pagetitle {
    background: linear-gradient(to right, #ff9800, #ffcc80);
    color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    font-weight: bold;
}
.btn-primary {
    background-color: #ff6f00;
    border: none;
    border-radius: 20px;
    padding: 8px 15px;
    transition: all 0.3s;
}
.btn-primary:hover {
    background-color: #e65100;
    transform: scale(1.1);
}
.table {
    border-radius: 10px;
    overflow: hidden;
    background: white;
}
.table th {
    background-color: #ff6f00;
    color: white;
    text-align: center;
}
.table td {
    text-align: center;
}
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}
.dropdown-item:hover {
    background-color: #ffcc80;
    color: #222;
}
.alert-warning {
    background-color: #ffcc80;
    font-weight: bold;
    color: #5d4037;
}
</style>
@endpush

@section('content')

<div class="pagetitle">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">🏢 List Departemen</h5>
        <a href="{{ route('backend.departemen.create') }}" class="btn btn-primary ms-auto">Tambah Departemen</a>
    </div>
</div>

<div class="container mt-4">
    <h2 class="text-center">📋 Data Tables Departemen</h2>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h5 class="card-title">Daftar Departemen 📌</h5>

                    <!-- Table -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($departemen as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama}}</td>
                                <td>{{ $data->kategori->kategori ?? '-' }}</td>
                                <td>{!! Str::limit($data->deskripsi, 50, '...') !!}</td>
                                <td>
                                    <img src="{{ asset('storage/departemens/' . $data->image) }}" class="rounded" width="100">
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-list"></i> Pilih
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.departemen.edit', $data->id) }}">
                                                    <i class="bi bi-pencil-square"></i> Edit 
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.departemen.show', $data->id) }}">
                                                    <i class="bi bi-eye"></i> Lihat
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('backend.departemen.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada departemen</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- End Table -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endpush