<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_cart(Request $request, Product $product) 
    {
        if (Auth::id()) 
            {
                $user = Auth::user();

                $existingCart = Cart::where('user_id', $user->id)
                            ->where('product_id', $product->id)
                            ->where('color', $request->color)
                            ->where('size', $request->size)
                            ->first();

                if ($existingCart) {
                    $existingCart->qty += $request->qty;
                    $existingCart->price = $product->price * $existingCart->qty;
                    $existingCart->save();
                } else {
                    $data = $request->validate([
                        'color' => 'required',
                        'size' => 'required',
                        'qty' => 'required',
                    ]);

                    $data['product_name'] = $product->name;
                    $data['image'] = $product->image;
                    $data['price'] = $product->price;
                    $data['total'] = $product->price * $request->qty;
                    $data['product_id'] = $product->id;
                    $data['user_id'] = $user->id;

                    Cart::create($data);
                }

                return redirect('/show_cart')->with('success', 'Your shopping items have been added to the shopping cart');
            }   
            else
            {
                return redirect('/login')->with('logFirst', 'You Must Login First');
            }
    }
    public function show_cart() 
    {
        if (Auth::id()) 
        {
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=', $id)->get();
            return view('cart', [
                'title' => 'Your Cart',
                'carts' => $carts,
                'subTotal' => Cart::where('user_id', '=', $id)->get()->sum('total')
            ]);
        } 
        else 
        {
            return redirect('/login')->with('logFirst', 'You Must Login First');
        }
    }
    public function remove_cart(Cart $cart) {
        Cart::destroy($cart->id);
        return redirect('/show_cart')->with('success', 'Item Was Successfully Removed From Your Shopping Cart!');
    }
    public function update_cart(Request $request, $id)
    {
        $data = $request->validate([
            'qty' => 'required'
        ]);
        
        $cart = Cart::findOrFail($id);
        $cart->qty = $data['qty'];
        $cart->total = $cart->qty * $cart->price;
        $cart->save();

        return response()->json(['success' => 'Cart was successfully updated!']);
    }


}
