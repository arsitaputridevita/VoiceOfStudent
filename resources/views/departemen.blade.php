@extends('welcome') {{-- Sesuaikan dengan template utama --}}

@section('content')

<style>
/* Background Umum - Warna Krem */
body {
    background: linear-gradient(to right, #fff8e1, #ffecb3); /* Krem ke emas muda */
    font-family: 'Poppins', sans-serif;
}

/* BAGIAN "DAFTAR DEPARTEMEN" */
.page-title {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color: #ffffff; /* Warna teks putih */
    background: linear-gradient(to right, #3D8D7a); /* Gradasi oranye */
    padding: 15px;
    border-radius: 10px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    margin-bottom: 30px;
}

/* Card */
.card {
    border-radius: 15px;
    transition: 0.3s ease-in-out;
    border: none;
    background-color: #ffffff;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
}

.card:hover {
    transform: scale(1.03);
    box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.15);
}

/* Card Header */
.card-title {
    font-size: 20px;
    color: #ff6f00;
    font-weight: bold;
}

/* Date */
.text-muted {
    font-size: 14px;
    color: #795548; /* Warna coklat kalem */
}

/* Button */
.btn-primary {
    background-color: #3D8D7a; /* Warna oranye */
    border: none;
    border-radius: 20px;
    padding: 8px 15px;
    transition: 0.3s;
}

.btn-primary:hover {
    background-color: #40A578; /* Warna oranye lebih gelap */
    transform: scale(1.1);
}

/* Image Styling */
.img-thumbnail {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 10px;
}

/* Alert */
.alert-warning {
    background-color: #ffcc80; /* Warna orange pastel */
    font-weight: bold;
    color: #5d4037; /* Warna coklat gelap */
}
</style>

<div class="container mt-5 mb-5">
    <h2 class="page-title">📢 Daftar Departemen</h2>

    <div class="row justify-content-center">
        @forelse ($departemen as $data)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/departemens/' . $data->image) }}" class="img-thumbnail" alt="Image of {{ $data->nama }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $data->nama }}</h5>
                        <p class="text-muted"><i class="bi bi-house-door"></i> {{ $data->kategori}}</p>
                        <p class="card-text">{{ Str::limit($data->deskripsi, 100, '...') }}</p>
                        <a href="{{ route('detail_departemen', $data->id) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-arrow-right-circle"></i> Lihat Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle"></i> Tidak ada departemen saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection
 