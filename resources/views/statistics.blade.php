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

        <!-- Tombol Refresh -->
        <button type="button" class="btn btn-primary" id="refreshStatistik">
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
    <!-- Container Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="refreshToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Akar Kuadrat</strong>
                <small>Baru saja</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Tutup"></button>
            </div>
            <div class="toast-body">
                Statistik berhasil diperbarui.
            </div>
        </div>
    </div>
    <script>
        document.getElementById('refreshStatistik').addEventListener('click', function () {
            // Mengirim permintaan AJAX ke rute refreshStatistik
            fetch('{{ route('square_root.refreshStatistik') }}') // Ganti 'refreshRekapitulasi' dengan 'refreshStatistik'
                .then(response => response.json())
                .then(data => {
                    // Memperbarui statistik data
                    document.getElementById('fastestTime').textContent = data.fastestTime;
                    document.getElementById('slowestTime').textContent = data.slowestTime;
                    document.getElementById('averageTime').textContent = data.averageTime;
    
                    // Menampilkan toast
                    var myToast = new bootstrap.Toast(document.getElementById('refreshToast'));
                    myToast.show();
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memuat data statistik: ', error);
                });
        });
    </script>   
    <script>
        document.getElementById('refreshStatistik').addEventListener('click', function () {
            // Menampilkan toast
            var myToast = new bootstrap.Toast(document.getElementById('refreshToast'));
            myToast.show();
        });
    </script>
</body>
</html>