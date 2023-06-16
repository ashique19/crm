<?php

namespace App\Repositories;

use App\Models\User;

class ArticleBuilderRepository
{
    public function create($category, $keywords = null, $testmethod = null)
    {

        $url = 'http://articlebuilder.net/api.php';

        $testmethod = 'buildArticle';
        // $testmethod = 'injectContent';

        // Build the data array for authenticating.

        $data = array();
        $data['action'] = 'authenticate';
        $data['format'] = 'php'; // You can also specify 'xml' as the format.

        // Change to your own username/password.

        $data['username'] = env('ARTICLE_BUILDER_USER');
        $data['password'] = env('ARTICLE_BUILDER_PASS');

        // Authenticate and get back the session id.
        // You only need to authenticate once per session.
        // A session is good for 24 hours.
        $output = unserialize($this->curl_post($url, $data, $info));

        if($output['success']=='true') {
            // Success.
            $session = $output['session'];

            // Build the data array for the example.
            $data = array();
            $data['session'] = $session;
            $data['format'] = 'php'; // You can also specify 'xml' as the format.
            $data['action'] = 'buildArticle';
            /*$data['apikey'] = $apikey;*/
            $data['category'] = strtolower($category);
            $data['subtopics'] = $keywords;
            $data['wordcount'] = 600;
            $data['superspun'] = 2;    //1 to use Super Spun content, 2 to use Expanded Super Spun Content,

            /*if($data['category'] == 'affiliate marketing' OR $data['category'] == 'internet marketing' OR $data['category'] == 'search engine optimization' OR $data['category'] == 'credit repair' OR $data['category'] == 'personal finance' OR $data['category'] == 'acne' OR $data['category'] == 'fitness' OR $data['category'] == 'weight loss' OR $data['category'] == 'home improvement') {
                $data['action'] = 'superSpun';
            }         */


            // Post to API and get back results.
            $output = $this->curl_post($url, $data, $info);
            $output = unserialize($output);

            $article = str_replace("\r", "<br>", str_replace("\n\n", "<p>", $output['output'])) . "</p>";

            return $article;

        }

    }

    public function tip($category, $keywords = null, $testmethod = null)
    {

        $url = 'http://articlebuilder.net/api.php';

        $testmethod = 'getTip';
        // $testmethod = 'injectContent';

        // Build the data array for authenticating.

        $data = array();
        $data['action'] = 'authenticate';
        $data['format'] = 'php'; // You can also specify 'xml' as the format.

        // Change to your own username/password.

        $data['username'] = env('ARTICLE_BUILDER_USER');
        $data['password'] = env('ARTICLE_BUILDER_PASS');

        // Authenticate and get back the session id.
        // You only need to authenticate once per session.
        // A session is good for 24 hours.
        $output = unserialize($this->curl_post($url, $data, $info));

        if($output['success']=='true') {
            // Success.
            $session = $output['session'];

            // Build the data array for the example.
            $data = array();
            $data['session'] = $session;
            $data['format'] = 'php'; // You can also specify 'xml' as the format.
            $data['action'] = 'getTip';
            /*$data['apikey'] = $apikey;*/
            $data['category'] = strtolower($category);
            $data['keywords'] = $keywords;
            $data['superspun'] = 0;    //1 to use Super Spun content, 2 to use Expanded Super Spun Content,


            // Post to API and get back results.
            $output = $this->curl_post($url, $data, $info);
            $output = unserialize($output);

            $article = str_replace("\r", "<br>", str_replace("\n\n", "<p>", $output['output']));

            return $article;

        }

    }


    public function curl_post($url, $data, &$info)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->curl_postData($data));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $html = trim(curl_exec($ch));
        curl_close($ch);

        return $html;
    }

    public function curl_postData($data)
    {

        $fdata = "";
        foreach($data as $key => $val){
            $fdata .= "$key=" . urlencode($val) . "&";
        }

        return $fdata;

    }
}
