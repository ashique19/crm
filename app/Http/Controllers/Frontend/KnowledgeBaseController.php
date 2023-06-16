<?php

namespace App\Http\Controllers\Frontend;

use App\Events\KnowledgeBaseViewed;
use App\Models\KnowledgeBase;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;



class KnowledgeBaseController extends Controller
{
    public function index(Request $request, $page = 1)
    {

        // Get KnowledgeBase Contents
        $search = ($request->has('search'))? $request->search: null;

        $categories = Category::where('active', 1)->get();

        return view('frontend.support', compact('categories'))
            ->with('search', $search);
    }

    public function search(Request $request, $page = 1)
    {

        // Get KnowledgeBase Contents
        $search = ($request->has('search'))? $request->search: null;

        $term = $request->term;

        $categories = Category::with(
            ['knowledge'=>  function ($query) use ($request) {
                $query->where('content', 'like', "%{$request->term}%");
            }]
        )->where('active', 1)->get();

        $errors = true;

        foreach($categories as $category){
            if(count($category->knowledge) > 0) {
                $errors = false;
            }
        }


        return view('frontend.support', compact('term', 'categories'))
            ->with('errors', $errors);
    }

    public function knowledge_base_post(Request $request, $alias)
    {
        // Get the Post
        $post = KnowledgeBase::where('alias', $alias)->first();
        $search = ($request->has('search'))? $request->search: null;

        if($post) {
            if(!$post->status) {
                abort(404);
            }

            $key = "view:knowledgebase";

            $justView = \Cache::add($key, \Request::ip(), now()->addMinutes(5));

            // Don't increment the views attribute,
            // if user just visit the knowledgebase less than 5 minutes ago
            if ($justView) {
                $knowledge = \App\Models\KnowledgeBase::find($post->id);
                $knowledge->views++;
                $knowledge->save();
            }

            return view('frontend.support_single', compact('post'))->with('search', $search);
        }else{
            abort(404);
        }
    }

    public function knowledge_category(Request $request, $alias)
    {
        // Get the Post
        $category = Category::where('alias', $alias)->first();
        $search = ($request->has('search'))? $request->search: null;

        if($category) {

            $posts = KnowledgeBase::where('category_id', $category->id)->get();
            return view('frontend.support_category', compact('category', 'posts'))->with('search', $search);
        }else{
            abort(404);
        }
    }

}
