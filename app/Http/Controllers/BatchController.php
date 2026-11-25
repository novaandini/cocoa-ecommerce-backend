<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBatchRequest;
use App\Http\Requests\UpdateBatchRequest;
use App\Http\Resources\BatchResource;
use App\Models\Batch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BatchController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Batch::query()->with('product')->latest();

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->integer('product_id'));
        }

        return BatchResource::collection($query->paginate());
    }

    public function store(StoreBatchRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['available_quantity_kg'] ??= $validated['initial_quantity_kg'];

        $batch = Batch::create($validated);

        return (new BatchResource($batch->load('product')))
            ->additional(['message' => 'Batch created successfully.'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(Batch $batch): BatchResource
    {
        return new BatchResource($batch->load('product'));
    }

    public function update(UpdateBatchRequest $request, Batch $batch): BatchResource
    {
        $batch->update($request->validated());

        return (new BatchResource($batch->refresh()->load('product')))
            ->additional(['message' => 'Batch updated successfully.']);
    }

    public function destroy(Batch $batch): JsonResponse
    {
        if (
            $batch->orderItems()->exists()
            || $batch->qualityChecks()->exists()
            || $batch->stockMovements()->exists()
        ) {
            return response()->json([
                'message' => 'This batch cannot be deleted because it is used by order items, quality checks, or stock movements.',
            ], 409);
        }

        $batch->delete();

        return response()->json([
           'message' => 'Batch deleted successfully.',
        ], 200);
    }
}
