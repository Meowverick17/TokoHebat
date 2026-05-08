<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;

class AdminService
{
    public function getUserOrders($userId)
    {
        return Order::where('user_id', $userId)->get();
    }

    public function getStatistics()
    {
        return [
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total_price'),
        ];
    }

    public function getAllUsers()
    {
        return User::all();
    }
}