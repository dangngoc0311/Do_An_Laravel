<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryBlog\AddRequest;
use App\Http\Requests\CategoryBlog\UpdateRequest;
use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\CommentBlog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryBlog = CategoryBlog::search()->paginate(5);
        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $categoryBlog = CategoryBlog::orderBy($pieces[0], $pieces[1])->search()->paginate(5);
        }
        return view('backend.pages.category_blog.list_category_blog', compact('categoryBlog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category_blog.add_category_blog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddRequest $request)
    {
        $categoryBlog = CategoryBlog::create($request->all());
        if ($categoryBlog) {
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
            return redirect()->route('danh-muc-bai-viet.index');
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
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryBlog $categoryBlog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoryBlog $categoryBlog)
    {
        return view('backend.pages.category_blog.edit_category_blog', compact('categoryBlog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, CategoryBlog $categoryBlog)
    {
        $categoryBlog->update($request->all());
        if ($categoryBlog) {
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
            return redirect()->route('danh-muc-bai-viet.index');
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
     * @param  \App\Models\CategoryBlog  $categoryBlog
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryBlog $categoryBlog)
    {
        $blog = Blog::where('category_blogs_id', $categoryBlog->id)->pluck('id')->toArray();
        CommentBlog::whereIn('blog_id', $blog)->delete();
        Blog::whereIn('id', $blog)->delete();
        if ($categoryBlog->delete()) {
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        CategoryBlog::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('danh-muc-bai-viet.index');
    }
    public function active($slug)
    {
        CategoryBlog::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('danh-muc-bai-viet.index');
    }
}
