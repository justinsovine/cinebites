<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Get all events
     */
    public function index()
    {
        $events = [
            [
                'id' => 1,
                'name' => 'Pop-up Cinema Night',
                'status' => 'active',
                'date' => '2024-10-20',
                'location' => 'Downtown Theater',
                'capacity' => 50,
                'passcode' => 'CINEMA2024'
            ],
            [
                'id' => 2,
                'name' => 'Horror Movie Marathon',
                'status' => 'upcoming',
                'date' => '2024-10-31',
                'location' => 'Warehouse District',
                'capacity' => 75,
                'passcode' => 'HORROR2024'
            ]
        ];

        return ApiResponse::success($events, 'Events retrieved successfully');
    }

    /**
     * Get metadata for creating an event
     */
    public function create()
    {
        $metadata = [
            'available_statuses' => ['upcoming', 'active', 'completed'],
            'default_capacity' => 50,
            'max_capacity' => 100,
            'required_fields' => ['name', 'date', 'location', 'capacity']
        ];

        return ApiResponse::success($metadata, 'Event creation metadata');
    }

    /**
     * Create a new event
     */
    public function store(Request $request)
    {
        $newEvent = [
            'id' => 3,
            'name' => $request->name ?? 'New Cinema Event',
            'status' => 'upcoming',
            'date' => $request->date ?? now()->addDays(7)->format('Y-m-d'),
            'location' => $request->location ?? 'TBD Location',
            'capacity' => $request->capacity ?? 50,
            'passcode' => 'EVENT' . rand(1000, 9999),
            'created_at' => now()->toISOString()
        ];

        return ApiResponse::created($newEvent, 'Event created successfully');
    }

    /**
     * Get specific event details
     */
    public function show(string $id)
    {
        if ($id == '1') {
            $event = [
                'id' => 1,
                'name' => 'Pop-up Cinema Night',
                'status' => 'active',
                'date' => '2024-10-20',
                'location' => 'Downtown Theater',
                'description' => 'An evening of classic films under the stars',
                'capacity' => 50,
                'tickets_sold' => 23,
                'passcode' => 'CINEMA2024',
                'created_at' => '2024-10-01T10:00:00Z',
                'updated_at' => '2024-10-15T14:30:00Z'
            ];
            
            return ApiResponse::success($event, 'Event retrieved successfully');
        }

        return ApiResponse::notFound('Event not found');
    }

    /**
     * Get event data for editing
     */
    public function edit(string $id)
    {
        if ($id == '1') {
            $editData = [
                'event' => [
                    'id' => 1,
                    'name' => 'Pop-up Cinema Night',
                    'status' => 'active',
                    'date' => '2024-10-20',
                    'location' => 'Downtown Theater',
                    'capacity' => 50,
                    'passcode' => 'CINEMA2024'
                ],
                'metadata' => [
                    'available_statuses' => ['upcoming', 'active', 'completed'],
                    'max_capacity' => 100
                ]
            ];
            
            return ApiResponse::success($editData, 'Event edit data retrieved');
        }

        return ApiResponse::notFound('Event not found');
    }

    /**
     * Update an existing event
     */
    public function update(Request $request, string $id)
    {
        if ($id == '1') {
            $updatedEvent = [
                'id' => 1,
                'name' => $request->name ?? 'Pop-up Cinema Night',
                'status' => $request->status ?? 'active',
                'date' => $request->date ?? '2024-10-20',
                'location' => $request->location ?? 'Downtown Theater',
                'capacity' => $request->capacity ?? 50,
                'passcode' => $request->passcode ?? 'CINEMA2024',
                'updated_at' => now()->toISOString()
            ];
            
            return ApiResponse::success($updatedEvent, 'Event updated successfully');
        }

        return ApiResponse::notFound('Event not found');
    }

    /**
     * Delete an event
     */
    public function destroy(string $id)
    {
        if ($id == '1') {
            $deletionInfo = [
                'deleted_event_id' => (int) $id,
                'deleted_at' => now()->toISOString()
            ];

            return ApiResponse::success($deletionInfo, 'Event deleted successfully');
        }

        return ApiResponse::notFound('Event not found');
    }

    /**
     * Get the current active event for concessions ordering
     */
    public function current()
    {
        $activeEvent = [
            'id' => 1,
            'name' => 'Pop-up Cinema Night',
            'status' => 'active',
            'date' => '2024-10-20',
            'location' => 'Downtown Theater',
            'capacity' => 50,
            'tickets_sold' => 23,
            'passcode' => 'CINEMA2024',
            'concessions_available' => true
        ];

        return ApiResponse::success($activeEvent, 'Current active event retrieved');
    }
}