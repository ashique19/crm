<?php

namespace App\Http\Controllers\Admin;

use App\Library\tumblr\tumblr\lib\Tumblr\API\Client;
use App\Library\tumblr\tumblr\lib\Tumblr\API\HmacSha1;
use App\Library\tumblr\tumblr\lib\Tumblr\API\RequestException;
use App\Library\tumblr\tumblr\lib\Tumblr\API\RequestHandler;
use App\Notifications\TwitterBlogPublished;
use App\Notifications\FacebookBlogPublished;
use App\Http\Helpers\Utility;
use App\Models\Blog;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as ImageIn;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\KeywordRepository;
use App\Repositories\JiraRepository;
use App\Repositories\ArticleBuilderRepository;
use WaleedAhmad\Pinterest\Facade\Pinterest;
use Illuminate\Http\UploadedFile;

class BlogController extends Controller
{
    protected $languages;
   
    public function __construct(JiraRepository $JiraRepository, KeywordRepository $KeywordRepository, ArticleBuilderRepository $ArticleBuilderRepository)
    {
        $this->keyword = $KeywordRepository;        
        $this->jira = $JiraRepository;
        $this->article = $ArticleBuilderRepository;    
    }

    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        include app_path() . '/Library/tumblr/vendor/autoload.php';
        $this->validateTitle($request);
       
        $data['slug']   = $this->createSlug($request->title);
        
        if($request->selected_img) {
            // Handling UNSPLASH api Image
            $url           = $request->selected_img;
            $filename      = $data['slug'].'-'.strtoupper(md5(uniqid(rand(), true))).'.jpg'; 
            $contents      = file_get_contents($url);
            $file          = storage_path('app/public/blog/'.$filename);
            file_put_contents($file, $contents);
            $uploaded_file = new UploadedFile($file, $filename);
            $data['image'] = $filename;
        }else{
            // Handling Featured Image
            $file              = $request->file('image');
            if(isset($file) && $file->isValid()) {
                $filename      = $file->getClientOriginalName();
                $name          = md5($filename.uniqid().microtime()).'.'. $file->getClientOriginalExtension();
                $img           = ImageIn::make($file->getRealPath());
                $img->save(storage_path() . '/app/public/blog/'. $name);
                $data['image'] = $name;
            }else{
                if($request->single_image) {
                    $url           = $request->single_image;
                    $filename      = $data['slug'].'-'.strtoupper(md5(uniqid(rand(), true))).'.jpg'; 
                    $contents      = file_get_contents($url);
                    $file          = storage_path('app/public/blog/'.$filename);
                    file_put_contents($file, $contents);
                    $uploaded_file = new UploadedFile($file, $filename);
                    $data['image'] = $filename;
                }else{
                    $data['image'] = 'no_image.jpg';
                }
            }
        }
        
        $data['meta_description'] = $request->meta_description;        
        $data['meta_keywords']    = $request->meta_keywords;
        $newkeywords              = explode(',', $data['meta_keywords']);

        foreach($newkeywords as $word){
            $addKeyword           = $this->keyword->create($word);
        }        
        $data['user_id']          = $request->user_id;
       
        $data['title']            = $request->title;

        $data['content']          = $request->content;
        $data['status']           = isset($request->status) ? 1 : 0;
        $post                     = Blog::create($data);

        if(getenv("TWITTER_ACCESS_TOKEN") !== '' AND !is_null(getenv("TWITTER_ACCESS_TOKEN"))) {
            $post->notify(new TwitterBlogPublished($post));
        }
        
        if(getenv("FACEBOOK_ACCESS_TOKEN") !== '' AND !is_null(getenv("FACEBOOK_ACCESS_TOKEN"))) {
            $post->notify(new FacebookBlogPublished($post));
        }
        if(getenv("TUMBLR_TOKEN") !== '' AND !is_null(getenv("TUMBLR_TOKEN"))) {    
            $consumerKey    = getenv("TUMBLR_CONSUMER_KEY");
            $consumerSecret = getenv("TUMBLR_CONSUMER_SECRET");
            $token          = getenv("TUMBLR_TOKEN");
            $secret         = getenv("TUMBLR_SECRET");
            $client         = new \Tumblr\API\Client($consumerKey, $consumerSecret);
            $client->setToken($token, $secret);
            $blogName       = getenv("TUMBLR_BLOG_NAME");
            $data           =   [
                                    'type'       => 'link',
                                    'url'        => url('/blog/'.$post->slug),
                                    'title'      => 'Check out our new blog: '.$post->title,
                                    'description' => $post->content,
                                    'thumbnail'   => url('storage/blog/'.$post->image),
                                    'author'      => 'me'
                                ];
            
            $client->createPost($blogName, $data);
        }
        
        if(getenv("PINTEREST_BOARD") !== '' AND !is_null(getenv("PINTEREST_BOARD"))) {
            $pintrest_data  = array(
                                    "note"        => $post->title,
                                    "image_url"   => url('storage/blog/'.$post->image), 
                                    "board"       => getenv("PINTEREST_BOARD"),
                                    "link"        => url('/blog/'.$post->slug)
                                );
            
            if(getenv("PINTEREST_ACCESS_TOKEN") !== '') {
                Pinterest::auth()->setOAuthToken(env('PINTEREST_ACCESS_TOKEN'));
                Pinterest::pins()->create($pintrest_data);
            }
        }

        if(getenv("LINKEDIN_ACCESS_TOKEN") !== '' AND !is_null(getenv("LINKEDIN_ACCESS_TOKEN"))) {        
            \LinkedIn::setAccessToken(env('LINKEDIN_ACCESS_TOKEN'));
                
            $json = '{
				"author": "urn:li:organization:'.env('LINKEDIN_ORGANIZATION').'",
				"lifecycleState": "PUBLISHED",
				"specificContent": {
					"com.linkedin.ugc.ShareContent": {
						"shareCommentary": {
							"text": "Check out our new blog: '.$post->title.'"
						},
						"shareMediaCategory": "ARTICLE",
						"media": [
							{
								"status": "READY",
								"description": {
									"text": "Check out our new blog: '.$post->title.'"
								},
								"originalUrl": "'.url('/blog/'.$post->slug).'",
								"title": {
									"text": "Check out our new blog: '.$post->title.'"
								}
							}
						]
					}
				},
				"visibility": {
					"com.linkedin.ugc.MemberNetworkVisibility": "CONNECTIONS"
				}
			}';            
            $profile = \LinkedIn::post('v2/ugcPosts', array('format'=>'json', 'body'=>$json));        
        }
          
        // Linking images for this post, so later can be deleted
        if(isset($body['images'])) {
            foreach ($body['images'] as $image) {
                Image::create(['image' => $image, 'imageable_id' => $post->id, 'imageable_type' => 'App\Models\Blog']);
            }
        }

       
        if(env('JIRA_PASS')!="") {
            $projectKey = "SEO";                
            $summary = "Link Building Request for ".env('APP_URL');
            $description="Please run a link building campaign for the following link: ".env('APP_URL')."/blog/".$post->slug."\n
            \n
            *Requirements:*\n
            1. The keywords related to the link are:
            ".$post->meta_keywords;                
            $createIssue = $this->jira->create($projectKey, $summary, $description, 'admin');   
        }
        return redirect('admin/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Why do we need to show blog post? You will see it in the front-end.
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
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
       
        $this->validateTitle($request);

        // We get the post
        $post = Blog::findOrFail($id);

        // Handling Featured Image
        $file = $request->file('image');

        if($request->selected_img) {
            // Handling UNSPLASH api Image
            $url           = $request->selected_img;
            $filename      = $post->slug.'-'.strtoupper(md5(uniqid(rand(), true))).'.jpg'; 
            $contents      = file_get_contents($url);
            $file          = storage_path('app/public/blog/'.$filename);
            file_put_contents($file, $contents);
            $uploaded_file = new UploadedFile($file, $filename);
            $post->image = $filename;
        }elseif(isset($file) && $file->isValid()) {
            $filename = $file->getClientOriginalName();
            $name     = md5($filename.uniqid().microtime()).'.'. $file->getClientOriginalExtension();
            $img      = ImageIn::make($file->getRealPath());
            $img->save(storage_path() . '/app/public/blog/'. $name);
          
            // Deleting the old featured image
            if($post->image != '/assets/images/no_image.jpg') {
                $file_old = storage_path() . '/app/public/blog/'. $post->image;
                if(File::exists($file_old)) {
                    File::delete($file_old);
                }
            }
            $post->image = $name;
        }        
        
        
        $old_images = [];
        $new_images = [];

        $body = [];
        $post->title = $request->title;
        $post->slug = $this->createSlug($request->title, $id);

        $post->content = $request->content;

        // Linking images for this language, so later can be deleted
        if(isset($body['images'])) {
            foreach ($body['images'] as $image) {
                $new_images[] = $image;
                Image::create(['image' => $image, 'imageable_id' => $post->id, 'imageable_type' => 'App\Models\Blog']);
            }
        }
        $old_images[] = isset($body['old_images']) ? $body['old_images'] : '';
        $new_images[] = isset($body['images']) ? $body['images'] : '';

        $blog = Blog::where(['id' => $id])->first();

        // Deleting the Unused pictures
        $images = $post->images;
        if($images) {
            foreach($images as $image){
                if(!in_array_r($image->image, $old_images) && !in_array_r($image->image, $new_images)) {
                    $file = storage_path() . '/app/public/blog/'. $image->image;
                    $image->delete();
                    if(File::exists($file)) {
                        File::delete($file);
                    }
                }
            }
        }
        // Updating the post
        $post->meta_description = $request->meta_description;        
        $post->meta_keywords = $request->meta_keywords;
        $post->status = isset($request->status) ? 1 : 0;
        
        // Update Alias
        $alias = Utility::alias($request->title, [], 'blog'); 
       
        $post->slug = $alias;
        
        // Add Link Building Request      
        if(env('JIRA_PASS')!="" && $blog->link_built != 1) {
            $post->link_built = 1;
           
            $projectKey = "SEO";                
            $summary = "Link Building Request for ".env('APP_URL');
            $description="Please run a link building campaign for the following link: ".env('APP_URL')."/blog/".$post->slug."\n
            \n
            *Requirements:*\n
            1. The keywords related to the link are:
            ".$post->meta_keywords;                

            $createIssue = $this->jira->create($projectKey, $summary, $description);
        }        
      
        $post->save();

        return redirect('admin/blog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if($request->ajax()) {
            $this->delete($request->id);
            return response()->json('success', 200);
        }else{
            return response()->json('fail', 400);
        }
    }

    // Handling mass deletion
    public function massDestroy(Request $request)
    {
        if($request->ajax() && isset($request->id)) {
            $ids = $request->id;
            foreach ($ids as $id){
                $this->delete($id);
            }
            return response()->json('success', 200);
        }else{
            return response()->json('failed', 400);
        }
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

    // Validating the title
    public function validateTitle(Request $request, $id = '')
    {
        if($id) {
            $this->validate(
                $request, [
                'title.'.$id.'' => 'required|min:5',
                'content.'.$id.'' => 'required|max:500000',
                ], [
                'title.'.$id.'.required'    => 'Title Required',
                'title.'.$id.'.min'         => 'Title Require Minimum of 5 characters',
                ]
            );
        }else{
            $this->validate(
                $request, [
                'title' => 'required|min:5',
                'content' => 'required|max:500000',
                ], [
                'title.required'    => 'Title Required',
                'title.min'         => 'Title Required Minimum of 5 characters',
                ]
            );
        }
    }

    // Autocomplete
    public function autocomplete(Request $request)
    {
        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];

            $posts = Blog::where([['title', 'LIKE', '%' . $term . '%']])->take(5)->get();
            foreach ($posts as $post) {
                $results[] = ['id' => $post->blog_id, 'title' => $post->title];
            }
            return $results;
        }else{
            return response()->json('Something Happened', 400);
        }
    }

    // Searching blog posts
    public function search(Request $request)
    {
        $term = $request->get('term') ? $request->get('term') : '';

        $post_ids = Blog::where('title', 'LIKE', '%'.$term.'%')->get()->pluck('blog_id');

        $posts = Blog::whereIn('id', $post_ids)->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blog.search', compact('posts'));
    }

    // Helper function for delete
    public function delete($id)
    {
        // Getting the post
        $post = Blog::findOrFail($id);

        // Unlinking the images
        if($post->images) {
            foreach($post->images as $image){
                $file = storage_path('/app/public/blog/'. $image->image);
                if(File::exists($file)) {
                    File::delete($file);
                }
                $image->delete();
            }
        }

        // Unlinking the featured image
        if($post->image != '/assets/images/no_image.jpg') {
            $file = public_path($post->image);
            if(File::exists($file)) {
                File::delete($file);
            }
        }

        // Deleting the post
        $post->delete();
    }

    // Delete Featured Image
    public function deleteFeatured(Request $request, $id)
    {
        if($request->ajax()) {
            $post = Blog::findOrFail($id);
            $post->image = '';
            $post->touch();
            $post->save();
            return response()->json('Deleted Successfully', 200);
        }else{
            return response()->json('Something Happened', 400);
        }
    }

    // Create Unique Slug
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
       
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        
        if(!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        $newSlug = $slug.'-'.count($allSlugs);

        return $newSlug;

    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Blog::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
    public function search_image(Request $request)
    {
        if($request->title AND env('UNSPLASH_ACCESS_KEY') != "" AND !is_null(getenv("UNSPLASH_ACCESS_KEY"))) {
            $unsplash   = new \MahdiMajidzadeh\LaravelUnsplash\Search();
            $photos     = $unsplash->photo($request->title, ['per_page'=>10])->get();
            if($photos->total) {
                $single = $photos->results[0]->urls->regular;
            }else{
                $single = 'no_image.jpg';
            }
            $html       = view('admin.blog.blog_images', compact('photos'))->render();
            return response()->json(array('success' => true,'html'=>$html,'single'=>$single)); 
        }
    }
}