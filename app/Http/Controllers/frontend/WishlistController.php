<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('customer')->check()) {
            $wishlist = Wishlist::where('user_id', Auth::guard('customer')->user()->id)->where('status', 1)->orderBy('created_at','DESC')->get();
        } else {
            $wishlist  = [];
        }
        return view('frontend.pages.cart.wishlists', compact('wishlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product_id = $request->product_id;
        $user_id = $request->user_id;
        $check = Wishlist::where('user_id', $user_id)->where('product_id', $product_id)->where('status', 1)->count();
        if ($check == 0) {
            $wishlist = Wishlist::create($request->all());
            if ($wishlist) {
                return response()->json([
                    'code' => 200,
                    'message' => 'success'
                ], status: 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist, Request $request)
    {
        if ($wishlist::find($request->id)->delete()) {
            return response()->json([
                'success' => 'Record deleted successfully!'
            ]);
        }
    }
    public  function getTotalWishlist(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $count = Wishlist::where("user_id", Auth::guard('customer')->user()->id)->where('status', 1)->count();
        } else {
            $count = 0;
        }
        return $count;
    }
}
