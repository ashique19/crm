<?php

namespace App\Http\Controllers\Account\Website;

use App\Http\Controllers\Controller;
use App\Models\Website as Site;
use App\Models\WebsitePage as Page;
use App\Models\WebsiteFrame as Frame;
use App\Models\WebsiteSetting as Setting;
use App\Models\WebsiteTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;
use Carbon\Carbon;

class SettingController extends Controller
{

    public function general()
    {
        $site = Site::with('user')->where('user_id', Auth::user()->id)->where('website_trashed', 0)->orderBy('id', 'desc')->first();
        $countries = DB::table('countries')->get();

        return view('account.website.settings.general_settings')->with('site', $site)->with('countries', $countries);
    }
    
    public function generalSettingStore(Request $request)
    {
        $monday_start              = new Carbon($request->monday_start);
        $monday_end                = new Carbon($request->monday_end);
        $tuesday_start             = new Carbon($request->tuesday_start);
        $tuesday_end               = new Carbon($request->tuesday_end);
        $wednesday_start           = new Carbon($request->wednesday_start);
        $wednesday_end             = new Carbon($request->wednesday_end);
        $thursday_start            = new Carbon($request->thursday_start);
        $thursday_end              = new Carbon($request->thursday_end);
        $friday_start              = new Carbon($request->friday_start);
        $friday_end                = new Carbon($request->friday_end);
        $saturday_start            = new Carbon($request->saturday_start);
        $saturday_end              = new Carbon($request->saturday_end);
        $sunday_start              = new Carbon($request->sunday_start);
        $sunday_end                = new Carbon($request->sunday_end);
        
        $site                      = Site::findOrFail($request->site_id);
        $site->business_name       = $request->business_name;
        $site->business_phone      = $request->business_phone;
        $site->business_email      = $request->business_email;
        $site->business_address    = $request->business_address1;
        $site->business_address_2  = $request->business_address2;
        $site->business_city       = $request->business_city;
        $site->business_state      = $request->business_state;
        $site->business_zip        = $request->business_zip;
        $site->business_country    = $request->business_country;
        $site->monday              = $request->mondayHours;
        $site->monday_start        = $monday_start->format('H:i');
        $site->monday_end          = $monday_end->format('H:i');
        $site->tuesday             = $request->tuesdayHours;
        $site->tuesday_start       = $tuesday_start->format('H:i');
        $site->tuesday_end         = $tuesday_end->format('H:i');
        $site->wednesday           = $request->wednesdayHours;
        $site->wednesday_start     = $wednesday_start->format('H:i');
        $site->wednesday_end       = $wednesday_end->format('H:i');
        $site->thursday            = $request->thursdayHours;
        $site->thursday_start      = $thursday_start->format('H:i');
        $site->thursday_end        = $thursday_end->format('H:i');
        $site->friday              = $request->fridayHours;
        $site->friday_start        = $friday_start->format('H:i');
        $site->friday_end          = $friday_end->format('H:i');
        $site->saturday            = $request->saturdayHours;
        $site->saturday_start      = $saturday_start->format('H:i');
        $site->saturday_end        = $saturday_end->format('H:i');
        $site->sunday              = $request->sundayHours;
        $site->sunday_start        = $sunday_start->format('H:i');
        $site->sunday_end          = $sunday_end->format('H:i');
        $site->save();
        return redirect()->back()->with('success', 'General Settings Updated.');
    }
    
    public function site()
    {
        $themes             = WebsiteTheme::all();
        $siteData           = Site::with('user')->where('user_id', Auth::user()->id)->where('website_trashed', 0)->orderBy('id', 'desc')->first();
        
        $temp['siteData']   = $siteData;
        $temp['themes']     = $themes;
        // Get the number of pages
        $pages              = Page::where('website_id', $siteData->id)->orderBy('id', 'asc')->get()->toArray();
        $temp['nrOfPages']  = count($pages);

        // Grab the last frame of site
        $indexPage          = Page::where('name', 'index')->where('website_id', $siteData->id)->orderBy('id', 'asc')->get()->toArray();
        if (count($indexPage) > 0) {
            $frame          = Frame::where('page_id', $indexPage[0]['id'])->where('revision', 0)->orderBy('id', 'asc')->first();
            if (! empty($frame)) {
                $temp['lastFrame'] = $frame->toArray();
            }
            else
            {
                $temp['lastFrame'] = '';
            }
        }
        else
            {
            $temp['lastFrame'] = '';
        }
            $site[] = $temp;        
        
        return view('account.website.settings.site_settings')->with('site', $site);
    }

    public function siteSettingStore(Request $request)
    {
        $site               = Site::findOrFail($request->site_id);
        $site->theme_id     = $request->theme_id;
        $site->website_name = $request->website_name;
        $site->description  = $request->description;
        $site->keywords     = $request->keywords;
       
        if($request->hasFile('logo')) {
            $uploadedFile   = $request->file('logo');
            $site->logo     = time().$uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs(
                'public/site/logo',
                $uploadedFile,
                $site->logo
            );
        }
        if($request->hasFile('favicon')) {
            $uploadedFile   = $request->file('favicon');
            $site->favicon  = time().$uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs(
                'public/site/favicon',
                $uploadedFile,
                $site->favicon
            );
        }
        if($request->hasFile('seo_image')) {
            $uploadedFile    = $request->file('seo_image');
            $site->seo_image = time().$uploadedFile->getClientOriginalName();
            Storage::disk('local')->putFileAs(
                'public/site/seo',
                $uploadedFile,
                $site->seo_image
            );
        }
        $site->save();

        // Update to page 
        $websitePage         = Page::where('website_id', $request->site_id)->get();

        if(count($websitePage)) {
            foreach ($websitePage as $key => $page){
                if(!$page->title) {
                    $newPage = Page::find($page->id);
                    $newPage->title = $site->website_name;
                    $newPage->save();
                }
                if(!$page->header_includes) {
                    $newPage = Page::find($page->id);
                    $newPage->header_includes = '<link rel="shortcut icon" href="'.asset('assets/images/site/'.$site->favicon).'" />';
                    $newPage->save();
                }
                if(!$page->meta_keywords) {
                    $newPage = Page::find($page->id);
                    $newPage->meta_keywords = $site->keywords;
                    $newPage->save();
                } 
                if(!$page->meta_description) {
                    $newPage = Page::find($page->id);
                    $newPage->meta_description = $site->website_name;
                    $newPage->save();
                }
            }
        }
        return redirect()->back()->with('success', 'Site Settings Updated.');
    }

    public function tag()
    {
        $site = Site::with('user')->where('user_id', Auth::user()->id)->where('website_trashed', 0)->orderBy('id', 'desc')->first();        
        return view('account.website.settings.tag_settings')->with('site', $site);
    } 

    public function tagSettingStore(Request $request)
    {

        $site               = Site::findOrFail($request->site_id);

        $site->google_tag   = $request->google_tag;
        $site->header_tag   = $request->header_tag;
        $site->footer_tag   = $request->footer_tag;
        $site->save();

        $websitePage         = Page::where('website_id', $request->site_id)->get();

        if(count($websitePage)) {
            foreach ($websitePage as $key => $page){
                
                $newPage = Page::find($page->id);
                $header_includes = '';
                $footer_includes = '';
                $google_analytics_id = !empty($request->google_tag)?$request->google_tag:'';

                $header_includes =  $newPage->header_includes;

                ////Initialize header with the favicon and update header's , google tags' new data
                $header_includes = $site->favicon;
                $header_includes .= !empty($request->header_tag)?$request->header_tag:'';
                if(!empty($google_analytics_id)) {
                    $google_code = "<script>
                         (function (i, s, o, g, r, a, m) {
                             i['GoogleAnalyticsObject'] = r;
                             i[r] = i[r] || function () {
                                 (i[r].q = i[r].q || []).push(arguments)
                             }, i[r].l = 1 * new Date();
                             a = s.createElement(o),
                                     m = s.getElementsByTagName(o)[0];
                             a.async = 1;
                             a.src = g;
                             m.parentNode.insertBefore(a, m)
                         })(window, document, 'script', '<https://www.google-analytics.com/analytics.js',> 'ga');
                         ga('create', '".$google_analytics_id."', 'auto');
                         ga('send', 'pageview');
                     </script>";

                    $header_includes .= $google_code;
                }

                $newPage->header_includes = $header_includes;
                if(empty($newPage->footer_includes)) {

                    $footer_includes .= !empty($request->footer_tag)?$request->footer_tag:'';
                    $newPage->footer_includes = $footer_includes;
                }
                $newPage->save();
            }
        }
        return redirect()->back()->with('success', 'Tag Settings Updated.');
    }
    
    public function mail()
    {
        $site = Site::with('user')->where('user_id', Auth::user()->id)->where('website_trashed', 0)->orderBy('id', 'desc')->first();        
        return view('account.website.settings.mail_settings')->with('site', $site);
    } 

    public function mailSettingStore(Request $request)
    {

        $site               = Site::findOrFail($request->site_id);
        $site->notification_email_address   = $request->notification_email_address;
        $site->notification_email_password =     $request->notification_email_password;    
        $site->notification_email_server   = $request->footer_tag;
        $site->notification_email_port   = $request->notification_email_port;        
        $site->save();
        return redirect()->back()->with('success', 'Notification Email Settings Updated.');
    }    
}