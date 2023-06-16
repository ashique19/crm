<?php

namespace App\Http\Controllers\Account\Support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        return view('account.support.faq');
    }

}
