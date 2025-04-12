@extends('welcome')

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
.btn-warning {
    background-color: #ffc107;
    border: none;
}
.btn-warning:hover {
    background-color: #e0a800;
    transform: scale(1.05);
}
/* Form Controls */
.form-control {
    border-radius: 10px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}
.form-control:focus {
    box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
}
/* Label */
.form-label {
    font-weight: bold;
    color: #555;
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
                <div class="card-header">
                    <div class="float-start">{{ __('Edit Keluhan') }}</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.keluhan.update', $keluhan->id) }}" method="POST">
                        @csrf 
                        @method('PUT')

                        <!-- Pilihan Jenis Keluhan -->
                       <!-- Pilihan Jenis Keluhan -->
            <div class="mb-3">
                <label class="form-label">Jenis</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input jenis-checkbox" type="checkbox" name="jenis" value="keluhan" id="jenis_keluhan"
                        {{ $keluhan->jenis == 'keluhan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="jenis_keluhan">Keluhan</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input jenis-checkbox" type="checkbox" name="jenis" value="masukan" id="jenis_masukan"
                        {{ $keluhan->jenis == 'masukan' ? 'checked' : '' }}>
                    <label class="form-check-label" for="jenis_masukan">Masukan</label>
                </div>
            </div>


                        <!-- Pilihan Departemen -->
                        <div class="mb-3">
                            <label class="form-label">Departemen</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">-- Pilih Departemen --</option>
                                @foreach ($kategori as $data)
                                    <option value="{{ $data->id }}" {{ $keluhan->kategori_id == $data->id ? 'selected' : '' }}>
                                        {{ $data->kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilihan Priority -->
                        <div class="mb-3">
                            <label class="form-label">Priority</label>
                            <select name="priority_id" class="form-control">
                                <option value="">-- Pilih Priority --</option>
                                @foreach ($priority as $data)
                                    <option value="{{ $data->id }}" {{ $keluhan->priority_id == $data->id ? 'selected' : '' }}>
                                        {{ $data->priority }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input Deskripsi -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsikan keluhan">{{ $keluhan->deskripsi }}</textarea>
                        </div>

                        <!-- Tombol Simpan & Reset -->
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('user.keluhan.index') }}" class="btn btn-warning">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const jenisCheckboxes = document.querySelectorAll('.jenis-checkbox');

        jenisCheckboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (this.checked) {
                    jenisCheckboxes.forEach(function (cb) {
                        if (cb !== checkbox) cb.checked = false;
                    });
                }
            });
        });
    });
</script>
@endpush
