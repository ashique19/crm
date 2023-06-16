<?php

namespace App\Http\Controllers\Account\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteBlog;
use App\Models\website;
use Storage;
use Auth;

class BlogController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;
        $website = Website::where('user_id', $user_id)->firstOrFail();
        $blogs   = WebsiteBlog::where('website_id', $website->id)->get();
        return view('account.website.blog', compact('blogs'));
    }
    public function create(Request $request)
    {
        return view('account.website.blog.create');
    }
    public function edit(Request $request,$id)
    {
        $blog     = WebsiteBlog::findOrFail($id);
        $blog->image = url('storage/blogs/'.$blog->image);
        return view('account.website.blog.edit', compact('blog'));
    }
    public function addBlog(Request $request)
    {
        $user_id                = Auth::user()->id;
        $website                = Website::where('user_id', $user_id)->firstOrFail();
        $blog                   = new WebsiteBlog;
        $blog->website_id       = $website->id;
        $blog->title            = $request->title;
        $blog->content          = $request->content;
        $blog->meta_keywords    = $request->meta_keywords;
        $blog->slug             = $this->createSlug($request->title);
        $blog->meta_description = $request->meta_description;
        $blog->status           = 1;
        $blog->views            = 0;
    
        if($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $blog->image = time().$uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs(
                'public/blogs',
                $uploadedFile,
                $blog->image
            );
        }
        $blog_id = $blog->save();
        if (!empty($blog_id)) {
            return redirect()->route('account.website.blog')->with('success_msg', 'Blog Created');
        }
    }
    public function updateBlog(Request $request)
    {
        $user_id                = Auth::user()->id;
        $blog                   = WebsiteBlog::findOrFail($request->id);
        $blog->title             = $request->title;
        $blog->content             = $request->content;
        $blog->meta_keywords    = $request->meta_keywords;
        $blog->slug             = $this->createSlug($request->title, $blog->id);
        $blog->meta_description = $request->meta_description;
        
        if($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $blog->image = time().$uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs(
                'public/blogs',
                $uploadedFile,
                $blog->image
            );
        }
        $blog_id = $blog->save();
        if (!empty($blog_id)) {
            return redirect()->route('account.website.blog')->with('success_msg', 'Blog Updated');
        }
    }
    public function getBlogById(Request $request)
    {
        $blog     = WebsiteBlog::findOrFail($request->id);
        $blog->image = url('storage/blogs/'.$blog->image);
        return response()->json(array('data'=> $blog), 200);
    }
    public function deleteBlogById(Request $request)
    {
        if($request->action == 'blog_delete' && $request->id) {
            $blog = WebsiteBlog::findOrFail($request->id);
            $blog->delete();
            return response()->json(array('msg'=> 'Data deleted','status'=>'success'), 200);
        }
    }
    public function change_status(Request $request, $blog_id)
    {
        $blog           = WebsiteBlog::findOrFail($blog_id);
        $blog->status   = $blog->status==1?0:1;
        $blog->save();
        return response()->json(array('msg'=> 'Status changed','status'=>'success'), 200);
    }
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
       
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        
        if (! $allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }
        throw new \Exception('Can not create a unique slug');
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return WebsiteBlog::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
}