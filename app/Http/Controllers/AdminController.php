<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Services\AdminService;
use App\Handlers\AuthorizationHandler;

class AdminController extends Controller
{
    protected $adminService;
    protected $authHandler;

    public function __construct()
    {
        $this->adminService = new AdminService();
        $this->authHandler = new AuthorizationHandler();
    }

    // ==================== WEB - BUG IDOR (SALAH) ====================

    public function dashboardSalah($id)
    {
        $user = User::find($id);
        $orders = Order::where('user_id', $id)->get();

        return view('admin.dashboard', [
            'user' => $user,
            'orders' => $orders,
            'statistics' => [
                'total_users' => User::count(),
                'total_orders' => Order::count(),
            ]
        ]);
    }

    // ==================== WEB - BENAR ====================

    public function dashboardBenar($id)
    {
        if (!$this->authHandler->isAdmin()) {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        $user = User::findOrFail($id);
        $orders = $this->adminService->getUserOrders($id);
        $statistics = $this->adminService->getStatistics();

        return view('admin.dashboard', [
            'user' => $user,
            'orders' => $orders,
            'statistics' => $statistics
        ]);
    }

    // ==================== API - BUG IDOR (SALAH) ====================

    public function dashboardSalahApi($id)
    {
        $user = User::find($id);
        $orders = Order::where('user_id', $id)->get();

        return response()->json([
            'success' => true,
            'message' => 'BUG: User biasa bisa akses admin!',
            'data' => [
                'user' => $user,
                'orders' => $orders,
            ]
        ]);
    }

    // ==================== API - BENAR ====================

    public function dashboardBenarApi($id)
    {
        if (!$this->authHandler->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden: Hanya admin yang bisa mengakses'
            ], 403);
        }

        $user = User::findOrFail($id);
        $orders = $this->adminService->getUserOrders($id);

        return response()->json([
            'success' => true,
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role
                ],
                'orders' => $orders
            ]
        ]);
    }

    public function statisticsApi()
    {
        if (!$this->authHandler->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Forbidden: Hanya admin yang bisa mengakses'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $this->adminService->getStatistics()
        ]);
    }
}