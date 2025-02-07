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
                            <label class="form-label">Jenis Keluhan</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">-- Pilih Keluhan --</option>
                                @foreach ($kategori as $data)
                                    <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Departemen</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}">{{ $data->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                        <div class="mb-3">
                            <label class="form-label">Priority</label>
                            <select name="priority_id" class="form-control">
                                <option value="">-- Pilih Priority --</option>
                                @foreach ($priority as $data)
                                    <option value="{{ $data->id }}">{{ $data->priority }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control"></textarea>
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
