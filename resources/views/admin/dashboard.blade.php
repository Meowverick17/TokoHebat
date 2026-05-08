<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - TokoHebat</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, Admin {{ $user->email }}</p>
    
    <h3>User Orders</h3>
    <table border="1">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->product_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>Rp {{ number_format($order->total_price) }}</td>
        </tr>
        @endforeach
    </table>
    
    <h3>Statistics</h3>
    <p>Total Users: {{ $statistics['total_users'] }}</p>
    <p>Total Orders: {{ $statistics['total_orders'] }}</p>
    
    <a href="/dashboard">Back to Dashboard</a>
</body>
</html>