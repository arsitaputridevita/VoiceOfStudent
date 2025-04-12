@extends('welcome')

@section('content')
<style>
/* Background Custom */
.bg-light-custom {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 15px;
    padding: 20px;
    transition: transform 0.3s ease-in-out;
}

.bg-light-custom:hover {
    transform: scale(1.02);
}

/* Header */
.card-header {
    font-weight: bold;
    background: linear-gradient(90deg, #3D8D7a);
    color: white;
    border-radius: 12px 12px 0 0;
}

/* Body */
.card-body {
    font-size: 16px;
    line-height: 1.6;
}

/* Icon */
.icon-container {
    font-size: 50px;
    margin-bottom: 15px;
}

/* Text */
h3 {
    font-size: 24px;
    color: #3D8D7a;
}

p {
    font-size: 16px;
    color: #333;
}

/* Button */
.btn-light {
    border: 1px solid white;
    transition: 0.3s;
}

.btn-light:hover {
    background-color: #f8f9fa;
    color: #3D8D7a;
    transform: scale(1.1);
}

/* Efek Hover */
.bg-light-custom:hover {
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
}

/* Image Styling */
.img-department {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin-top: 20px;
}

/* Bootstrap Icons */
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css");
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 bg-light-custom">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0"><i class="bi bi-megaphone"></i> Departemen</h5>
                    <a href="{{ url('departemen') }}" class="btn btn-sm btn-light"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>

                <div class="card-body text-center">
                    <div class="icon-container">
                        <i class="bi bi-bell-fill text-success"></i>
                    </div>
                    
                    <!-- Displaying the image -->
                    <img src="{{ asset('storage/departemens/' . $departemen->image) }}" alt="Image of {{ $departemen->nama }}" class="img-department">

                    <h3 class="fw-bold text-success">{{ $departemen->nama }}</h3>
                    <hr>
                     <p class="mt-3 text-dark">
                        <i class="bi bi-file-earmark-text"></i> <strong>Departemen:</strong> {!! $departemen->kategori !!}
                    </p>
                    <p class="mt-3 text-dark">
                        <i class="bi bi-file-earmark-text"></i> <strong>Deskripsi:</strong> {!! $departemen->deskripsi !!}
                    </p>
                    <p class="text-secondary">
                        <i class="bi bi-calendar-event"></i> <strong>Tanggal:</strong> {{ date('d M Y', strtotime($departemen->tanggal)) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
