@extends('layouts.tampilan')

@push('styles')
<style>
    textarea {
        resize: none;
    }

    .tanggapan-box {
        background-color: #e8f5e9;
        padding: 12px 15px;
        border-radius: 10px;
        border-left: 5px solid #4caf50;
        font-style: italic;
        color: #2e7d32;
        margin-top: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .tanggapan-box strong {
        font-style: normal;
        display: flex;
        align-items: center;
        font-weight: 600;
        color: #1b5e20;
        margin-bottom: 5px;
    }

    .status-dropdown {
        min-width: 160px;
        padding: 6px 12px;
    }
</style>
@endpush

@section('content')
<div class="pagetitle">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title">🏢 List Pengumuman</h5>
    </div>
</div>

<div class="container mt-4">
    <h2 class="text-center">📋 Data Tables Pengumuman</h2>
</div>

<form action="{{ route('backend.keluhan.index') }}" method="GET" class="d-flex mb-4 gap-3 flex-wrap">
    <div class="w-100" style="max-width: 400px;">
        <label for="jenis" class="form-label fw-semibold">Jenis</label>
        <select name="jenis" id="jenis" class="form-select shadow-sm rounded-3 py-2 px-3 text-center">
            <option value="">-- Semua Jenis --</option>
            <option value="keluhan" {{ request()->jenis == 'keluhan' ? 'selected' : '' }}>Keluhan</option>
            <option value="masukan" {{ request()->jenis == 'masukan' ? 'selected' : '' }}>Masukan</option>
        </select>
    </div>
    <div class="align-self-end">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">📌 Daftar Keluhan dan Masukan</h5>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis</th>
                                    <th>Departemen</th> 
                                    <th>Priority</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Tanggapan</th>
                                    <th>Like/Setuju</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($keluhan as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <span class="badge {{ $data->jenis == 'keluhan' ? 'bg-danger' : 'bg-info' }}">
                                                {{ ucfirst($data->jenis) }}
                                            </span>
                                        </td>
                                        <td>{{ $data->kategori->kategori }}</td>
                                        <td>{{ $data->priority->priority }}</td>
                                        <td class="text-start">{!! Str::limit($data->deskripsi, 60, '...') !!}</td>
                                        
                                        <!-- STATUS -->
                                        <td>
                                            @php
                                                $status = $data->status;
                                                $warnaSelect = match($status) {
                                                    'proses' => 'bg-warning text-dark',
                                                    'sedang diproses' => 'bg-info text-dark',
                                                    'selesai' => 'bg-success text-white',
                                                    default => 'bg-secondary text-white',
                                                };
                                            @endphp

                                            <select class="form-select status-dropdown {{ $warnaSelect }}" data-id="{{ $data->id }}">
                                                <option value="proses" {{ $status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                <option value="sedang diproses" {{ $status == 'sedang diproses' ? 'selected' : '' }}>Sedang diproses</option>
                                                <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </td>

                                        <!-- TANGGAPAN -->
                                        <td>
                                            @if ($data->tanggapan)
                                                <div class="tanggapan-box">
                                                    <strong><i class="bi bi-chat-dots me-2"></i>Tanggapan Admin:</strong>
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
                                            <span class="badge bg-success">{{ $data->like }}</span>
                                        </td>

                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-success" type="button" data-bs-toggle="dropdown">
                                                    <i class="ti ti-menu-2"></i> Pilih
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="{{ route('backend.keluhan.edit', $data->id) }}"><i class="ti ti-edit"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" href="{{ route('backend.keluhan.show', $data->id) }}"><i class="ti ti-eye"></i> View</a></li>
                                                    <li>
                                                        <form action="{{ route('backend.keluhan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item" type="submit"><i class="ti ti-trash"></i> Hapus</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Tidak ada keluhan atau masukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- end table responsive -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status-dropdown').change(function() {
            var keluhanId = $(this).data('id');
            var status = $(this).val();

            $.ajax({
                url: "/backend/keluhan/" + keluhanId + "/update-status",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengubah status.');
                }
            });
        });
    });
</script>
@endpush
