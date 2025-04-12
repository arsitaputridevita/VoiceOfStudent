@extends('welcome')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
              <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0">📄 Detail Keluhan</h4>

    <div class="dropdown">
        <button class="btn btn-sm btn-light text-dark border" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-three-dots-vertical"></i> Pilih
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
            <li>
                <a class="dropdown-item" href="{{ route('user.keluhan.edit', $keluhan->id) }}">

                    <i class="bi bi-pencil-square me-1"></i> Edit 
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ url('user.keluhan.show', $keluhan->id) }}">
                    <i class="bi bi-eye me-1"></i> View
                </a>
            </li>
            <li>
                <form action="{{ route('user.keluhan.destroy', $keluhan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus keluhan ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item text-danger" type="submit">
                        <i class="bi bi-trash me-1"></i> Hapus
                    </button>
                </form>
            </li>
        </ul>
    </div>
</div>


                <div class="card-body">
                    <table class="table table-borderless">
                         
                        <tr>
                            <th>Jenis</th>
                            <td>
                                @if ($keluhan->jenis == 'keluhan')
                                    <span class="badge bg-danger">Keluhan</span>
                                @else
                                    <span class="badge bg-info">Masukan</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $keluhan->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $keluhan->kategori->kategori }}</td>
                        </tr>
                        <tr>
                            <th>Prioritas</th>
                            <td>
                                <span class="badge bg-warning">{{ $keluhan->priority->priority }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($keluhan->status == 'proses')
                                    <span class="badge bg-warning">Proses</span>
                                @elseif($keluhan->status == 'sedang diproses')
                                    <span class="badge bg-primary">Sedang Diproses</span>
                                @elseif($keluhan->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggapan Admin</th>
                            <td>
                                @if ($keluhan->tanggapan)
                                    <div class="alert alert-success">
                                        <strong>✅ {{ $keluhan->tanggapan->tanggapan }}</strong>
                                    </div>
                                @else
                                    <span class="text-muted">Belum ada tanggapan.</span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <a href="{{ route('user.keluhan.index') }}" class="btn btn-secondary">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
