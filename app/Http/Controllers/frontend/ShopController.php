<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ReviewProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $min = 8000;
        $max = 100000;
        $product = Product::orderBy('id', 'DESC')->paginate(9);

        if (isset($_GET['start'], $_GET['end'])) {
            $min = $_GET['start'];
            $max = $_GET['end'];
            $product = Product::whereBetween('price', [$min, $max])->paginate(9);
        }
        return view('frontend.pages.shop.shop', compact('product', 'min', 'max'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, ReviewProduct $reviews)
    {
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->limit(4)->get();
        $rating = DB::table('review_products')->join('order_details', 'order_details.id', '=', 'review_products.order_detail_id')
            ->select(DB::raw('AVG(review_products.rating) as rate'),DB::raw('COUNT(review_products.id) as total_review'))
            ->where('order_details.product_id', $product->id)->first();
        if ($rating->rate == null) {
            $rate = 0;
            $totals = 0;
        } else {
            $rate = $rating->rate;
            $totals = $rating->total_review;
        }
        // dd($rate);

        return view('frontend.pages.shop.shop_detail', compact('product', 'reviews', 'related_products', 'rate','totals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function getProductByCate($id, Product  $product)
    {
        $product = $product->getProductByCategory($id);
        return view('frontend.pages.shop.shop', compact('product'));
    }
    public function getProductByBrand($id, Product  $product)
    {
        $product = $product->getProductByBrand($id);
        return view('frontend.pages.shop.shop', compact('product'));
    }
}
