<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akar Kuadrat Bilangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head> 
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Akar Kuadrat Bilangan</h1>
            <a href="{{ route('logout') }}" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>

        @if(session('error'))
        <div class="alert alert-danger mt-3">
            <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
        </div>
        @endif
        
        <form method="POST" action="{{ route('square_root.calculate') }}" class="mt-3" onsubmit="return validateForm();">
            @csrf
            <div class="row">
                <div class="mb-3">
                    <label for="number" class="form-label">Masukan Bilangan:</label>
                    <input type="text" name="number" id="number" class="form-control" required>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-block">
                <button type="submit" name="method" value="API Service" class="btn btn-primary btn-block">API Service</button>
                <button type="submit" name="method" value="PL/SQL" class="btn btn-primary btn-block">PL/SQL</button>
            </div>
        </form>

        <div id="result" class="mt-3 text-center">
            @if(session('result'))
                <p><strong style="font-size: 24px;">Hasil Perhitungan:</strong></p>
                <div class="alert alert-success" style="font-size: 24px;">
                    <strong>{{ session('result') }}</strong>
                </div>
                @if(session('executionTime'))
                    <p><strong>Waktu Eksekusi:</strong> {{ session('executionTime') }} detik</p>
                @endif
            @endif
        </div>
        
        <script>
            function validateForm() {
                var inputNumber = document.getElementById('number').value;
                var errorAlert = document.getElementById('error-alert');
                var zeroAlert = document.getElementById('zero-alert');
        
                if (parseFloat(inputNumber) <= 0) {
                    zeroAlert.style.display = 'block'; // Tampilkan peringatan jika input <= 0
                    errorAlert.style.display = 'none'; // Sembunyikan pesan kesalahan sebelumnya
                    return false; // Mencegah pengiriman formulir jika input <= 0
                } else {
                    zeroAlert.style.display = 'none'; // Sembunyikan peringatan jika input > 0
                }
        
                return true; // Lanjutkan dengan pengiriman formulir jika input valid
            }
        </script>

        <h2 class="mt-4">History</h2>        
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Angka Input</th>
                    <th>Hasil Akar</th>
                    <th>Metode</th>
                    <th>Waktu Eksekusi</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->input_number }}</td>
                    <td>{{ $item->square_root }}</td>
                    <td>{{ $item->method }}</td>
                    <td>{{ $item->execution_time }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
