<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\AddRequest;
use App\Http\Requests\Brand\UpdateRequest;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\ImageProduct;
use App\Models\ImageReviewProduct;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::search()->paginate(5);
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $brand = Brand::orderBy($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.brand.list_brand', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.brand.add_brand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        if ($request->file('file')) {
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/brand/'), $file_name);
        }
        $request->merge(['image' => $file_name]);
        $brand = Brand::create($request->all());
        if ($brand) {
            Toastr::success('', 'Thêm mới thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('nha-cung-cap.index');
        } else {
            Toastr::success('', 'Không thể thêm mới', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('backend.pages.brand.edit_brand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        if ($request->file('file')) {
            unlink(public_path('uploads/brand/' . $brand->image));
            File::delete($brand->image);
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/brand/'), $file_name);
        } else {
            $file_name = $brand->image;
        }
        $request->merge(['image' => $file_name]);
        $brand->update($request->all());
        if ($brand) {
            Toastr::success('', 'Cập nhật thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('nha-cung-cap.index');
        } else {
            Toastr::error('', 'Không cập nhật ', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $product = Product::where('brand_id', $brand->id)->get();
        if (isset($product)) {
            $product = Product::where('brand_id', $brand->id)->pluck('id')->toArray();
            $order_detail = OrderDetail::where('product_id', $product)->get();
            if (isset($order_detail)) {
                $order_detail = OrderDetail::whereIn('product_id', $product)->get();
                foreach ($order_detail as $key => $value) {
                    $rewiew = ReviewProduct::where('order_detail_id', $value->id)->get();
                    if (isset($rewiew)) {
                        $rewiew = ReviewProduct::where('order_detail_id', $value->id)->get();
                        foreach ($rewiew as $key => $re) {
                            ImageReviewProduct::where('review_product_id', $re->id)->delete();
                            ReviewProduct::where('id', $re->id)->delete();
                        }

                    }
                }
                // dd($order_detail);



                OrderDetail::whereIn('product_id', $product)->delete();
            }
            Cart::where('product_id', '=', $product)->delete();
            Wishlist::where('product_id', '=', $product)->delete();
            ImageProduct::where('product_id', $product)->delete();
            Product::where('brand_id', $brand->id)->delete();
        }




        if ($brand->delete()) {
            // unlink(public_path('uploads/brand/' . $brand->image));
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        Brand::where('slug', $slug)->update(['status' => 1]);
        Toastr::success('', 'Cập nhật trạng thái thành công', [
            "closeButton" => true, "progressBar" => true, "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "2000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]);
        return redirect()->route('nha-cung-cap.index');
    }
    public function active($slug)
    {
        Brand::where('slug', $slug)->update(['status' => 0]);
        Toastr::success('', 'Cập nhật trạng thái thành công', [
            "closeButton" => true, "progressBar" => true, "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "2000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]);
        return redirect()->route('nha-cung-cap.index');
    }
}
