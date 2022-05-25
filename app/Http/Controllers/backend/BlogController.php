<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\AddRequest;
use App\Http\Requests\Blog\UpdateRequest;
use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\CommentBlog;
use App\Models\ReplyCommentBlog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::search()->paginate(2);
        $categoryBlog  = CategoryBlog::where('status', 1)->get();

        if (isset($_GET['sort_by'])) {
            $sortBy = $_GET['sort_by'];
            $pieces = explode("_", $sortBy);
            $blog = Blog::orderBy($pieces[0], $pieces[1])->search()->paginate(5);
        }
        if (isset($_GET['filter'])) {
            $sortBy = $_GET['filter'];
            $pieces = $_GET['id'];
            $blog = Blog::where($sortBy, $pieces)->search()->paginate(5);
        }
        return view('backend.pages.blog.list_blog', compact('blog', 'categoryBlog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryBlog  = CategoryBlog::where('status', 1)->get();
        return view('backend.pages.blog.add_blog', compact('categoryBlog'));
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
            $file->move(public_path('uploads/blog/'), $file_name);
        }
        $request->merge(['cover_image' => $file_name]);
        $blog = Blog::create($request->all());
        if ($blog) {
            Toastr::success('', 'Thêm bài viết thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('bai-viet.index');
        } else {
            Toastr::error('', 'Không thể thêm bài viết', [
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $cmt = CommentBlog::where('blog_id', $blog->id)->paginate(2);
        $counts = CommentBlog::where('blog_id', $blog->id)->count();
        // dd($counts);
        $categoryBlog = CategoryBlog::where('status', 1)->get();
        $new_blog = Blog::orderBy('created_at', 'DESC')->limit(2)->get();
        return view('backend.pages.blog.show_blog', compact('blog', 'cmt', 'counts', 'categoryBlog', 'new_blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categoryBlog  = CategoryBlog::where('status', 1)->get();

        return view('backend.pages.blog.edit_blog', compact('blog', 'categoryBlog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Blog $blog)
    {
        if (!$request->has('file')) {
            $file_name = $blog->cover_image;
        } elseif ($request->has('file')) {
            unlink(public_path('uploads/blog/' . $blog->cover_image));
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/blog/'), $file_name);
        }
        $request->merge(['cover_image' => $file_name]);
        $blog->update($request->all());
        if ($blog->update()) {
            Toastr::success('', 'Cập nhật bài viết thành công', [
                "closeButton" => true, "progressBar" => true, "showDuration" => "300",
                "hideDuration" => "1000",
                "timeOut" => "2000",
                "extendedTimeOut" => "1000",
                "showEasing" => "swing",
                "hideEasing" => "linear",
                "showMethod" => "fadeIn",
                "hideMethod" => "fadeOut"
            ]);
            return redirect()->route('bai-viet.index');
        } else {
            Toastr::error('', 'Cập nhật bài viết thất bại', [
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        CommentBlog::where('blog_id', $blog->id)->delete();
        if ($blog->delete()) {
            unlink(public_path('uploads/blog/' . $blog->cover_image));

            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], status: 200);
        }
    }
    public function unactive($slug)
    {
        Blog::where('slug', $slug)->update(['status' => 1]);
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
        return redirect()->route('bai-viet.index');
    }
    public function active($slug)
    {
        Blog::where('slug', $slug)->update(['status' => 0]);
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
        return redirect()->route('bai-viet.index');
    }
    public function replycmt(Request $request)
    {
        ReplyCommentBlog::create($request->all());
        return back();
    }
}
