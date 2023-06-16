<?php

namespace App\Http\Controllers\Account\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeoToolController extends Controller
{

    public function index()
    {
        return view('account.website.seo_tools');
    }

}
