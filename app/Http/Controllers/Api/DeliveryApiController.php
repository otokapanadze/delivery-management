<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Requests\UpdateDeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use Illuminate\Http\JsonResponse;

class DeliveryApiController extends Controller
{
    /**
     * Display a listing of the deliveries.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Fetch all deliveries with pagination
        $deliveries = Delivery::paginate(10);

        // Return a resource collection
        return response()->json([
            'success' => true,
            'data' => DeliveryResource::collection($deliveries),
        ], 200);
    }

    /**
     * Store a newly created delivery in storage.
     *
     * @param StoreDeliveryRequest $request
     * @return JsonResponse
     */
    public function store(StoreDeliveryRequest $request): JsonResponse
    {
        // Validate and create the delivery
        $delivery = Delivery::create($request->validated());

        // Return the created delivery as a resource
        return response()->json([
            'success' => true,
            'message' => 'Delivery created successfully.',
            'data' => new DeliveryResource($delivery),
        ], 201);
    }

    /**
     * Display the specified delivery.
     *
     * @param Delivery $delivery
     * @return JsonResponse
     */
    public function show(Delivery $delivery): JsonResponse
    {
        // Return the delivery as a resource
        return response()->json([
            'success' => true,
            'data' => new DeliveryResource($delivery),
        ], 200);
    }

    /**
     * Update the specified delivery in storage.
     *
     * @param UpdateDeliveryRequest $request
     * @param Delivery $delivery
     * @return JsonResponse
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery): JsonResponse
    {
        // Validate and update the delivery
        $delivery->update($request->validated());

        // Return the updated delivery as a resource
        return response()->json([
            'success' => true,
            'message' => 'Delivery updated successfully.',
            'data' => new DeliveryResource($delivery),
        ], 200);
    }

    /**
     * Remove the specified delivery from storage.
     *
     * @param Delivery $delivery
     * @return JsonResponse
     */
    public function destroy(Delivery $delivery): JsonResponse
    {
        $delivery->delete();

        // Return a success message
        return response()->json([
            'success' => true,
            'message' => 'Delivery deleted successfully.',
        ], 200);
    }
}
