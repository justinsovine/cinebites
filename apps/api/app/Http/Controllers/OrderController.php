<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Get all orders
     */
    public function index()
    {
        $orders = [
            [
                'id' => 1,
                'event_id' => 1,
                'seat_number' => 'A-12',
                'status' => 'completed',
                'total' => 21.25,
                'items_count' => 3,
                'created_at' => '2024-10-20T19:15:00Z'
            ],
            [
                'id' => 2,
                'event_id' => 1,
                'seat_number' => 'B-08',
                'status' => 'preparing',
                'total' => 12.50,
                'items_count' => 2,
                'created_at' => '2024-10-20T19:22:00Z'
            ],
            [
                'id' => 3,
                'event_id' => 1,
                'seat_number' => 'C-15',
                'status' => 'pending',
                'total' => 8.50,
                'items_count' => 1,
                'created_at' => '2024-10-20T19:28:00Z'
            ]
        ];

        return ApiResponse::success($orders, 'Orders retrieved successfully');
    }

    /**
     * Get metadata for creating an order
     */
    public function create()
    {
        $metadata = [
            'available_seats' => ['A-01', 'A-02', 'A-03', 'B-01', 'B-02', 'C-01'],
            'order_statuses' => ['pending', 'preparing', 'ready', 'delivered', 'completed'],
            'current_event_id' => 1,
            'delivery_time_estimate' => '10-15 minutes'
        ];

        return ApiResponse::success($metadata, 'Order creation metadata');
    }

    /**
     * Create a new order
     */
    public function store(Request $request)
    {
        $newOrder = [
            'id' => 4,
            'event_id' => $request->event_id ?? 1,
            'seat_number' => $request->seat_number ?? 'D-01',
            'status' => 'pending',
            'items' => $request->items ?? [
                [
                    'menu_item_id' => 1,
                    'name' => 'Classic Popcorn',
                    'quantity' => 1,
                    'price' => 8.50,
                    'subtotal' => 8.50
                ]
            ],
            'total' => $request->total ?? 8.50,
            'items_count' => count($request->items ?? [1]),
            'estimated_delivery' => now()->addMinutes(12)->toISOString(),
            'created_at' => now()->toISOString()
        ];

        return ApiResponse::created($newOrder, 'Order created successfully');
    }

    /**
     * Get specific order details
     */
    public function show(string $id)
    {
        if ($id == '1') {
            $order = [
                'id' => 1,
                'event_id' => 1,
                'event_name' => 'Pop-up Cinema Night',
                'seat_number' => 'A-12',
                'status' => 'completed',
                'items' => [
                    [
                        'menu_item_id' => 1,
                        'name' => 'Classic Popcorn',
                        'quantity' => 2,
                        'price' => 8.50,
                        'subtotal' => 17.00
                    ],
                    [
                        'menu_item_id' => 2,
                        'name' => 'Craft Soda',
                        'quantity' => 1,
                        'price' => 4.75,
                        'subtotal' => 4.75
                    ]
                ],
                'subtotal' => 21.75,
                'tax' => 0.00,
                'total' => 21.75,
                'payment_status' => 'paid',
                'estimated_delivery' => '2024-10-20T19:27:00Z',
                'delivered_at' => '2024-10-20T19:25:00Z',
                'created_at' => '2024-10-20T19:15:00Z',
                'updated_at' => '2024-10-20T19:25:00Z'
            ];
            
            return ApiResponse::success($order, 'Order retrieved successfully');
        }

        return ApiResponse::notFound('Order not found');
    }

    /**
     * Get order data for editing
     */
    public function edit(string $id)
    {
        if ($id == '2') {
            $editData = [
                'order' => [
                    'id' => 2,
                    'event_id' => 1,
                    'seat_number' => 'B-08',
                    'status' => 'preparing'
                ],
                'metadata' => [
                    'available_statuses' => ['pending', 'preparing', 'ready', 'delivered', 'completed'],
                    'can_modify_items' => false,
                    'can_change_status' => true
                ]
            ];
            
            return ApiResponse::success($editData, 'Order edit data retrieved');
        }

        return ApiResponse::notFound('Order not found');
    }

    /**
     * Update an existing order
     */
    public function update(Request $request, string $id)
    {
        if ($id == '2') {
            $updatedOrder = [
                'id' => 2,
                'event_id' => 1,
                'seat_number' => 'B-08',
                'status' => $request->status ?? 'ready',
                'total' => 12.50,
                'items_count' => 2,
                'updated_at' => now()->toISOString(),
                'status_changed_at' => now()->toISOString()
            ];
            
            return ApiResponse::success($updatedOrder, 'Order updated successfully');
        }

        return ApiResponse::notFound('Order not found');
    }

    /**
     * Delete an order
     */
    public function destroy(string $id)
    {
        if ($id == '3') {
            $deletionInfo = [
                'deleted_order_id' => (int) $id,
                'refund_amount' => 8.50,
                'deleted_at' => now()->toISOString()
            ];

            return ApiResponse::success($deletionInfo, 'Order cancelled and refunded successfully');
        }

        return ApiResponse::notFound('Order not found');
    }
}