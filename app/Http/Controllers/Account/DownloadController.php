<?php

namespace App\Http\Controllers\Account;

use App\Models\Category;
use App\Models\Download;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class DownloadController extends Controller
{
    public function index()
    {
        $categories = Category::active()->orderBy('order', 'asc')->get();          
        $downloads = Download::active()->get();             
        
        return view('account.downloads.index', compact('downloads', 'categories'));
    }

    public function store(PasswordStoreRequest $request)
    {
        if(config('saas.demo')) {
            flash(trans('saas.sorry_you_cant_do_this_in_demo'))->warning();
            return redirect()->back();
        }

        $request->user()->update(
            [
            'password' => bcrypt($request->password),
            ]
        );

        Mail::to($request->user())->send(new PasswordUpdated());

        flash(trans('saas.password_updated'))->success();

        return redirect()->route('account.dashboard');
    }
    public function download(Request $request,$file)
    {
        if($file) {
            $file = Crypt::decryptString($file);
            return Storage::disk('public')->download('downloads/'.$file);
        }else{
            return abort(404);
        }
    }
}
