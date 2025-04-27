<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
       
        
        $totalPrice = 0;
        foreach ($cart as $productId => $details) {
            $totalPrice += $details['price'] * $details['quantity'];
        }

        return view('pages.cart', compact('cart', 'totalPrice'));
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->title,
                'price' => $product->price,
                'quantity' => 1,
                'image_url' => $product->image_url,
                'author' => $product->author,
                'description' => $product->description,
                'category' => $product->category_id,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index');
    }
    public function getTotalPrice()
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session
        $totalPrice = 0;

        // Duyệt qua từng sản phẩm trong giỏ hàng
        foreach ($cart as $product) {
            // Tính tổng cho từng sản phẩm: Giá * Số lượng
            $totalPrice += $product['price'] * $product['quantity'];
        }

        return $totalPrice;
    }
    

    public function updateQuantity($productId, Request $request)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        // Trả về tổng giá trị của giỏ hàng sau khi cập nhật
        return response()->json(['success' => true, 'totalPrice' => $this->getTotalPrice()]);
    }


    public function removeFromCart($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
    
        return redirect()->route('cart.index');
    }

 
    


}
