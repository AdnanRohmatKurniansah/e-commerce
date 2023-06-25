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

                if ($user->role === 'admin') {
                    return redirect()->back();
                }

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
                    $data['weight'] = $product->weight;
                    $data['total'] = $product->price * $request->qty;
                    $data['allWeight'] = $product->weight * $request->qty;
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
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->back();
            }

            $id = $user->id;
            $carts = Cart::where('user_id', '=', $id)->get();
            return view('cart', [
                'title' => 'Your Cart',
                'carts' => $carts,
                'subTotal' => $carts->sum('total'),
                'subWeight' => $carts->sum('allWeight')
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
