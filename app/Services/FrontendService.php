<?php

namespace App\Services;


use App\Models\Design;
use App\Models\Employee;
use App\Models\Faq;
use App\Models\Job;
use App\Models\Blog;

class FrontendService
{


    /**
     * Get Case Studies
     *
     * @param 
     * @return mixed
     */
    public function getDesigns()
    {
        return Design::orderBy('orderby', 'asc')->get();
    }

    /**
     * Get Blogs
     *
     * @param 
     * @return mixed
     */
    public function getBlogs()
    {
        return Blog::orderBy('created_at', 'desc')->get();
    }

    /**
     * Get Jobs
     *
     * @param 
     * @return mixed
     */
    public function getJobs()
    {
        return Job::orderBy('orderby', 'asc')->get();
    }

    /**
     * Get grouped faq by category
     *
     * @param 
     * @return mixed
     */
    public function getGroupedFaq()
    {
         $faqWithCategories = Faq::with('category')->get()->groupBy('category.title');

        return $faqWithCategories;
    }
}