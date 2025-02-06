@extends('layouts.tampilan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('pengumuman') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('backend.pengumuman.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <hr>
                    <h4>{{ $pengumuman->judul }}</h4>
                    <p class="tmt-3">
                        {!! $pengumuman->deskripsi !!}
                    </p>
                    <p>
                        {!! $pengumuman->tanggal !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection