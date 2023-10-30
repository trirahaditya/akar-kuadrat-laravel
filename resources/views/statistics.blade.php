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
        <!-- Bagian Offcanvas -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Isi dengan menu atau konten offcanvas -->
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('square_root.index') }}">Dashboard</a></li>
                    <li class="list-group-item"><a href="{{ route('square_root.history') }}">History</a></li>
                    <li class="list-group-item"><a href="{{ route('square_root.statistics') }}">Statistik Data</a></li>
                    <li class="list-group-item"><a href="{{ route('logout') }}">Logout</a></li> <!-- Tambahkan ini -->
                </ul>
            </div>
        </div>

        <!-- Bagian Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="bi bi-list"></i> 
            </button>
            <h1>Akar Kuadrat Bilangan</h1>
        </div>

        <button type="button" class="btn btn-primary" onclick="refreshRekapitulasi()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
        
        <h2 class="mt-4">Statistik Data</h2>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Perbedaan Waktu Tercepat</th>
                    <th>Perbedaan Waktu Terlama</th>
                    <th>Rerata Waktu Pemrosesan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $fastestTime }}</td>
                    <td>{{ $slowestTime }}</td>
                    <td>{{ $averageTime }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>