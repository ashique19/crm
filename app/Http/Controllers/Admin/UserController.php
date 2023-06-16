<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers\Utility;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as ImageIn;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use WaleedAhmad\Pinterest\Facade\Pinterest;

class UserController extends Controller
{
    protected $languages;

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
    }



    // Activating post
    public function activate(Request $request)
    {
        if($request->ajax()) {
            $post = Blog::findOrFail($request->id);
            $post->status = 1;
            $post->touch();
            $post->save();
            return response()->json('success', 200);
        }else{
            return response()->json('failed', 400);
        }
    }

    // Deactivating post
    public function deactivate(Request $request)
    {
        if($request->ajax()) {
            $post = Blog::findOrFail($request->id);
            $post->status = 0;
            $post->touch();
            $post->save();
            return response()->json('success', 200);
        }else{
            return response()->json('failed', 400);
        }
    }

}
