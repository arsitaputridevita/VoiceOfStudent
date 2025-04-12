@extends('welcome')

@section('content')
<div class="container py-4">
    <h3 class="text-center mb-4">
        <span class="badge bg-success py-2 px-3">
            📢 Pengumuman Terbaru
        </span>
    </h3>

    @foreach ($pengumuman as $data)
        <div class="bg-white shadow rounded-4 p-3 mb-4" style="max-width: 500px; margin: auto;">
            <h5 class="text-warning fw-bold">{{ $data->judul }}</h5>
            <p class="text-muted mb-1">
                <i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($data->created_at)->format('d M Y') }}
            </p>
            <p>{{ Str::limit($data->isi, 100, '...') }}</p>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="{{ route('detail_pengumuman', $data->id) }}" class="btn btn-success btn-sm">
                    📄 Baca Selengkapnya
                </a>

                {{-- <div class="d-flex gap-2"> --}}
                    {{-- Tombol Like --}}
                    {{-- <form action="{{ route('pengumuman.like', $data->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            ❤️ {{ $data->likes_count ?? 0 }}
                        </button>
                    </form> --}}

                    {{-- Menampilkan jumlah like secara terpisah --}}
                    {{-- <span class="text-danger">
                        {{ $data->likes_count ?? 0 }} Suka
                    </span> --}}
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
