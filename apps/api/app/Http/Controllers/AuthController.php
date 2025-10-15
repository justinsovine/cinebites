<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Authenticate user with event passcode
     */
    public function login(Request $request)
    {
        $passcode = $request->passcode;
        $validPasscodes = ['CINEMA2024', 'HORROR2024', 'EVENT1234'];

        if (in_array($passcode, $validPasscodes)) {
            $authData = [
                'access_token' => 'dummy_jwt_token_' . str_replace(' ', '_', now()->toDateTimeString()),
                'token_type' => 'Bearer',
                'expires_in' => 3600, // 1 hour
                'event' => [
                    'id' => $passcode === 'CINEMA2024' ? 1 : 2,
                    'name' => $passcode === 'CINEMA2024' ? 'Pop-up Cinema Night' : 'Horror Movie Marathon',
                    'status' => 'active',
                    'date' => $passcode === 'CINEMA2024' ? '2024-10-20' : '2024-10-31',
                    'location' => $passcode === 'CINEMA2024' ? 'Downtown Theater' : 'Warehouse District'
                ],
                'permissions' => ['order_concessions', 'view_menu', 'track_orders'],
                'authenticated_at' => now()->toISOString()
            ];

            return ApiResponse::success($authData, 'Authentication successful');
        }

        return ApiResponse::error('Invalid passcode', 401);
    }

    /**
     * Logout user and invalidate token
     */
    public function logout(Request $request)
    {
        $logoutData = [
            'token_invalidated' => true,
            'logout_time' => now()->toISOString(),
            'session_duration' => '00:45:23' // dummy session time
        ];

        return ApiResponse::success($logoutData, 'Logged out successfully');
    }

    /**
     * Refresh authentication token
     */
    public function refresh(Request $request)
    {
        $refreshData = [
            'access_token' => 'refreshed_jwt_token_' . str_replace(' ', '_', now()->toDateTimeString()),
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'refreshed_at' => now()->toISOString()
        ];

        return ApiResponse::success($refreshData, 'Token refreshed successfully');
    }

    /**
     * Get current authenticated user info
     */
    public function me(Request $request)
    {
        $userData = [
            'session_id' => 'session_' . rand(100000, 999999),
            'authenticated' => true,
            'event_access' => [
                'event_id' => 1,
                'event_name' => 'Pop-up Cinema Night',
                'passcode_used' => 'CINEMA2024'
            ],
            'permissions' => ['order_concessions', 'view_menu', 'track_orders'],
            'session_started' => now()->subMinutes(45)->toISOString(),
            'last_activity' => now()->toISOString()
        ];

        return ApiResponse::success($userData, 'User data retrieved successfully');
    }

    /**
     * Validate passcode without full authentication
     */
    public function validatePasscode(Request $request)
    {
        $passcode = $request->passcode;
        $validPasscodes = ['CINEMA2024', 'HORROR2024', 'EVENT1234'];

        if (in_array($passcode, $validPasscodes)) {
            $validationData = [
                'valid' => true,
                'event_preview' => [
                    'id' => $passcode === 'CINEMA2024' ? 1 : 2,
                    'name' => $passcode === 'CINEMA2024' ? 'Pop-up Cinema Night' : 'Horror Movie Marathon',
                    'date' => $passcode === 'CINEMA2024' ? '2024-10-20' : '2024-10-31',
                    'status' => 'active'
                ]
            ];

            return ApiResponse::success($validationData, 'Passcode is valid');
        }

        return ApiResponse::error('Invalid passcode', 400, [
            ['field' => 'passcode', 'message' => 'The provided passcode is not valid for any active event']
        ]);
    }
}