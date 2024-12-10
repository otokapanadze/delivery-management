<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryUpdateRequest;
use App\Http\Requests\UpdateDeliveryUpdateRequest;
use App\Models\DeliveryUpdate;
use Illuminate\Http\JsonResponse;

class DeliveryUpdateApiController extends Controller
{
    /**
     * Display a listing of the delivery updates.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Fetch all delivery updates with pagination
        $deliveryUpdates = DeliveryUpdate::paginate(10);

        // Return a resource collection
        return response()->json([
            'success' => true,
            'data' => DeliveryUpdateResource::collection($deliveryUpdates),
        ], 200);
    }

    /**
     * Store a newly created delivery update in storage.
     *
     * @param StoreDeliveryUpdateRequest $request
     * @return JsonResponse
     */
    public function store(StoreDeliveryUpdateRequest $request): JsonResponse
    {
        // Validate and create the delivery update
        $deliveryUpdate = DeliveryUpdate::create($request->validated());

        // Return the created delivery update as a resource
        return response()->json([
            'success' => true,
            'message' => 'Delivery update created successfully.',
            'data' => new DeliveryUpdateResource($deliveryUpdate),
        ], 201);
    }

    /**
     * Display the specified delivery update.
     *
     * @param DeliveryUpdate $deliveryUpdate
     * @return JsonResponse
     */
    public function show(DeliveryUpdate $deliveryUpdate): JsonResponse
    {
        // Return the delivery update as a resource
        return response()->json([
            'success' => true,
            'data' => new DeliveryUpdateResource($deliveryUpdate),
        ], 200);
    }

    /**
     * Update the specified delivery update in storage.
     *
     * @param UpdateDeliveryUpdateRequest $request
     * @param DeliveryUpdate $deliveryUpdate
     * @return JsonResponse
     */
    public function update(UpdateDeliveryUpdateRequest $request, DeliveryUpdate $deliveryUpdate): JsonResponse
    {
        // Validate and update the delivery update
        $deliveryUpdate->update($request->validated());

        // Return the updated delivery update as a resource
        return response()->json([
            'success' => true,
            'message' => 'Delivery update updated successfully.',
            'data' => new DeliveryUpdateResource($deliveryUpdate),
        ], 200);
    }

    /**
     * Remove the specified delivery update from storage.
     *
     * @param DeliveryUpdate $deliveryUpdate
     * @return JsonResponse
     */
    public function destroy(DeliveryUpdate $deliveryUpdate): JsonResponse
    {
        $deliveryUpdate->delete();

        // Return a success message
        return response()->json([
            'success' => true,
            'message' => 'Delivery update deleted successfully.',
        ], 200);
    }
}
