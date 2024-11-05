<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function index(): JsonResponse
    {
        $cart = Session::get('cart', []);

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
                $total += $subtotal;
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'items' => $cartItems,
                'total' => $total
            ]
            ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        
        if ($product->stock < $validated['quantity']) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not enough stock available'
            ], 400);
        }

        $cart = Session::get('cart', []);
        
        if (isset($cart[$validated['product_id']])) {
            $cart[$validated['product_id']] += $validated['quantity'];
        } else {
            $cart[$validated['product_id']] = $validated['quantity'];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully'
        ], 201);
    }

    public function update(Request $request, $productId): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($productId);
        
        if ($product->stock < $validated['quantity']) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not enough stock available'
            ], 400);
        }

        $cart = Session::get('cart', []);

        if ($validated['quantity'] === 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $validated['quantity'];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully'
        ]);
    }

    public function deleteProduct($productId): JsonResponse
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed from cart'
        ]);
    }

    public function clearCart(): JsonResponse
    {
        Session::forget('cart');

        return response()->json([
            'status' => 'success',
            'message' => 'Cart cleared'
        ])
    }
}
