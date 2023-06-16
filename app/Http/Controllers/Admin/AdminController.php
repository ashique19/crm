<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use App\Models\Category;
use App\Models\KnowledgeBase;
use App\Models\Language;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\WebsiteTheme;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
class AdminController extends Controller
{

    public function dashboard()
    {
        return view("admin.dashboard");
    }

    public function site()
    {
        $siteSettings = Setting::orderBy('order', 'asc')->get();
        return view("admin.settings.site")->with(compact('siteSettings'));
    }

    public function seo()
    {
        $seoSettings = Seo::get();
        return view("admin.settings.seo")->with(compact('seoSettings'));
    }

    public function get_seo(Seo $seo)
    {
        return $seo;
    }

    public function postSeo(Request $request)
    {

        $validator = Validator::make(
            $request->all(), [
            'title' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 422,'errors'=>$validator->errors()]);
        }

        $seo = Seo::findOrFail($request->input('setting_id'));
        $seo->title = $request->input('title');
        $seo->description = $request->input('description');
        $seo->save();
        Session::flash('success', 'Update successfully!');
        return response()->json(['success' => "Update successfully!"]);
    }
    
    public function knowledgebase()
    {
        $knowledgebases = Knowledgebase::get();
        return view("admin.settings.knowledgebase")->with(compact('knowledgebases'));
    }    
    
    public function categories()
    {
        $categories = Category::get();
        return view("admin.settings.categories")->with(compact('categories'));
    }        
    
    public function themes()
    {
        $themes = WebsiteTheme::get();
        return view("admin.settings.themes")->with(compact('themes'));
    }        

    public function language()
    {
        $languages = Language::get();
        return view("admin.settings.language")->with(compact('languages'));
    }

    public function downloads()
    {
        $downloads = Download::get();
        $categories = Category::where('active', 1)->get();
        return view("admin.settings.downloads")->with(compact('downloads', 'categories'));
    }

    public function singleDownload(Download $download)
    {
        return $download;
    }

    public function updateDownload(Request $request)
    {
        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|max:255',
            'category' => 'required|numeric',
            'file' => 'file|max:2048'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 422,'errors'=>$validator->errors()]);
        }

        $download = Download::find($request->id);
        $download->name = $request->name;
        $download->category_id = $request->category;
        $download->user_id = Auth::id();
        $file = $request->file('file');
        if(isset($file) && $file->isValid()) {
            $filename = $file->getClientOriginalName();
            Storage::putFileAs('public/downloads/', $file, $filename);
            $download->file = $filename;
        }
        $download->active = $request->has('active') ? $request->active : 0;
        $download->save();
        Session::flash('success', 'Update successfully!');
        return response()->json(['status' => 200,'data'=>$download]);
    }

    public function postDownload(Request $request)
    {

        $validator = Validator::make(
            $request->all(), [
            'name' => 'required|max:255',
            'category' => 'required|numeric',
            'file' => 'file|max:2048'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 422,'errors'=>$validator->errors()]);
        }

        // Handling Featured Image
        $file = $request->file('file');

        if(isset($file) && $file->isValid()) {
            $filename = $file->getClientOriginalName();
            Storage::putFileAs('public/downloads/', $file, $filename);
        }else {
            $filename = '';
        }

        $download = new Download();
        $download->name = $request->name;
        $download->category_id = $request->category;
        $download->user_id = Auth::id();
        $download->file = $filename;
        $download->active = $request->has('active') ? $request->active : 0;
        $download->save();
        Session::flash('success', 'Added successfully!');
        return response()->json(['status' => 200,'data'=>$download]);
    }

    public function get_language(Request $request)
    {
        $id = $request->input('id');
        $data= Language::where('id', $id)->first();
        return response()->json(['id' => $data['id'] ,'value' => $data['value']]);

    }
    public function update_language(Request $request)
    {
        $id = $request->lang_id;
        $value = $request->lang_val;

        DB::table('language')
            ->where('id', $id)
            ->update(['value' => $value]);

        return back()->with('success', 'Updated successfully!');
    }
    public function get_settings(Request $request)
    {
        $id = $request->input('id');
        $data= Setting::where('id', $id)->first();
        return response()->json(['id' => $data['id'] ,'display_name' => $data['display_name'] , 'value' => $data['value'],'details'=>$data['details'],'type'=>$data['type'],'order'=>$data['order'],'group'=>$data['group']]);
    }
    public function update_setting(Request $request)
    {
        $id = $request->setting_id;
        $display_name = $request->display_name;
        $value = $request->value;
        $details = $request->details;
        $type = $request->type;
        $order = $request->order;

        DB::table('settings')
            ->where('id', $id)
            ->update(['display_name'=>$display_name , 'value' => $value, 'details'=>$details ,'type'=>$type,'order'=>$order]);
        return back()->with('success', 'Updated successfully!');
    }


}
