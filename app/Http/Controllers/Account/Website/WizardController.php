<?php

namespace App\Http\Controllers\Account\Website;

use App\Http\Controllers\Controller;
use App\Models\Website;
use App\Models\WebsiteTheme;
use App\Models\WebsitePage;
use App\Models\WebsiteThemePages;
use App\Models\WebsiteFrame;
use App\Models\WebsiteThemeFrames;
use Illuminate\Http\Request;
use DB;

class WizardController extends Controller
{

    public function index()
    {
        $websiteTheme = WebsiteTheme::all();
        $countries    = DB::table('countries')->get();
        return view('account.website.wizard', compact(['websiteTheme','countries']));
    }
    
    public function post(Request $request)
    {
        if($request->get('subdomain') != '') {
            $validatedData = $request->validate(
                [
                'subdomain' => 'required|unique:websites'
                 ]
            );   
        }else{
            $validatedData = $request->validate(
                [
                'primary_domain' => 'required|unique:websites'
                ]
            );
        }
        
        $website = Website::create(
            [
            "user_id"            => $request->user()->id,
            "website_theme_id"   => $request->get('theme_id'),
            "website_name"       => $request->get('title'),
            "subdomain"          =>  ($request->get('subdomain') != '')?$request->get('subdomain'):'',
            "primary_domain"     => ($request->get('primary_domain') != '')?$request->get('primary_domain'):null,
            "description"        => $request->get('description'), 
            "keywords"           => $request->get('keywords'),      
            "theme_id"           => $request->get('theme_id'),          
            "business_name"      => $request->get('business_name'),
            "business_phone"     => $request->get('business_phone'),
            "business_email"     => $request->get('business_email'),
            "business_address"   => $request->get('business_address'),
            "business_address_2" => $request->get('business_address_2'),
            "business_city"      => $request->get('business_city'),
            "business_state"     => $request->get('business_state'),
            "business_zip"       => $request->get('business_zip'),
            "business_country"   => $request->get('business_country'),          
            "ftp_server"         => '0',
            "ftp_user"           => '0',
            "ftp_password"       => '0',
            "ftp_path"           => '0',
            "ftp_port"           => '0',
            "ftp_ok"             => '0',
            "website_trashed"    => '0',             
            ]
        );     
      
        $websitePage = WebsitePage::create(
            [
                "website_id"  => $website->id,
                "name"        => 'index',
            ]
        ); 
        $website_id = $website->id;

        if($request->get('subdomain')!= '' ) {
            app('App\Http\Controllers\Account\CpanelController')->add_subdomain($website_id);
        }else{    
            app('App\Http\Controllers\Account\CpanelController')->add_domain($website_id);
        }

        // Update to related tables after website created 
        $websiteThemePages  = WebsiteThemePages::where('website_theme_id', $request->get('theme_id'))->get();

        if(count($websiteThemePages)) {
            foreach ($websiteThemePages as $key => $websiteThemePage){
                $page                   = new WebsitePage;
                $page->website_id       = $website->id;
                $page->name             = $websiteThemePage->name;
                $page->title            = $websiteThemePage->title;
                $page->meta_keywords    = $websiteThemePage->meta_keywords;
                $page->meta_description = $websiteThemePage->meta_description;
                $page->header_includes  = $websiteThemePage->header_includes;
                $page->preview          = $websiteThemePage->preview;
                $page->template         = $websiteThemePage->template;
                $page->css              = $websiteThemePage->css;
                $page->save();

                $websiteThemeFrames     = WebsiteThemeFrames::where('website_theme_page_id', $websiteThemePage->id)->get();
                
                if(count($websiteThemeFrames)) {
                    foreach ($websiteThemeFrames as $key => $websiteThemeFrame){
                        $frame                  = new WebsiteFrame;
                        $frame->page_id         = $page->id;
                        $frame->website_id      = $website->id;
                        $frame->content         = $websiteThemeFrame->content;
                        $frame->height          = $websiteThemeFrame->height;
                        $frame->original_url    = $websiteThemeFrame->original_url;
                        $frame->loaderfunction  = $websiteThemeFrame->loaderfunction;
                        $frame->sandbox         = '0';
                        $frame->revision        = '0';
                        $frame->save();
                    }
                }    
            }
        } 

        return redirect()->route('account.sitebuilder.site', ['website_id' => $website->id ]);
    }
}