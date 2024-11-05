<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with('category')->get();

        $productsData = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                '_embedded' => [
                    'category' => $product->category
                ],
                '_links' => [
                    'self' => route('admin.products.show', ['product' => $product->id]),
                    'edit' => route('admin.products.update', ['product' => $product->id]),
                    'delete' => route('admin.products.destroy', ['product' => $product->id]),
                ]
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $productsData
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|string'
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $product = Product::create($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Product created',
            'data' => [
                'product' => $product,
                '_links' => [
                    'self' => route('admin.products.show', ['product' => $product->id]),
                    'edit' => route('admin.products.update', ['product' => $product->id]),
                    'delete' => route('admin.products.destroy', ['product' => $product->id]),
                ]
            ]
        ], 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'product' => $product->load('category'),
                '_embedded' => [
                    'category' => $product->category
                ],
                '_links' => [
                    'self' => route('admin.products.show', ['product' => $product->id]),
                    'edit' => route('admin.products.update', ['product' => $product->id]),
                    'delete' => route('admin.products.destroy', ['product' => $product->id]),
                ]
            ]
        ]);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'category_id' => 'sometimes|required|exists:categories,id',
            'image_path' => 'nullable|string'
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $product->update($validated);

        return response()->json([
            'status' => 'success',
            'message' => 'Product updated',
            'data' => [
                'product' => $product,
                '_links' => [
                    'self' => route('admin.products.show', ['product' => $product->id]),
                    'edit' => route('admin.products.update', ['product' => $product->id]),
                    'delete' => route('admin.products.destroy', ['product' => $product->id]),
                ]
            ]
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted'
        ]);
    }
}
