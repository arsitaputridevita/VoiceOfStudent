@extends('layouts.tampilan')

@push('styles')
<style>
/* Card utama */
.card {
    border-radius: 12px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s;
}

.card:hover {
    transform: scale(1.02);
}

/* Header Card */
.card-header {
    background: linear-gradient(to right, #ff9800, #ffcc80); 
    color: white;
    font-weight: bold;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px;
}

/* Tombol kembali */
.btn-outline-primary {
    border-radius: 20px;
    transition: all 0.3s;
}

.btn-outline-primary:hover {
    background-color: #ff9800;
    color: white;
    transform: scale(1.1);
}

/* Form */
.form-control {
    border-radius: 8px;
    border: 1px solid #ddd;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #ff9800;
    box-shadow: 0px 0px 8px rgba(255, 152, 0, 0.6);
}

/* Tombol */
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

.btn-warning {
    border-radius: 20px;
    transition: all 0.3s;
}

.btn-warning:hover {
    transform: scale(1.1);
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
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>📌 Edit Pengumuman</span>
                        <a href="{{ url('backend.pengumuman.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('backend.pengumuman.update', $pengumuman->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            
                            <!-- Judul -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    name="judul" value="{{ $pengumuman->judul }}" placeholder="Masukkan judul" required>
                                @error('judul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                    name="deskripsi" rows="3" placeholder="Masukkan deskripsi" required>{{ $pengumuman->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Tanggal</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    name="tanggal" value="{{ $pengumuman->tanggal }}">
                                @error('tanggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Tombol -->
                            <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-sm btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
