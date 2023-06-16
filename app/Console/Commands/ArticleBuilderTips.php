<?php
namespace App\Console\Commands;

use App\Http\Controllers\Admin\ArticleBuilderController;

use App\Models\Keyword;
use App\Models\Setting;
use App\Models\BlogTopic;
use App\Models\Article;
use App\Models\ArticleTip;
use Illuminate\Console\Command;

use App\Repositories\ArticleBuilderRepository;

class ArticleBuilderTips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:article_builder_tips';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates tips from API';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ArticleBuilderRepository $ArticleBuilderRepository)
    {
        parent::__construct();
        $this->article = $ArticleBuilderRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $totalNeeded = 25;
        foreach(range(1, $totalNeeded) as $index) {

            $category = BlogTopic::where('status', '1')->OrderBy('used', 'ASC')->first();
            $updateCategory = BlogTopic::where('id', $category->id)->increment('used');

            $article = $this->article->tip($category->topic);

            $data['category'] = $category->topic;
            $data['tip'] = $article;
            ArticleTip::create($data);

        }


    }
}
