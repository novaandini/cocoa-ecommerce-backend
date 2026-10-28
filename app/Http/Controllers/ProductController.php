<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(
            Product::query()->latest()->paginate(),
        );
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->additional(['message' => 'Product created successfully.'])
            ->response()
            ->setStatusCode(201);
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $product->update($request->validated());

        return (new ProductResource($product->refresh()))
            ->additional(['message' => 'Product updated successfully.']);
    }

    public function destroy(Product $product): JsonResponse
    {
        if ($product->batches()->exists() || $product->orderItems()->exists()) {
            return response()->json([
                'message' => 'This product cannot be deleted because it is used by batches or order items.',
            ], 409);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}
