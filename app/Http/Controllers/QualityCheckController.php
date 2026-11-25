<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQualityCheckRequest;
use App\Http\Requests\UpdateQualityCheckRequest;
use App\Http\Resources\QualityCheckResource;
use App\Models\QualityCheck;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QualityCheckController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = QualityCheck::query()
            ->with(['batch.product', 'checkedBy'])
            ->latest();

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->integer('batch_id'));
        }

        if ($request->filled('product_id')) {
            $productId = $request->integer('product_id');
            $query->whereHas('batch', fn ($batchQuery) => $batchQuery->where('product_id', $productId));
        }

        if ($request->filled('quality_result')) {
            $query->where('quality_result', $request->string('quality_result')->toString());
        }

        return QualityCheckResource::collection($query->paginate());
    }

    public function store(StoreQualityCheckRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $validated['checked_by'] ??= $request->user()->id;
        $validated['quality_result'] ??= 'pending';

        $qualityCheck = QualityCheck::create($validated);

        return (new QualityCheckResource($qualityCheck->load(['batch.product', 'checkedBy'])))
            ->additional(['message' => 'Quality check created successfully.'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(QualityCheck $qualityCheck): QualityCheckResource
    {
        return new QualityCheckResource($qualityCheck->load(['batch.product', 'checkedBy']));
    }

    public function update(UpdateQualityCheckRequest $request, QualityCheck $qualityCheck): QualityCheckResource
    {
        $qualityCheck->update($request->validated());

        return (new QualityCheckResource($qualityCheck->refresh()->load(['batch.product', 'checkedBy'])))
            ->additional(['message' => 'Quality check updated successfully.']);
    }

    public function destroy(QualityCheck $qualityCheck): JsonResponse
    {
        $qualityCheck->delete();

        return response()->json(null, 204);
    }
}
