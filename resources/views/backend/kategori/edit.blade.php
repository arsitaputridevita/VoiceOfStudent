@extends('layouts.tampilan')

@push('styles')
<style>
/* Card Styling */
.card {
    border-radius: 12px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
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

/* Form Label */
.form-label {
    font-weight: 600;
    color: #495057;
}

/* Form Controls */
.form-control {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 10px;
    transition: all 0.3s ease;
}
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
}

/* Buttons */
.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 20px;
    transition: all 0.3s;
}
.btn-primary:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}
.btn-warning {
    border-radius: 20px;
    transition: all 0.3s;
}
.btn-warning:hover {
    transform: scale(1.05);
}

/* Layout Spacing */
.container {
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="float-start">{{ __('Dashboard') }}</div>
                    <div class="float-end">
                        <a href="{{ route('backend.kategori.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('backend.kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                                   name="kategori" value="{{ $kategori->kategori }}" placeholder="Masukkan kategori" required>
                            @error('kategori')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">SIMPAN</button>
                        <button type="reset" class="btn btn-sm btn-warning">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
