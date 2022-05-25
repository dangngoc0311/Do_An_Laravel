<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role', 'customer')->paginate(5);
        return view('backend.pages.user.list_user', compact('user'));
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    public function unactive($slug)
    {
        User::where('role', 'customer')->where('id', $slug)->update(['status' => 1]);
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
        return redirect()->route('user.index');
    }
    public function active($slug)
    {
        User::where('role', 'customer')->where('id', $slug)->update(['status' => 0]);
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
        return redirect()->route('user.index');
    }
    public function profile()
    {
        $admin = User::find(Auth::guard('admin')->user()->id);
        return view('backend.pages.user.profile_admin', compact('admin'));
    }

    public function saveImage(Request $request)
    {
        $id = $request->id;
        $user =  User::find($id);
        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            $user_password = [
                'password' => $request->password,
            ];

            return redirect()->route('admin.profile');
        }

        if ($request->has('files')) {
            $file = $request->file('files');
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads/user/'), $file_name);
        } else {
            $file_name = $user->image;
        }
        $request->merge(['image' => $file_name]);
        $user->update($request->all());
        if ($user) {
            return redirect()->route('admin.profile');
        } else {
            return redirect()->back();
        }
    }
}
