@extends('welcome')

@push('styles')
<style>
body {
    background: linear-gradient(to right, #fff8e1, #ffecb3);
    font-family: 'Poppins', sans-serif;
}

.page-title {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color: #ffffff;
    background: linear-gradient(to right, #3D8D7A);
    padding: 15px;
    border-radius: 10px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
}

.filter-container {
    max-width: 300px;
    margin: 0 auto 30px auto;
}
.filter-container select {
    border-radius: 10px;
    border: 2px solid #3D8D7A;
    padding: 8px 15px;
    color: #3D8D7A;
    font-weight: 500;
}

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

.card-title {
    font-size: 20px;
    color: #ff6f00;
    font-weight: bold;
}

.badge {
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 10px;
}

.btn-primary {
    background-color: #40A578;
    border: none;
    border-radius: 20px;
    padding: 8px 15px;
    transition: 0.3s;
}
.btn-primary:hover {
    background-color: #e65100;
    transform: scale(1.1);
}

.alert-warning {
    background-color: #FBFFE4;
    font-weight: bold;
    color: #5d4037;
}

.tanggapan-box {
    background-color: #f0f4c3;
    padding: 10px;
    border-radius: 10px;
    margin-top: 10px;
}

.tanggapan-box p {
    margin: 0;
    font-style: italic;
    color: #33691e;
}
</style>
@endpush

@section('content')

<div class="container mt-5 mb-5">
    <h2 class="page-title">📢 Keluhan Terbaru</h2>

    {{-- Filter Dropdown --}}
    <div class="filter-container">
        <form method="GET" action="{{ route('user.keluhan.index') }}">
            <select name="jenis" class="form-select text-center" onchange="this.form.submit()">
                <option value="">-- Filter Jenis --</option>
                <option value="masukan" {{ request('jenis') == 'masukan' ? 'selected' : '' }}>Masukan</option>
                <option value="keluhan" {{ request('jenis') == 'keluhan' ? 'selected' : '' }}>Keluhan</option>
            </select>
        </form>
    </div>

    <div class="row justify-content-center">
        @forelse ($keluhan as $data)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100 border-0 rounded-4 position-relative">
                    <div class="card-body d-flex flex-column position-relative">
                        <h5 class="card-title text-primary fw-bold">
                            <i class="bi bi-file-earmark-text me-2"></i>{{ $data->jenis }}
                        </h5>

                        <ul class="list-unstyled mb-3">
                            <li class="text-muted mb-1">
                                <i class="bi bi-building me-1"></i>
                                <strong>Departemen:</strong> {{ $data->kategori->kategori }}
                            </li>
                            <li class="text-muted">
                                <i class="bi bi-flag-fill me-1"></i>
                                <strong>Prioritas:</strong> {{ $data->priority->priority }}
                            </li>
                        </ul>

                        <p class="card-text mb-3">
                            <i class="bi bi-card-text me-1"></i>
                            <strong>Deskripsi:</strong> {{ Str::limit($data->deskripsi, 100, '...') }}
                        </p>

                        <p class="mb-2">
                            <strong>Status:</strong> 
                            <span id="status-{{ $data->id }}" class="badge px-3 py-2 
                                {{ $data->status == 'Selesai' ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $data->status }}
                            </span>
                        </p>

                        @if ($data->tanggapan)
                            <div class="bg-light rounded p-2 mt-auto">
                                <strong><i class="bi bi-chat-dots me-1"></i> Tanggapan Admin:</strong>
                                <p class="mb-0">{{ $data->tanggapan->tanggapan }}</p>
                            </div>
                        @else
                            <p class="text-muted fst-italic mt-auto"><i class="bi bi-info-circle me-1"></i>Belum ada tanggapan dari admin.</p>
                        @endif

                        {{-- Like & Dislike --}}
                        <div class="mt-3 d-flex justify-content-start gap-3 align-items-center">
                            <button onclick="likeKeluhan({{ $data->id }})" class="btn btn-sm btn-outline-success">
                                👍 <span id="like-count-{{ $data->id }}">{{ $data->like }}</span>
                            </button>
                            <button onclick="dislikeKeluhan({{ $data->id }})" class="btn btn-sm btn-outline-danger">
                                👎 <span id="dislike-count-{{ $data->id }}">{{ $data->dislike }}</span>
                            </button>
                        </div>

                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <a href="{{ route('user.keluhan.show', $data->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="bi bi-arrow-right-circle me-1"></i> Baca Selengkapnya
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="bi bi-exclamation-triangle"></i> Tidak ada keluhan saat ini.
                </div>
            </div>
        @endforelse
    </div>
</div>

{{-- AJAX Script --}}
<script>
    function likeKeluhan(id) {
        fetch(`/keluhan/${id}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById(`like-count-${id}`).innerText = data.like;
        });
    }

    function dislikeKeluhan(id) {
        fetch(`/keluhan/${id}/dislike`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById(`dislike-count-${id}`).innerText = data.dislike;
        });
    }
</script>

@endsection
