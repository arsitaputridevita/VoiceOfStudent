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
@endpush

@section('content')
<div class="pagetitle">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">List Pengumuman</h5>
        <a href="{{ route('backend.pengumuman.create') }}" class="btn btn-primary ms-auto">Buat Pengumuman</a>
    </div>
</div>

    <h1>Data Tables Pengumuman</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('backend.pengumuman.index') }}">Pengumuman</a></li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List Pengumuman</h5>

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengumuman</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($pengumuman as $data)
                            <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->judul }}</td>
                                    <td>{!! $data->deskripsi !!}</td>
                                    <td>{{ $data->tanggal}}</td>
                                    <td>
                                        <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-menu-2">Pilih</i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('backend.pengumuman.edit', $data->id) }}">
                                                <i class="ti ti-edit"></i> Edit 
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href=" {{route('backend.pengumuman.show', $data->id) }}">
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
                                    <td colspan="7" class="text-center">Tidak ada pengumuman</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<!-- Vendor JS Files -->
<!-- Tambahkan jQuery & DataTables -->
<!-- Tambahkan jQuery & DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>



@endpush
