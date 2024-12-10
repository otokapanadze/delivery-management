<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDispatcherRequest;
use App\Http\Requests\UpdateDispatcherRequest;
use App\Models\Dispatcher;
use Illuminate\Http\JsonResponse;

class DispatcherApiController extends Controller
{
    /**
     * Display a listing of the dispatchers.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Fetch all dispatchers with pagination
        $dispatchers = Dispatcher::paginate(10);

        // Return a resource collection
        return response()->json([
            'success' => true,
            'data' => DispatcherResource::collection($dispatchers),
        ], 200);
    }

    /**
     * Store a newly created dispatcher in storage.
     *
     * @param StoreDispatcherRequest $request
     * @return JsonResponse
     */
    public function store(StoreDispatcherRequest $request): JsonResponse
    {
        // Validate and create the dispatcher
        $dispatcher = Dispatcher::create($request->validated());

        // Return the created dispatcher as a resource
        return response()->json([
            'success' => true,
            'message' => 'Dispatcher created successfully.',
            'data' => new DispatcherResource($dispatcher),
        ], 201);
    }

    /**
     * Display the specified dispatcher.
     *
     * @param Dispatcher $dispatcher
     * @return JsonResponse
     */
    public function show(Dispatcher $dispatcher): JsonResponse
    {
        // Return the dispatcher as a resource
        return response()->json([
            'success' => true,
            'data' => new DispatcherResource($dispatcher),
        ], 200);
    }

    /**
     * Update the specified dispatcher in storage.
     *
     * @param UpdateDispatcherRequest $request
     * @param Dispatcher $dispatcher
     * @return JsonResponse
     */
    public function update(UpdateDispatcherRequest $request, Dispatcher $dispatcher): JsonResponse
    {
        // Validate and update the dispatcher
        $dispatcher->update($request->validated());

        // Return the updated dispatcher as a resource
        return response()->json([
            'success' => true,
            'message' => 'Dispatcher updated successfully.',
            'data' => new DispatcherResource($dispatcher),
        ], 200);
    }

    /**
     * Remove the specified dispatcher from storage.
     *
     * @param Dispatcher $dispatcher
     * @return JsonResponse
     */
    public function destroy(Dispatcher $dispatcher): JsonResponse
    {
        $dispatcher->delete();

        // Return a success message
        return response()->json([
            'success' => true,
            'message' => 'Dispatcher deleted successfully.',
        ], 200);
    }
}
