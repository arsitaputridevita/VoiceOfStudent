@extends('layouts.tampilan')

@push('styles')
<style>
/* Card */
.card {
    border-radius: 12px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.02);
}

/* Header Card */
.card-header {
    background: linear-gradient(to right, #007bff, #00c6ff);
    color: white;
    font-weight: bold;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px;
}

/* Tombol */
.btn {
    border-radius: 20px;
    transition: all 0.3s;
}

.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

.btn-outline-success:hover {
    background-color: #28a745;
    color: white;
}

/* Table */
.table {
    border-radius: 10px;
    overflow: hidden;
}

.table thead {
    background-color: #343a40;
    color: white;
}

.table tbody tr {
    transition: all 0.3s;
}

.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Dropdown */
.dropdown-menu {
    border-radius: 8px;
}

.dropdown-item {
    transition: all 0.3s;
}

.dropdown-item:hover {
    background-color: #007bff;
    color: white;
}

/* Badge Status */
.badge {
    font-size: 0.9rem;
    padding: 5px 10px;
    border-radius: 12px;
}

/* Responsif */
@media (max-width: 768px) {
    .card {
        box-shadow: none;
    }
}
</style>
@endpush

@section('content')
<div class="pagetitle">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">🏢 List Pengumuman</h5>
        <a href="{{ route('backend.pengumuman.create') }}" class="btn btn-primary ms-auto">+ Buat Pengumuman</a>
    </div>
</div>
<div class="container mt-4">
    <h2 class="text-center">📋 Data Tables Pengumuman</h2>
</div>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg p-4">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pengumuman 📌</h5>

                    <!-- Table -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                       <tbody>
                            @php $no = 1; @endphp
                            @forelse ($pengumuman as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->judul }}</td>
                                <td>{{$data->deskripsi}}</td>
                                <td>{{$data->tanggal}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-menu-2"></i> Pilih
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.pengumuman.edit', $data->id) }}">
                                                    <i class="ti ti-edit"></i> Edit 
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.pengumuman.show', $data->id) }}">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('backend.pengumuman.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada pengumuman</td>
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
{{-- <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tbody>
                            @php $no = 1; @endphp
                            @forelse ($pengumuman as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->judul }}</td>
                                <td>{{$data->deskripsi}}</td>
                                <td>{{$data->tanggal}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-menu-2"></i> Pilih
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.pengumuman.edit', $data->id) }}">
                                                    <i class="ti ti-edit"></i> Edit 
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('backend.pengumuman.show', $data->id) }}">
                                                    <i class="ti ti-eye"></i> View
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('backend.pengumuman.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada pengumuman</td>
                            </tr>
                            @endforelse
                        </tbody>
                        </tbody>  
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection 