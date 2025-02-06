@extends('layouts.tampilan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar pengumuman</h4>
                    <a href="{{ route('backend.pengumuman.create') }}" class="btn btn-primary">Tambah pengumuman</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                 <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($pengumuman as $data)
                            <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->judul }}</td>
                                    <td>{!! $data->deskripsi !!}</td>
                                    <td>{{ $data->tanggal}}</td>
                                    <td>
                                        <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-menu-2">Pilih</i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('backend.pengumuman.edit', $data->id) }}">
                                                <i class="ti ti-edit"></i> Edit 
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href=" {{route('backend.pengumuman.show', $data->id) }}">
                                                <i class="ti ti-eye"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('backend.pengumuman.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">
                                                    <i class="ti ti-trash"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                    </td>

                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada pengumuman</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
