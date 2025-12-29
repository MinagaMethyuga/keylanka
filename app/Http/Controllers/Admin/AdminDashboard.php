<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Controller
{
    public function index()
    {
        // Existing stats
        $ProductCount = Product::all()->count();
        $OrderCount = Order::all()->count();
        $TotalEarning = Order::sum('paid_amount');
        $VerifiedUsers = User::where('verified', '1')->count();

        // Sales Chart Data (Last 30 Days)
        $salesChartData = $this->getSalesChartData();
        $last30DaysSales = $salesChartData['total'];
        $salesGrowth = $salesChartData['growth'];

        // Traffic Chart Data (Last 7 Days)
        $trafficChartData = $this->getTrafficChartData();
        $last7DaysOrders = $trafficChartData['total'];
        $trafficGrowth = $trafficChartData['growth'];

        // Latest Orders (Last 5)
        $latestOrders = Order::latest()
            ->take(5)
            ->get()
            ->map(function($order) {
                // Get user relationship if it exists, otherwise use order fields
                $customerName = 'Guest';
                if ($order->user) {
                    $customerName = $order->user->name;
                } elseif (isset($order->customer_name)) {
                    $customerName = $order->customer_name;
                } elseif (isset($order->name)) {
                    $customerName = $order->name;
                }

                return (object)[
                    'order_id' => $order->id,
                    'customer_name' => $customerName,
                    'created_at' => $order->created_at,
                    'status' => $order->status ?? 'pending',
                    'total' => $order->paid_amount ?? $order->total ?? 0
                ];
            });

        return view('dashboard', compact(
            'ProductCount',
            'OrderCount',
            'TotalEarning',
            'VerifiedUsers',
            'salesChartData',
            'last30DaysSales',
            'salesGrowth',
            'trafficChartData',
            'last7DaysOrders',
            'trafficGrowth',
            'latestOrders'
        ));
    }

    private function getSalesChartData()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(29);

        // Get daily sales for last 30 days
        $dailySales = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(paid_amount) as total')
        )
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Prepare data for chart
        $labels = [];
        $values = [];
        $current = $startDate->copy();

        while ($current <= $endDate) {
            $dateStr = $current->format('Y-m-d');
            $labels[] = $current->format('M d');
            $values[] = isset($dailySales[$dateStr]) ? (float)$dailySales[$dateStr]->total : 0;
            $current->addDay();
        }

        // Calculate total and growth
        $total = array_sum($values);

        // Get previous 30 days for growth calculation
        $previousStartDate = $startDate->copy()->subDays(30);
        $previousEndDate = $startDate->copy()->subDay();

        $previousTotal = Order::whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->whereNotIn('status', ['cancelled', 'refunded'])
            ->sum('paid_amount');

        $growth = $previousTotal > 0 ? (($total - $previousTotal) / $previousTotal) * 100 : 0;

        return [
            'labels' => $labels,
            'values' => $values,
            'total' => $total,
            'growth' => $growth
        ];
    }

    private function getTrafficChartData()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(6);

        // Get daily order count for last 7 days
        $dailyOrders = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Prepare data for chart
        $labels = [];
        $values = [];
        $current = $startDate->copy();

        while ($current <= $endDate) {
            $dateStr = $current->format('Y-m-d');
            $labels[] = $current->format('D');
            $values[] = isset($dailyOrders[$dateStr]) ? (int)$dailyOrders[$dateStr]->count : 0;
            $current->addDay();
        }

        // Calculate total and growth
        $total = array_sum($values);

        // Get previous 7 days for growth calculation
        $previousStartDate = $startDate->copy()->subDays(7);
        $previousEndDate = $startDate->copy()->subDay();

        $previousTotal = Order::whereBetween('created_at', [$previousStartDate, $previousEndDate])
            ->count();

        $growth = $previousTotal > 0 ? (($total - $previousTotal) / $previousTotal) * 100 : 0;

        return [
            'labels' => $labels,
            'values' => $values,
            'total' => $total,
            'growth' => $growth
        ];
    }

    public function ManageKeyIndex()
    {
        $items = Product::all();

        return view('AdminManageProducts', compact('items'));
    }
}
