<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Halaman Notifikasi</h2>

        @if ($message = Session::get('sukses'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        @if ($message = Session::get('gagal'))
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @endif

        <a href="{{ url('/notifikasi/sukses') }}" class="btn btn-success">Notifikasi Sukses</a>
        <a href="{{ url('/notifikasi/gagal') }}" class="btn btn-danger">Notifikasi Gagal</a>
    </div>
</body>
</html>
