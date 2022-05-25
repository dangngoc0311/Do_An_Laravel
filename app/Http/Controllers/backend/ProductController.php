<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\AddRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\ImageReviewProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::orderBy('id', 'DESC')->search()->paginate(3);
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $product = Product::orderBy($pieces[0], $pieces[1])->search()->paginate(3);
        }
        if (isset($_GET['filter'])) {
            $sortBy = $_GET['filter'];
            $pieces = explode("_", $sortBy);
            $product = Product::where($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.product.list_product', compact('product', 'category', 'brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->get();
        $brand = Brand::where('status', 1)->get();
        return view('backend.pages.product.add_product', compact('category', 'brand'));
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
            $file->move(public_path('uploads/product/'), $file_name);
        }
        $request->merge(['image' => $file_name]);
        $product = Product::create(
            $request->all()
        );
        if ($product) {
            if ($request->file('files')) {
                foreach ($request->file('files') as $files) {
                    $file_name = $files->getClientOriginalName();
                    $files->move(public_path('uploads/imageProduct/'), $file_name);
                    ImageProduct::create(
                        [
                            'image' => $file_name,
                            'product_id' => $product->id
                        ]
                    );
                }
            }
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
            return redirect()->route('san-pham.index');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

        $category = Category::where('status', 1)->get();
        $brand = Brand::where('status', 1)->get();
        return view('backend.pages.product.edit_product', compact('product', 'category', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        if ($request->file('file')) {
            unlink(public_path('uploads/product/' . $product->image));
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/product/'), $file_name);
        } else {
            $file_name = $product->image;
        }
        $request->merge(['image' => $file_name]);

        if ($request->file('files')) {
            ImageProduct::where('product_id', '=', $product->id)->delete();
            // unlink(public_path('uploads/'.$brand->image));
            foreach ($request->file('files') as $files) {
                $file_name = $files->getClientOriginalName();
                $files->move(public_path('uploads/imageProduct/'), $file_name);
                ImageProduct::create(
                    [
                        'image' => $file_name,
                        'product_id' => $product->id
                    ]
                );
            }
        }

        $product->update($request->all());
        if ($product) {
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
            return redirect()->route('san-pham.index');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)

    {
        $order_detail = OrderDetail::where('product_id', $product->id)->get();
        if (isset($order_detail)) {
            $order_detail = OrderDetail::whereIn('product_id', $product->id)->get();
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



            OrderDetail::whereIn('product_id', $product->id)->delete();
        }
        Cart::where('product_id', '=', $product->id)->delete();
        Wishlist::where('product_id', '=', $product->id)->delete();
        ImageProduct::where('product_id', $product->id)->delete();


        if ($product->delete()) {
            unlink(public_path('uploads/product/' . $product->image));

            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        Product::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('san-pham.index');
    }
    public function active($slug)
    {
        Product::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('san-pham.index');
    }
    public function unhot($slug)
    {
        Product::where('slug', $slug)->update(['isHot' => 1]);
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
        return redirect()->route('san-pham.index');
    }
    public function hot($slug)
    {
        Product::where('slug', $slug)->update(['isHot' => 0]);
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
        return redirect()->route('san-pham.index');
    }
}
