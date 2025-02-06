@extends('layouts.tampilan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">{{ __('Tambah Keluhan') }}</div>
                </div>

                <div class="card-body">
                    <form action="{{ route('backend.keluhan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                                <label class="form-label">jenis keluhan</label>
                                <select name="kategori_id" class="form-control">
                                    @forelse ($kategori as $data)
                                    <option value="{{ $data->kategori}}" @error('kategori_id') is-invalid @enderror>
                                        {{$data->kategori}}</option>
                                        @empty
                                    <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                                <label class="form-label">Departemen</label>
                                <select name="kategori_id" class="form-control">
                                    @forelse ($departemen as $data)
                                    <option value="{{ $data->id}}" @error('departemen_id') is-invalid @enderror>
                                        {{$data->id}}</option>
                                    @empty
                                    <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                    </div>

                        <<div class="mb-3">
                                <label class="form-label">priority</label>
                                <select name="kategori_id" class="form-control">
                                    @forelse ($priority as $data)
                                    <option value="{{ $data->priority}}" @error('priority_id') is-invalid @enderror>
                                        {{$data->priority}}</option>
                                    @empty
                                    <option value="" disabled>Data Belum Tersedia</option>
                                    @endforelse
                                </select>
                    </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
