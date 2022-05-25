<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ImageReviewProduct;
use App\Models\InfoShop;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ReviewProduct;
use Illuminate\Http\Request;

class ReviewProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $info = InfoShop::orderBy('id')->where('status', 1)->first();

        return view('frontend.pages.order.history', compact('order', 'info'));
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
        $rating =  $request->rating  ? $request->rating : 5;
        if ($request->file('files')) {
            $reviews = ReviewProduct::create([
                'rating' => $rating,
                'message' => $request->message,
                'order_detail_id' => $request->order_detail_id
            ]);
            if ($reviews) {
                OrderDetail::find($request->order_detail_id)
                    ->update([
                        'status' => 0
                    ]);
                if ($request->file('files')) {
                    foreach ($request->file('files') as $images) {
                        $file_name = $images->getClientOriginalName();
                        $images->move(public_path('uploads/review/'), $file_name);
                        ImageReviewProduct::create(
                            [
                                'image' => $file_name,
                                'review_product_id' => $reviews->id
                            ]
                        );
                    }
                }
                return redirect()->back();
            }
        } else {
            $reviews = ReviewProduct::create([
                'rating' => $rating,
                'message' => $request->message,
                'order_detail_id' => $request->order_detail_id
            ]);
            if ($reviews) {
                OrderDetail::find($request->order_detail_id)
                    ->update([
                        'status' => 0
                    ]);
                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReviewProduct  $reviewProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewProduct $reviewProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReviewProduct  $reviewProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewProduct $reviewProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReviewProduct  $reviewProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewProduct $reviewProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReviewProduct  $reviewProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewProduct $reviewProduct)
    {
        //
    }
}
