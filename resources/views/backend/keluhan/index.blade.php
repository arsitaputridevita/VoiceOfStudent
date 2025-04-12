@extends('layouts.tampilan')

@push('styles')
<style>
/* Styling tambahan */
textarea {
    resize: none;
}

.tanggapan-box {
    background-color: #e8f5e9; /* Warna hijau pastel */
    padding: 10px;
    border-radius: 8px;
    border-left: 5px solid #4caf50; /* Garis hijau di kiri */
    font-style: italic;
    color: #2e7d32;
    margin-top: 10px;
}

.tanggapan-box strong {
    font-style: normal;
    display: block;
    margin-bottom: 5px;
    color: #1b5e20;
}
</style>
@endpush

@section('content')
<div class="pagetitle">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">🏢 List Pengumuman</h5>
        {{-- <a href="{{ route('backend.pengumuman.create') }}" class="btn btn-primary ms-auto">+ Buat Pengumuman</a> --}}
    </div>
</div>
<div class="container mt-4">
    <h2 class="text-center">📋 Data Tables Pengumuman</h2>
</div>
<form action="{{ route('backend.keluhan.index') }}" method="GET" class="d-flex mb-3">
    <!-- Dropdown Filter Jenis -->
   <div class="me-3 w-100" style="max-width: 400px;">
    <label for="jenis" class="form-label fw-semibold">Jenis</label>
    <select name="jenis" id="jenis" class="form-select shadow-sm rounded-3 py-2 px-3 text-center">
        <option value="">-- Semua Jenis --</option>
        <option value="keluhan" {{ request()->jenis == 'keluhan' ? 'selected' : '' }}>Keluhan</option>
        <option value="masukan" {{ request()->jenis == 'masukan' ? 'selected' : '' }}>Masukan</option>
    </select>
</div>


    <!-- Dropdown Filter Status -->
    {{-- <div class="me-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="">-- Semua Status --</option>
            <option value="Belum Diproses" {{ request()->status == 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
            <option value="Diproses" {{ request()->status == 'proses' ? 'selected' : '' }}>proses</option>
            <option value="Selesai" {{ request()->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
    </div> --}}

    <!-- Tombol Filter -->
    <button type="submit" class="btn btn-primary align-self-end">Filter</button>
</form>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar keluhan dan masukan 📌</h5>
                    {{-- <a href="{{ route('backend.keluhan.create') }}" class="btn btn-primary">+ Tambah Keluhan</a> --}}
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                           <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Departemen</th> {{-- dari kategori --}}
                                    <th>Penanggung Jawab</th> {{-- dari kategori->departemen->nama --}}
                                    <th>Priority</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Tanggapan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @php $no = 1; @endphp
                                    @forelse ($keluhan as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            @if ($data->jenis == 'keluhan')
                                                <span class="badge bg-danger">Keluhan</span>
                                            @else
                                                <span class="badge bg-info">Masukan</span>
                                            @endif
                                        </td>
                                        <td>{{ $data->kategori->kategori ?? '-' }}</td> {{-- departemen --}}
                                        <td>{{ $data->kategori->departemen->nama ?? '-' }}</td> {{-- penanggung jawab --}}
                                        <td>{{ $data->priority->priority ?? '-' }}</td>
                                        <td>{!! Str::limit($data->deskripsi, 50, '...') !!}</td>
                                        <td><span class="badge bg-primary">{{ $data->status }}</span></td>
                                        <td>
                                            @if ($data->tanggapan)
                                                <div class="tanggapan-box">
                                                    <strong>Tanggapan Admin:</strong>
                                                    <p class="mb-0">{{ $data->tanggapan->tanggapan }}</p>
                                                </div>
                                            @else
                                                <form action="{{ route('backend.keluhan.tanggapan.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="keluhan_id" value="{{ $data->id }}">
                                                    <textarea name="tanggapan" class="form-control" rows="2" required placeholder="Tulis tanggapan..."></textarea>
                                                    <button type="submit" class="btn btn-sm btn-success mt-2">Kirim</button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- aksi button di sini --}}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada keluhan atau masukan</td>
                                    </tr>
                                    @endforelse
                            </tbody>

                            {{-- <tbody>
                                @php $no = 1; @endphp
                                @forelse ($keluhan as $data)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        @if ($data->jenis == 'keluhan')
                                            <span class="badge bg-danger">Keluhan</span>
                                        @else
                                            <span class="badge bg-info">Masukan</span>
                                        @endif
                                    </td>
                                    <td>{{ $data->kategori->kategori }}</td>
                                    <td>{{ $data->priority->priority }}</td>
                                    <td>{!! Str::limit($data->deskripsi, 50, '...') !!}</td>
                                    <td>
                                        <span class=" badge bg-primary"> {{$data->status}}</span>
                                       
                                    </td>
                                    {{-- <td>
                                        @if(auth()->user()->role === 'admin')
                                            <!-- Dropdown untuk admin -->
                                            <form action="{{ route('backend.keluhan.updateStatus', $data->id) }}" method="POST">
                                                @csrf
                                                <td>
                                            <select class="form-control status-dropdown" data-id="{{ $keluhan->id }}">
                                                <option value="Belum Diproses" {{ $keluhan->status == 'Belum Diproses' ? 'selected' : '' }}>🔴 Belum Diproses</option>
                                                <option value="Diproses" {{ $keluhan->status == 'Diproses' ? 'selected' : '' }}>🟡 Diproses</option>
                                                <option value="Selesai" {{ $keluhan->status == 'Selesai' ? 'selected' : '' }}>🟢 Selesai</option>
                                            </select>
                                        </td>
                                            </form>
                                        @else
                                            <!-- Hanya tampilkan badge untuk user biasa -->
                                            <span class="badge 
                                                {{ $data->status == 'proses' ? 'bg-warning' : '' }}
                                                {{ $data->status == 'sedang diproses' ? 'bg-primary' : '' }}
                                                {{ $data->status == 'selesai' ? 'bg-success' : '' }}">
                                                {{ ucfirst($data->status) }}
                                            </span>
                                        @endif
                                    </td> --}}
                                    {{-- <td>
                                        @if ($data->tanggapan)
                                            <div class="tanggapan-box">
                                                <strong>Tanggapan Admin:</strong>
                                                <p class="mb-0">{{ $data->tanggapan->tanggapan }}</p>
                                            </div>
                                        @else
                                            <form action="{{ route('backend.keluhan.tanggapan.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="keluhan_id" value="{{ $data->id }}">
                                                <textarea name="tanggapan" class="form-control" rows="2" required placeholder="Tulis tanggapan..."></textarea>
                                                <button type="submit" class="btn btn-sm btn-success mt-2">Kirim</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-success" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-menu-2"></i> Pilih
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('backend.keluhan.edit', $data->id) }}">
                                                        <i class="ti ti-edit"></i> Edit 
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('backend.keluhan.show', $data->id) }}">
                                                        <i class="ti ti-eye"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('backend.keluhan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit">
                                                            <i class="ti ti-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada keluhan atau masukan</td>
                                </tr>
                                @endforelse
                            </tbody> --}}
                        </table>
                    </div> <!-- End Table Responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.update-status').click(function() {
            var keluhanId = $(this).data('id');
            var status = $('.status-dropdown[data-id="'+keluhanId+'"]').val();

            $.ajax({
                url: "/keluhan/" + keluhanId + "/update-status",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function(response) {
                    alert(response.message);
                }
            });
        });
    });
</script>
