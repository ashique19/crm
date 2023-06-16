<?php
namespace App\Console\Commands;

use App\Http\Controllers\Admin\ArticleBuilderController;
use App\Models\Keyword;
use App\Models\Setting;
use App\Models\Article;
use App\Models\BlogTopic;
use App\Models\Blog;
use App\Http\Helpers\Utility;
use App\Repositories\KeywordRepository;
use App\Repositories\JiraRepository;
use App\Repositories\ArticleBuilderRepository;
use Illuminate\Console\Command;

class ArticleBuilder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:article_builder';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates article from API';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(KeywordRepository $KeywordRepository, JiraRepository $JiraRepository, ArticleBuilderRepository $ArticleBuilderRepository)
    {
        parent::__construct();
        $this->keyword = $KeywordRepository;
        $this->jira = $JiraRepository;
        $this->article = $ArticleBuilderRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $NUM_OF_ATTEMPTS = 5;
        $attempts = 0;
        do {
            try
            {

                    $keyword = Keyword::where('status', '1')->OrderBy('used', 'ASC')->first();
                    $updateKeyword = $this->keyword->create($keyword->keyword);
                    $suggestedKeywords = $this->keyword->generate($keyword->keyword, 10);
                    $suggestedKeywords = implode(", ", $suggestedKeywords);
                    $category = BlogTopic::where('status', '1')->OrderBy('used', 'ASC')->first();
                    $updateCategory = BlogTopic::where('id', $category->id)->increment('used');

                if(env('ARTICLE_BUILDER')=='on') {
                    $article = $this->article->create($category->topic);
                    $arr = explode("<p>", $article, 2);
                } else {
                    $article = Article::where('category', $category->topic)->where('used', '0')->OrderBy('id', 'ASC')->first();
                    $updateArticle = Article::where('id', $article->id)->increment('used');
                    $arr = explode("<p>", $article->article, 2);
                }
                    
                /*var_dump($arr);
                echo 'hi'.PHP_EOL;
                exit;*/

                    $title = $arr[0];
                    $article = $arr[1];

                    $injected = 0;

                    $data['status'] = 0;
                    $data['user_id'] = 1;
                    $data['slug'] = Utility::alias($title, [], 'blog');
                    $data['meta_keywords'] = $suggestedKeywords;
                    $data['title'] = $title;
                    $data['content'] = $article;
                    $post = Blog::create($data);

                        $projectKey = 'CONTENT';
                        $summary = "Edit blog post '".$title."' for ".env('APP_URL');
                    $description="Edit blog post *".$title."* for this site: ".env('APP_URL')."\n
\n
*Current Title:*\n ".$data['title']."
\n
*Requirements:*\n";
                if($injected=='1') {
                    $description.="1. Please proofread and edit the article to be marketing in nature and mold around the ".env('APP_URL')." brand  so it flows and is grammatically correct \n";
                } else {
                    $description.="1. Please proofread and edit the article so it flows and is grammatically correct \n";
                }
                    $description.="2. Please edit the blog to includes the following keywords in the blog post content and consider also injecting one of these words in the blog title:
".$suggestedKeywords."\n
3. Please ensure the article can pass copyscape or other plagiarism test.\n
4. Set an image to match the article content.\n
5. Set the article to published.\n
\n
\n
*How to Edit:*\n
\n
To post this blog, please navigate to: ".env('APP_URL')."/admin\n
\n
You may login with:\n
\n
username: ".env('CONTENT_USER')."\n
password: ".env('CONTENT_PASS')."\n
\n
Once logged in, you may use the search filter to locate the article by the current subject: *".$data['title']."* \n";
                    $createIssue = $this->jira->create($projectKey, $summary, $description);

                    sleep(60);


            } catch (\Exception $exception) {
                /*$attempts++;
                sleep(60);
                continue;*/
                echo $exception.''.PHP_EOL;
                sleep(60);
            }
            break;
        } while($attempts < $NUM_OF_ATTEMPTS);

    }
}
