<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);

        // Check stock
        if ($product->stock < $quantity) {
            return back()->with('error', 'สินค้าไม่เพียงพอในสต็อก');
        }

        $cart = $this->getCart(true);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'สินค้าไม่เพียงพอในสต็อก');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return back()->with('success', 'เพิ่มสินค้าลงตะกร้าเรียบร้อยแล้ว');
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:cart_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCart();

        if (!$cart) {
            return response()->json(['success' => false, 'error' => 'ไม่พบตะกร้าสินค้า'], 404);
        }

        $cartItem = $cart->items()->findOrFail($request->item_id);

        // Check stock availability
        if ($cartItem->product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'error' => 'สินค้าไม่เพียงพอในสต็อก (มีเพียง ' . $cartItem->product->stock . ' ชิ้น)'
            ], 400);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        // Refresh cart to get updated totals
        $cart->refresh();

        return response()->json([
            'success' => true,
            'cart_total' => $cart->total,
            'item_count' => $cart->item_count,
            'message' => 'อัพเดทจำนวนสินค้าเรียบร้อย'
        ]);
    }

    public function remove($id)
    {
        $cart = $this->getCart();
        $cart->items()->where('id', $id)->delete();

        return back()->with('success', 'ลบสินค้าออกจากตะกร้าเรียบร้อยแล้ว');
    }

    public function getCartData()
    {
        $cart = $this->getCart();
        $items = $cart ? $cart->items()->with('product')->get() : collect();

        return response()->json([
            'items' => $items,
            'total' => $cart ? $cart->total : 0,
            'item_count' => $cart ? $cart->item_count : 0,
        ]);
    }

    private function getCart($create = false)
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['session_id' => null]
            );
        } else {
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();

            if (!$cart && $create) {
                $cart = Cart::create(['session_id' => $sessionId]);
            }
        }

        return $cart;
    }
}
