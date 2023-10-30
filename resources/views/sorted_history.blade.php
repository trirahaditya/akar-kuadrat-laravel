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

        <form method="get" action="{{ route('square_root.sorted_history') }}">
            <div class="mb-3">
                <select class="form-select" name="sort_order" aria-label="Sort Order">
                    <option value="asc" {{ request('sort_order') === 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') === 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>

        <!-- History Table -->
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

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <!-- Tombol "Previous" -->
                @if ($history->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $history->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif
        
                <!-- Nomor-nomor halaman -->
                @foreach ($history->getUrlRange(1, $history->lastPage()) as $page => $url)
                    @if ($page == $history->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
        
                <!-- Tombol "Next" -->
                @if ($history->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $history->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
        <br>

        <!-- Rekapitulasi Table -->
        <h2 class="mt-4">Rekapitulasi Data</h2>
        <button type="button" class="btn btn-primary" onclick="refreshRekapitulasi()">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </button>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Angka Input</th>
                    <th>Total Respons</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekapData as $rekap)
                <tr>
                    <td>{{ $rekap->input_number }}</td>
                    <td>{{ $rekap->total_respons }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function refreshRekapitulasi() {
            fetch('{{ route('square_root.refreshRekapitulasi') }}') // Ganti dengan rute yang sesuai
                .then(response => response.json()) // Menangani respons sebagai JSON
                .then(data => {
                    // Memperbarui tabel rekapitulasi dengan data yang baru
                    var rekapitulasiTable = document.getElementById('rekapitulasiTable');
                    var tbody = rekapitulasiTable.querySelector('tbody');
                    tbody.innerHTML = ''; // Mengosongkan isi tabel

                    // Memasukkan data yang baru ke dalam tabel
                    data.forEach(item => {
                        var row = document.createElement('tr');
                        var inputNumberCell = document.createElement('td');
                        inputNumberCell.textContent = item.input_number;
                        var totalResponsCell = document.createElement('td');
                        totalResponsCell.textContent = item.total_respons;

                        row.appendChild(inputNumberCell);
                        row.appendChild(totalResponsCell);
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memuat data rekapitulasi: ', error);
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
