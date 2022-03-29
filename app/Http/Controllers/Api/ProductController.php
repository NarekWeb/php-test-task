<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Services\ProductService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(): JsonResponse
    {
        $products = $this->productService->all();

        return response()->json(ProductResource::collection($products), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(CreateProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());

        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product = $this->productService->update($request->validated(), $product);

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->productService->delete($product);

        return response()->json([
            'message' => 'Category successfully deleted',
        ], 204);
    }
}
