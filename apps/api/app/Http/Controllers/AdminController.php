<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get admin dashboard overview
     */
    public function dashboard()
    {
        $dashboardData = [
            'current_event' => [
                'id' => 1,
                'name' => 'Pop-up Cinema Night',
                'status' => 'active',
                'attendees' => 23,
                'capacity' => 50
            ],
            'stats' => [
                'total_orders' => 15,
                'pending_orders' => 3,
                'preparing_orders' => 5,
                'completed_orders' => 7,
                'total_revenue' => 287.50,
                'average_order_value' => 19.17
            ],
            'recent_orders' => [
                [
                    'id' => 15,
                    'seat_number' => 'D-04',
                    'total' => 12.50,
                    'status' => 'pending',
                    'created_at' => '2024-10-20T20:05:00Z'
                ],
                [
                    'id' => 14,
                    'seat_number' => 'C-12',
                    'total' => 21.75,
                    'status' => 'preparing',
                    'created_at' => '2024-10-20T20:02:00Z'
                ]
            ],
            'low_stock_items' => [
                [
                    'id' => 4,
                    'name' => 'Wine Selection',
                    'stock' => 0,
                    'status' => 'out_of_stock'
                ],
                [
                    'id' => 3,
                    'name' => 'Gourmet Hot Dog',
                    'stock' => 3,
                    'status' => 'low_stock'
                ]
            ]
        ];

        return ApiResponse::success($dashboardData, 'Dashboard data retrieved successfully');
    }

    /**
     * Get order management overview
     */
    public function orders()
    {
        $ordersData = [
            'summary' => [
                'total_orders_today' => 15,
                'revenue_today' => 287.50,
                'average_prep_time' => '8 minutes',
                'customer_satisfaction' => 4.7
            ],
            'active_orders' => [
                [
                    'id' => 12,
                    'seat_number' => 'A-15',
                    'status' => 'preparing',
                    'items' => ['Classic Popcorn x2', 'Craft Soda x1'],
                    'total' => 21.75,
                    'prep_time' => '00:05:23',
                    'created_at' => '2024-10-20T19:58:00Z'
                ],
                [
                    'id' => 13,
                    'seat_number' => 'B-22',
                    'status' => 'ready',
                    'items' => ['Gourmet Hot Dog x1'],
                    'total' => 12.00,
                    'prep_time' => '00:08:15',
                    'created_at' => '2024-10-20T19:55:00Z'
                ]
            ],
            'queue_status' => [
                'pending' => 3,
                'preparing' => 5,
                'ready_for_delivery' => 2,
                'estimated_wait_time' => '12 minutes'
            ]
        ];

        return ApiResponse::success($ordersData, 'Order management data retrieved successfully');
    }

    /**
     * Get inventory management data
     */
    public function inventory()
    {
        $inventoryData = [
            'summary' => [
                'total_items' => 25,
                'in_stock' => 21,
                'low_stock' => 3,
                'out_of_stock' => 1,
                'total_value' => 1250.00
            ],
            'items' => [
                [
                    'id' => 1,
                    'name' => 'Classic Popcorn',
                    'current_stock' => 50,
                    'minimum_stock' => 10,
                    'status' => 'in_stock',
                    'sold_today' => 25,
                    'revenue_today' => 212.50
                ],
                [
                    'id' => 2,
                    'name' => 'Craft Soda',
                    'current_stock' => 30,
                    'minimum_stock' => 15,
                    'status' => 'in_stock',
                    'sold_today' => 12,
                    'revenue_today' => 57.00
                ],
                [
                    'id' => 3,
                    'name' => 'Gourmet Hot Dog',
                    'current_stock' => 3,
                    'minimum_stock' => 5,
                    'status' => 'low_stock',
                    'sold_today' => 8,
                    'revenue_today' => 96.00
                ]
            ],
            'alerts' => [
                'Wine Selection is out of stock',
                'Gourmet Hot Dog is running low (3 remaining)',
                'Consider restocking before next event'
            ]
        ];

        return ApiResponse::success($inventoryData, 'Inventory data retrieved successfully');
    }

    /**
     * Get event analytics
     */
    public function analytics()
    {
        $analyticsData = [
            'event_performance' => [
                'attendance_rate' => 76, // percentage
                'concession_participation' => 65, // percentage of attendees who ordered
                'average_spend_per_person' => 12.50,
                'peak_ordering_time' => '20:15 - 20:30'
            ],
            'popular_items' => [
                ['name' => 'Classic Popcorn', 'orders' => 25, 'revenue' => 212.50],
                ['name' => 'Craft Soda', 'orders' => 12, 'revenue' => 57.00],
                ['name' => 'Gourmet Hot Dog', 'orders' => 8, 'revenue' => 96.00]
            ],
            'seat_distribution' => [
                'front_section' => ['orders' => 8, 'revenue' => 145.20],
                'middle_section' => ['orders' => 12, 'revenue' => 187.30],
                'back_section' => ['orders' => 5, 'revenue' => 95.00]
            ],
            'time_analysis' => [
                'busiest_hour' => '20:00 - 21:00',
                'average_order_time' => '2.5 minutes',
                'average_prep_time' => '8 minutes',
                'average_delivery_time' => '3 minutes'
            ]
        ];

        return ApiResponse::success($analyticsData, 'Analytics data retrieved successfully');
    }

    /**
     * Update order status (quick admin action)
     */
    public function updateOrderStatus(Request $request, string $orderId)
    {
        $validStatuses = ['pending', 'preparing', 'ready', 'delivered', 'completed'];
        $newStatus = $request->status;

        if (!in_array($newStatus, $validStatuses)) {
            return ApiResponse::error('Invalid status', 400, [
                ['field' => 'status', 'message' => 'Status must be one of: ' . implode(', ', $validStatuses)]
            ]);
        }

        $updatedOrder = [
            'id' => (int) $orderId,
            'status' => $newStatus,
            'updated_by' => 'admin',
            'updated_at' => now()->toISOString(),
            'status_history' => [
                ['status' => 'pending', 'timestamp' => '2024-10-20T19:58:00Z'],
                ['status' => 'preparing', 'timestamp' => '2024-10-20T20:03:00Z'],
                ['status' => $newStatus, 'timestamp' => now()->toISOString()]
            ]
        ];

        return ApiResponse::success($updatedOrder, "Order status updated to {$newStatus}");
    }
}