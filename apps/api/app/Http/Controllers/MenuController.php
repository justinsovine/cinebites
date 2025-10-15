<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Get all menu items
     */
    public function index()
    {
        $menuItems = [
            [
                'id' => 1,
                'name' => 'Classic Popcorn',
                'description' => 'Freshly popped buttery popcorn',
                'price' => 8.50,
                'category' => 'snacks',
                'available' => true,
                'stock' => 50
            ],
            [
                'id' => 2,
                'name' => 'Craft Soda',
                'description' => 'Artisanal cola with natural ingredients',
                'price' => 4.75,
                'category' => 'drinks',
                'available' => true,
                'stock' => 30
            ],
            [
                'id' => 3,
                'name' => 'Gourmet Hot Dog',
                'description' => 'Premium beef hot dog with artisan toppings',
                'price' => 12.00,
                'category' => 'food',
                'available' => true,
                'stock' => 20
            ],
            [
                'id' => 4,
                'name' => 'Wine Selection',
                'description' => 'Local wine pairing with the film',
                'price' => 15.00,
                'category' => 'drinks',
                'available' => false,
                'stock' => 0
            ]
        ];

        return ApiResponse::success($menuItems, 'Menu items retrieved successfully');
    }

    /**
     * Get metadata for creating a menu item
     */
    public function create()
    {
        $metadata = [
            'categories' => ['snacks', 'drinks', 'food', 'desserts'],
            'price_range' => ['min' => 2.00, 'max' => 25.00],
            'required_fields' => ['name', 'price', 'category'],
            'stock_limits' => ['min' => 0, 'max' => 100]
        ];

        return ApiResponse::success($metadata, 'Menu item creation metadata');
    }

    /**
     * Create a new menu item
     */
    public function store(Request $request)
    {
        $newMenuItem = [
            'id' => 5,
            'name' => $request->name ?? 'New Menu Item',
            'description' => $request->description ?? 'Delicious concession item',
            'price' => $request->price ?? 5.00,
            'category' => $request->category ?? 'snacks',
            'available' => true,
            'stock' => $request->stock ?? 25,
            'created_at' => now()->toISOString()
        ];

        return ApiResponse::created($newMenuItem, 'Menu item created successfully');
    }

    /**
     * Get specific menu item details
     */
    public function show(string $id)
    {
        if ($id == '1') {
            $menuItem = [
                'id' => 1,
                'name' => 'Classic Popcorn',
                'description' => 'Freshly popped buttery popcorn served in vintage cinema containers',
                'price' => 8.50,
                'category' => 'snacks',
                'available' => true,
                'stock' => 50,
                'ingredients' => ['Corn kernels', 'Butter', 'Salt'],
                'allergens' => ['Contains dairy'],
                'created_at' => '2024-10-01T10:00:00Z',
                'updated_at' => '2024-10-15T14:30:00Z'
            ];
            
            return ApiResponse::success($menuItem, 'Menu item retrieved successfully');
        }

        return ApiResponse::notFound('Menu item not found');
    }

    /**
     * Get menu item data for editing
     */
    public function edit(string $id)
    {
        if ($id == '1') {
            $editData = [
                'menu_item' => [
                    'id' => 1,
                    'name' => 'Classic Popcorn',
                    'description' => 'Freshly popped buttery popcorn',
                    'price' => 8.50,
                    'category' => 'snacks',
                    'available' => true,
                    'stock' => 50
                ],
                'metadata' => [
                    'categories' => ['snacks', 'drinks', 'food', 'desserts'],
                    'price_range' => ['min' => 2.00, 'max' => 25.00]
                ]
            ];
            
            return ApiResponse::success($editData, 'Menu item edit data retrieved');
        }

        return ApiResponse::notFound('Menu item not found');
    }

    /**
     * Update an existing menu item
     */
    public function update(Request $request, string $id)
    {
        if ($id == '1') {
            $updatedMenuItem = [
                'id' => 1,
                'name' => $request->name ?? 'Classic Popcorn',
                'description' => $request->description ?? 'Freshly popped buttery popcorn',
                'price' => $request->price ?? 8.50,
                'category' => $request->category ?? 'snacks',
                'available' => $request->available ?? true,
                'stock' => $request->stock ?? 50,
                'updated_at' => now()->toISOString()
            ];
            
            return ApiResponse::success($updatedMenuItem, 'Menu item updated successfully');
        }

        return ApiResponse::notFound('Menu item not found');
    }

    /**
     * Delete a menu item
     */
    public function destroy(string $id)
    {
        if ($id == '1') {
            $deletionInfo = [
                'deleted_menu_item_id' => (int) $id,
                'deleted_at' => now()->toISOString()
            ];

            return ApiResponse::success($deletionInfo, 'Menu item deleted successfully');
        }

        return ApiResponse::notFound('Menu item not found');
    }
}