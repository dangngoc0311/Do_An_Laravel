<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\AddRequest;
use App\Models\Blog;
use App\Models\CategoryBlog;
use App\Models\CommentBlog;
use App\Models\ReplyCommentBlog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogCusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $new_blog = Blog::orderBy('created_at')->limit(3)->get();
        $category_blog = CategoryBlog::where('status', 1)->get();
        $archive =  DB::table('blogs')->select(DB::raw("DATE_FORMAT(created_at, '%m-%Y') created"))
            ->distinct()->get();
        $blog = Blog::search()->where('status', 1)->paginate(6);



        return view('frontend.pages.blog.list_blog', compact('blog', 'category_blog', 'new_blog', 'archive'));
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
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        // $total_cmt = CommentBlog::where('blog_id', $blog->id)->where('status', 1)->count();
        $comment = CommentBlog::orderBy('created_at', 'DESC')->where('blog_id', $blog->id)->where('status', 1)->paginate(1);

        $count = CommentBlog::where('blog_id', $blog->id)->count();
        $new_blog = Blog::orderBy('created_at')->limit(3)->get();
        $category_blog = CategoryBlog::where('status', 1)->get();
        return view('frontend.pages.blog.detail_blog', compact('blog', 'category_blog', 'new_blog', 'comment', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
    public function storecmt(AddRequest $request)
    {
        $cmt =  CommentBlog::create(
            [
                'comment' => $request->comment,
                'user_id' => $request->user_id,
                'blog_id' => $request->blog_id,
                'status' => 1
            ]
        );
        if ($cmt) {

            return response()->json([
                'bool' => true
            ]);
        }

        // return response()->json([
        //     'bool'=>true
        // ]);
        return back();
    }
    // public function store_reply_cmt(Request $request)
    // {

    //     ReplyCommentBlog::create(
    //         [
    //             'comment' => $request->comment,
    //             'user_id' => $request->user_id,
    //             'comment_id' => $request->comment_id,
    //             'status' => 1
    //         ]
    //     );
    //     return back();
    // }
    public function getBlogByCate(Blog $blog, $id)
    {
        $blog = $blog->getBlogByCategory($id);
        $new_blog = Blog::orderBy('created_at')->limit(3)->get();
        $category_blog = CategoryBlog::where('status', 1)->get();
        $archive =  DB::table('blogs')->select(DB::raw("DATE_FORMAT(created_at, '%m-%Y') created"))
            ->distinct()->get();
        return view('frontend.pages.blog.list_blog', compact('blog', 'category_blog', 'new_blog', 'archive'));
    }
}
