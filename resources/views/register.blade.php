<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required>
        <br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login disini</a></p>
</body>
</html>
