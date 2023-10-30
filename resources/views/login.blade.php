@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="nim">NIM:</label>
    <input type="text" name="nim" id="nim" required>
    <br>
    <button type="submit">Login</button>
</form>
<p>Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a></p>
