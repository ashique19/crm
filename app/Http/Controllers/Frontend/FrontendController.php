<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Seo;
use App\Models\Admin\Lead;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Mail\Contact\ContactEmail;
use App\Services\FrontendService;
use App\Services\PlansService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
// use \Artesaos\LinkedIn\LinkedinServiceProvider AS LinkedIn;

class FrontendController extends Controller
{

    private $planService;

    private $frontendService;


    public function __construct(PlansService $plansService, FrontendService $frontendService)
    {
        $this->planService = $plansService;
        $this->frontendService = $frontendService;
    }


    public function home()
    {

        return view("frontend.home")
            ->with('blogs', $this->frontendService->getBlogs());
    }

    public function terms()
    {


        return view("frontend.terms");
    }

    public function privacyPolicy()
    {


        return view("frontend.policy");
    }

    public function acceptableUsePolicy()
    {


        return view("frontend.aup");
    }

    public function features()
    {


        return view("frontend.features");
    }

    public function policy()
    {


        return view("frontend.policy");
    }

    public function designs()
    {


        return view("frontend.designs")
            ->with('designs', $this->frontendService->getDesigns());
    }

    public function faq()
    {


        return view("frontend.faq")
            ->with('faqs', $this->frontendService->getGroupedFaq());
    }

    public function aboutUs()
    {

        return view("frontend.about_us");
    }

    public function blog(Request $request, $page = 1)
    {

        $blog = Blog::where('status', 1)->orderBy('created_at', 'desc');

        // Search blog
        $posts = '';
        $search = '';
        if ($request->has('search') && $request->search !== '') {
            $posts = $blog->where('title', 'LIKE', "%{$request->search}%")
                ->orWhere('slug', 'LIKE', "%{$request->search}%")
                ->where('status', 1)->orderBy('created_at', 'desc');
            $search = $request->search;
        }

        $blogs = $blog->paginate(4, ['*'], 'page', $page);


        $popularPosts = Blog::where('status', 1)->orderBy('views', 'desc')->limit(3)->get();

        return view("frontend.blog")->with(compact('blogs', 'popularPosts', 'search', 'posts', 'page'));
    }

    public function blogPost($slug)
    {

        $blog = Blog::where('slug', $slug)->first();

        if(!isset($blog->id)) {
            abort(404);
        }

        $popularPosts = Blog::where('status', 1)->orderBy('views', 'desc')->limit(3)->get();

        $key = "view:blog".$blog->id;

         $justView = \Cache::add($key, \Request::ip(), now()->addMinutes(5));
        // Don't increment the views attribute,
        // if user just visit the blog less than 5 minutes ago
        if ($justView) {
            $blog = \App\Models\Blog::find($blog->id);
            $blog->views++;
            $blog->save();
        }

        return view("frontend.blog_post")->with(compact('blog', 'popularPosts'));
    }

    public function careers()
    {

        return view("frontend.careers")
            ->with('jobs', $this->frontendService->getJobs());
    }

    public function contact()
    {
        return view("frontend.contact");
    }        

    public function store(ContactStoreRequest $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'email' => 'required|email|unique:leads,email',
            ]
        );

        if(!$validator->fails()) {
            $data = [
                'email' => $request->email,
                'conversion_point' => $request->conversion_point
            ];
            Lead::create($data);
        }

        $form = $request->only(['name', 'email', 'subject', 'message']);

        Mail::to(setting('site.contact_form_email'))->send(new ContactEmail($form));

        return response()->json(['status' => 'success','msg'=>'We have received your message. We will respond shortly.']);

    }

    public function reCaptcha(Request $request)
    {
        if($request->ajax()) {
            $parameters = http_build_query(
                [
                'secret'   => setting('site.google_recaptcha_api_secret_key'),
                'response' => $request->response,
                ]
            );
            $url           = 'https://www.google.com/recaptcha/api/siteverify?' . $parameters;
            $checkResponse = null;
            $checkResponse = file_get_contents($url);
            if (is_null($checkResponse) || empty($checkResponse)) {
                response()->json(['status' => false]);
            }
            $response = json_decode($checkResponse);
            return response()->json(['status' => $response->success]);
        }else{
            return response()->json($static_data['strings']['something_happened'], 400);
        }
    }


}
