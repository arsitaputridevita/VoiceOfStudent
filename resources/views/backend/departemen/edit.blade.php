@extends('layouts.tampilan')

@push('styles')
<style>
/* Card Styling */
.card {
    border-radius: 12px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}
.card:hover {
    transform: scale(1.02);
}

/* Header Card */
.card-header {
    background: linear-gradient(to right, #007bff, #00c6ff);
    color: white;
    font-weight: bold;
    padding: 15px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

/* Table Styling */
.table {
    border-radius: 8px;
    overflow: hidden;
    margin-top: 20px;
}

.table-bordered th, .table-bordered td {
    text-align: center;
    vertical-align: middle;
    padding: 12px 15px;
}

.table-dark {
    background-color: #343a40;
    color: white;
}

/* Button Styling */
.btn-outline-success {
    border-radius: 20px;
    transition: all 0.3s;
}
.btn-outline-success:hover {
    transform: scale(1.05);
    background-color: #28a745;
    color: white;
}

/* Image Styling */
img.rounded {
    border-radius: 8px;
    width: 150px;
    height: auto;
    object-fit: cover;
}

/* Dropdown Menu */
.dropdown-menu {
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    padding: 10px;
    transition: all 0.3s;
}
.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

/* Alerts */
.alert {
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* Responsive Table */
@media (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .table th, .table td {
        font-size: 12px;
        padding: 10px;
    }

    .btn-sm {
        font-size: 12px;
    }
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Departemen</h4>
                    <a href="{{ route('backend.departemen.create') }}" class="btn btn-primary">Tambah Departemen</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Departemen</th>
                                    <th>Deskripsi</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($departemen as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->nama}}</td>
                                    <td>{{ $data->kategori->kategori }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        <img src="{{ asset('storage/departemens/' . $data->image) }}" class="rounded">
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-menu-2"></i> Pilih
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('backend.departemen.edit', $data->id) }}">
                                                        <i class="ti ti-edit"></i> Edit 
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('backend.departemen.show', $data->id) }}">
                                                        <i class="ti ti-eye"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('backend.departemen.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
                                    <td colspan="6" class="text-center">Tidak ada departemen</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
