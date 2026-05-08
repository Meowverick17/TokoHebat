<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - TokoHebat</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Welcome, {{ auth()->user()->email }}</p>
    <p>Role: {{ auth()->user()->role }}</p>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    
    @if(auth()->user()->role === 'admin')
        <hr>
        <h3>Admin Menu</h3>
        <a href="{{ route('admin.dashboard', auth()->user()->id) }}">Admin Dashboard</a>
    @endif
</body>
</html>