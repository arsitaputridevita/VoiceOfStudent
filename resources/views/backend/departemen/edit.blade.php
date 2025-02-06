@extends('layouts.tampilan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Dashboard') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('backend.departemen.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                        <form action="{{ route('backend.departemen.update', $departemen->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Departemen</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $departemen->nama }}" required>
                        @error('nama')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                                <label class="form-label">Departemen</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    @forelse ($kategori as $data)
                                        <option value="{{ $data->id}}" @error('kategori_id') is-invalid @enderror>
                                            {{ $data->kategori }}</option>
                                    @empty
                                        <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                            </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                     <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                                value="{{ old('image') }}" required></input>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection