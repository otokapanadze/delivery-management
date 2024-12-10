<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Resources\DriverResource;
use App\Models\Driver;
use Illuminate\Http\JsonResponse;

class DriverApiController extends Controller
{
    /**
     * Display a listing of the drivers.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Fetch all drivers with pagination
        $drivers = Driver::paginate(10);

        // Return a resource collection
        return response()->json([
            'success' => true,
            'data' => DriverResource::collection($drivers),
        ], 200);
    }

    /**
     * Store a newly created driver in storage.
     *
     * @param StoreDriverRequest $request
     * @return JsonResponse
     */
    public function store(StoreDriverRequest $request): JsonResponse
    {
        // Validate and create the driver
        $driver = Driver::create($request->validated());

        // Return the created driver as a resource
        return response()->json([
            'success' => true,
            'message' => 'Driver created successfully.',
            'data' => new DriverResource($driver),
        ], 201);
    }

    /**
     * Display the specified driver.
     *
     * @param Driver $driver
     * @return JsonResponse
     */
    public function show(Driver $driver): JsonResponse
    {
        // Return the driver as a resource
        return response()->json([
            'success' => true,
            'data' => new DriverResource($driver),
        ], 200);
    }

    /**
     * Update the specified driver in storage.
     *
     * @param UpdateDriverRequest $request
     * @param Driver $driver
     * @return JsonResponse
     */
    public function update(UpdateDriverRequest $request, Driver $driver): JsonResponse
    {
        // Validate and update the driver
        $driver->update($request->validated());

        // Return the updated driver as a resource
        return response()->json([
            'success' => true,
            'message' => 'Driver updated successfully.',
            'data' => new DriverResource($driver),
        ], 200);
    }

    /**
     * Remove the specified driver from storage.
     *
     * @param Driver $driver
     * @return JsonResponse
     */
    public function destroy(Driver $driver): JsonResponse
    {
        $driver->delete();

        // Return a success message
        return response()->json([
            'success' => true,
            'message' => 'Driver deleted successfully.',
        ], 200);
    }
}
