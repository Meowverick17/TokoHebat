<!DOCTYPE html>
<html>
<head>
    <title>Login - TokoHebat</title>
</head>
<body>
    <h1>Login</h1>
    
    @if($errors->any())
        <div style="color:red">{{ $errors->first() }}</div>
    @endif
    
    @if(session('success'))
        <div style="color:green">{{ session('success') }}</div>
    @endif
    
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    
    <hr>
    <h3>Demo Bug (Kode Yoga)</h3>
    <p>Coba: <a href="{{ route('login.salah.form') }}">Login versi salah (tanpa password)</a></p>
    <p>Atau: <a href="{{ route('register.salah.form') }}">Register versi salah (password plaintext)</a></p>
</body>
</html>