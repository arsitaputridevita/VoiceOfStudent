@extends('layouts.tampilan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Keluhan</h4>
                    <a href="{{ route('backend.keluhan.create') }}" class="btn btn-primary">Tambah Keluhan</a>
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
                                <th>Jenis</th>
                                <th>Deskripsi</th>
                                <th>departemen</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($keluhan as $data)
                            <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->kategori_id }}</td>
                                    <td>{!! $data->deskripsi !!}</td>
                                    <td>{{ $data->departemen_id}}</td>
                                    <td>{{$data->priority_id}}</td>
                                    <td>
                                    @foreach($keluhan as $item)
                                <div class="keluhan-status">
                                    @if($item->status == 'proses')
                                        <span class="badge bg-warning">{{ $item->status }}</span>
                                    @elseif($item->status == 'sedang diproses')
                                        <span class="badge bg-primary">{{ $item->status }}</span>
                                    @elseif($item->status == 'selesai')
                                        <span class="badge bg-success">{{ $item->status }}</span>
                                    @endif
                                </div>
                            @endforeach
                                    <td>
                                         <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-success" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ti ti-menu-2">Pilih</i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('backend.keluhan.edit', $data->id) }}">
                                                <i class="ti ti-edit"></i> Edit 
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href=" route('backend.keluhan.show', $data->id) }}">
                                                <i class="ti ti-eye"></i> View
                                            </a>
                                        </li>
                                        <li>
                                            <form action="{{ route('backend.keluhan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
                                    <td colspan="7" class="text-center">Tidak ada keluhan</td>
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
