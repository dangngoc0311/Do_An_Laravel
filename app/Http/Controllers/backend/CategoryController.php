<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\ImageReviewProduct;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::search()->paginate(5);
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $category = Category::orderBy($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.category.list_category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $category = Category::create($request->all());
        if ($category) {
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
            return redirect()->route('danh-muc.index');
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // dd($category->slug);
        return view('backend.pages.category.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->all());
        if ($category) {
            Toastr::success('', 'Cập nhật danh mục thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('danh-muc.index');
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
            Toastr::error('ErrorAlert', 'Lorem ipsum dolor sit amet.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Request $request)
    {
        $product = Product::where('category_id', $category->id)->get();
        if (isset($product)) {
            $product = Product::where('category_id', $category->id)->pluck('id')->toArray();
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
            Product::where('category_id', $category->id)->delete();
        }


        if ($category->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        Category::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('danh-muc.index');
    }
    public function active($slug)
    {
        Category::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('danh-muc.index');
    }
    public function sort(Request $request)
    {
        $key = $request->data1;
        $sort = $request->sort1;
        $category = Category::orderBy($key, $sort)->get();

        return response()->json($category);
    }
    public function search(Request $request)
    {
        $key = $request->key;
        Category::where('name', 'like', '%' . $key . '%')->get();
        return view('backend.pages.category.sort_category', compact('category'))->render();
    }
}
