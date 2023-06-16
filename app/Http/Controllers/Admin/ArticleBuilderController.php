<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Keyword;
use App\Models\Setting;
use App\Models\Admin\BlogTopic;
use App\Models\Admin\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use App\Repositories\KeywordRepository;
use App\Repositories\JiraRepository;
use App\Repositories\ArticleBuilderRepository;

class AdminArticleBuilderController extends Controller
{

    public function __construct(KeywordRepository $KeywordRepository, JiraRepository $JiraRepository, ArticleBuilderRepository $ArticleBuilderRepository)
    {
        $this->keyword = $KeywordRepository;
        $this->jira = $JiraRepository;
        $this->article = $ArticleBuilderRepository;
    }


    public function index()
    {
        $topics = BlogTopic::get();
        return view('admin.settings.article_builder', compact('topics'));
    }

    public function update(Request $request)
    {
        $updateArticlesPerWeek = Setting::where('key', 'articles_per_week')->update(['value' => $request->articles_per_week]);
        $updateNetworkArticlesPerWeek = Setting::where('key', 'network_articles_per_week')->update(['value' => $request->network_articles_per_week]);
        $updateNetworkArticlesPerWeek = Setting::where('key', 'new_accounts_per_week')->update(['value' => $request->new_accounts_per_week]);
        $updateArticleRunTime = Setting::where('key', 'article_run_time')->update(['value' => $request->article_run_time]);

        $clearTopics = BlogTopic::where('status', '1')->update(['status' => 0]);
        foreach($request->topic as $topic){

            $updateTopicStatus = BlogTopic::where('id', $topic)->update(['status' => 1]);
        }
        Session::flash('account_updated', true);
        return redirect()->back();
    }

    // Generate Article and Keywords
    public function generate($category = null)
    {
            $keyword = Keyword::where('status', '1')->OrderBy('used', 'ASC')->first();
            $updateKeyword = $this->keyword->create($keyword->keyword);
            // $suggestedKeywords = $this->keyword->generate($keyword->keyword, 10);
            // $suggestedKeywords = implode(", ", $suggestedKeywords);
            $suggestedKeywords = "websites for therapist, websites for counselors";

        if($category==null) {
            $category = BlogTopic::where('status', '1')->OrderBy('used', 'ASC')->first();
        }

            $article = $this->article->create($category->topic, $suggestedKeywords);

        return $article;
    }


}
