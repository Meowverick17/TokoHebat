<!DOCTYPE html>
<html>
<head>
    <title>Register - TokoHebat</title>
</head>
<body>
    <h1>Register</h1>
    
    @if($errors->any())
        <div style="color:red">{{ $errors->first() }}</div>
    @endif
    
    <form method="POST" action="{{ route('register.post') }}">
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password (min 8 karakter):</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>