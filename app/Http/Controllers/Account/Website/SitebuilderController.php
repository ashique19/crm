<?php

namespace App\Http\Controllers\Account\Website;

use App\Http\Controllers\Controller;
use App\Library\FTP\CI_FTP;
use App\Models\User;
use App\Models\Website as Site;
use App\Models\WebsitePage as Page;
use App\Models\WebsiteFrame as Frame;
use App\Models\WebsiteSetting as Setting;
use App\Models\WebsiteTheme as WebTheme;
use App\Models\WebsiteThemeFrames as WebThemeFrame;
use App\Models\WebsiteThemePages as WebsitePage;

use App\Models\Sitebuilder\{Exportation, Publication};
use Artisan;
use DB;
use File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use ZipArchive;
use KubAT\PhpSimple\HtmlDomParser;

class SitebuilderController extends Controller
{

    /**
     * Dashboard after login
     */
    public function getDashboard()
    {

        die();
        // Get site data
        if (!Auth::user()->role_id == 1) {
            $siteData = Site::with('user')->where('user_id', Auth::user()->id)->where('website_trashed', 0)->orderBy('id', 'asc')->get()->toArray();
        } else {
            $siteData = Site::with('user')->where('website_trashed', 0)->orderBy('id', 'asc')->get()->toArray();
        }

        //dd($siteData);
        //echo $siteData[0]['user']['email'];

        //array holding all sites and associated data
        $allSites = array();
        // Get page data
        foreach ($siteData as $site)
        {
            $temp = array();
            $temp['siteData'] = $site;

            // Get the number of pages
            $pages = Page::where('website_id', $site['id'])->orderBy('id', 'asc')->get()->toArray();
            $temp['nrOfPages'] = count($pages);

            // Grab the last frame of site
            $indexPage = Page::where('name', 'index')->where('website_id', $site['id'])->orderBy('id', 'asc')->get()->toArray();
            if (count($indexPage) > 0) {
                //dd($indexPage);
                $frame = Frame::where('page_id', $indexPage[0]['id'])->where('revision', 0)->orderBy('id', 'asc')->first();
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
            $allSites[] = $temp;
        }

        $users = User::orderBy('id', 'asc')->get();

        return view('account.website.sitebuilder.sites', array('sites' => $allSites, 'users' => $users))
            ->with('pSettings', $this->getPageSettings());
    }

    /**
     * Create New Site
     */
    public function getSiteCreate()
    {
        $site = new Site();
        $site->user_id = Auth::user()->id;
        $site->website_name = 'My New Site';
        $site->website_trashed = 0;
        $site->save();

        $page = new Page();
        $page->website_id = $site->id;
        $page->name = 'index';
        $page->save();

        return redirect()->route('account.sitebuilder.site', ['website_id' => $site->id]);
    }

    /**
     * Bring saved site on canvas
     *
     * @param Request $request
     * @param Integer $website_id
     */
    public function getSite(Request $request, $website_id)
    {

        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');


        $request->session()->put('siteID', $website_id);
        $site = Site::where('id', $website_id)->get();

        // If user is not an admin then check if user own this site
        if (Auth::user()->type != 'admin') {
            if ($site[0]['user_id'] != Auth::user()->id) {
                return redirect()->route('sitebuilder.dashboard');
            }
        }

        // Get site details
        $siteArray['site'] = Site::where('id', $website_id)->get();

        // Get page details
        $pages = Page::where('website_id', $website_id)->get();
        foreach ($pages as $page)
        {
            $frames = Frame::where('page_id', $page->id)->where('revision', 0)->orderBy('id', 'ASC')->get();
            $pageDetails['blocks'] = $frames;
            $pageDetails['page_id'] = $page->id;
            $pageDetails['pages_title'] = $page->title;
            $pageDetails['meta_description'] = $page->meta_description;
            $pageDetails['meta_keywords'] = $page->meta_keywords;
            $pageDetails['header_includes'] = $page->header_includes;
            $pageDetails['footer_includes'] = $page->footer_includes;
            $pageDetails['css'] = $page->css;
            $pageFrames[$page->name] = $pageDetails;
        }
        $siteArray['pages'] = $pageFrames;


        // Get directory details
        $settings = Setting::where('name', 'elements_dir')->first();
        $siteArray['assetFolders'] = File::directories($settings['value']);


        if (count($siteArray) > 0) {
            // Get Site Data
            $data['siteData'] = $siteArray;

            // Get Page Data
            $pageA = Page::where('website_id', $website_id)->get();

            foreach ($pageA as $pageB) {
                $framesA = Frame::where('page_id', $pageB->id)->where('revision', 0)->orderBy('id', 'ASC')->get();
                $pageFrame[$pageB->name] = $pageB;
            }
            $data['pagesData'] = $pageFrame;


            // Collect data for the image library
            //
            // User Images
            $elementsDir = Setting::where('name', 'elements_dir')->first();
            $uploadDir = Setting::where('name', 'images_uploadDir')->first();
            $imageDir = Setting::where('name', 'images_dir')->first();
            $allowedExt = Setting::where('name', 'images_allowedExtensions')->first();
            $temp = explode('|', $allowedExt->value);
            if (is_dir($uploadDir->value . '/' . Auth::user()->id)) {
                $userFolderContent = directory_map($uploadDir->value . '/' . Auth::user()->id, 2);
                if ($userFolderContent) {
                    $userImages = array();
                    foreach ($userFolderContent as $userKey => $userItem)
                    {
                        if (! is_array($userItem)) {
                            // Check the file extension
                            $ext = pathinfo($userItem, PATHINFO_EXTENSION);
                            // Prepared allowed extensions file array
                            if (in_array($ext, $temp)) {
                                   array_push($userImages, $userItem);
                            }
                        }
                    }
                }
                else
                {
                    $userImages = false;
                }
            }
            else
            {
                $userImages = false;
            }

            if (isset($userImages)) {
                $userSrc = url('/') . '/' . $uploadDir->value . '/' . Auth::user()->id;
                $dataURL = str_replace($elementsDir->value . '/', '', $uploadDir->value);
                $data['userImages'] = View('account.website.sitebuilder.partials.myimages', array('userImages' => $userImages, 'userSrc' => $userSrc, 'dataURL' => $dataURL));
            }
            // Admin Images
            $adminFolderContent = directory_map(public_path($imageDir->value), 2);
            if ($adminFolderContent) {
                $adminImages = array();
                foreach ($adminFolderContent as $adminKey => $adminItem)
                {
                    if (! is_array($adminItem)) {
                         // Check the file extension
                        $ext = pathinfo($adminItem, PATHINFO_EXTENSION);
                         // Prepared allowed extensions file array
                        if (in_array($ext, $temp)) {
                            array_push($adminImages, $adminItem);
                        }
                    }
                }
            }
            else
            {
                $adminImages = false;
            }

            if (isset($adminImages)) {
                $adminSrc = url('/') . '/' . $imageDir->value;
                $dataURL = str_replace($elementsDir->value . '/', '', $imageDir->value);
                $data['adminImages'] = View('account.website.sitebuilder.partials.adminimages', array('adminImages' => $adminImages, 'adminSrc' => $adminSrc, 'dataURL' => $dataURL));
            }
            // Pre-build templates
            $templatePages = Page::where('template', 1)->get();

            foreach ($templatePages as $templatePage)
            {
                $templatePageFrames = array();
                $templateFrames = Frame::where('page_id', $templatePage->id)->where('revision', 0)->get();
                foreach ($templateFrames as $templateFrame)
                {
                    $tFrame = array();
                    $tFrame['pageName'] = $templatePage->name;
                    $tFrame['pageID'] = $templatePage->id;
                    $tFrame['id'] = $templateFrame->id;
                    $tFrame['height'] = $templateFrame->height;
                    $tFrame['original_url'] = $templateFrame->original_url;
                    $templatePageFrames[] = $tFrame;
                }
                $templates[$templatePage->id] = $templatePageFrames;
            }
            if (isset($templates)) {
                //$data['templates'] = View('account.website.sitebuilder.partials.templateframes', array('pages' => $templates));
            }
        }
        else
        {
            return redirect()->route('sitebuilder.dashboard');
        }

        // Grab all revisions
        $pages = Page::where('website_id', $website_id)->where('name', 'index')->get();
        if (!is_null($pages)) {
            $pageID = $pages[0]->id;
            $frames = Frame::where('website_id', $website_id)->where('revision', 1)->where('page_id', $pageID)->orderBy('updated_at', 'DESC')->get();

        }
        else
        {
            $frames = false;
        }

        $data['revisions'] = $frames;

        $revisionView = View('account.website.sitebuilder.partials.revisions', array('data' => $data['revisions'], 'page' => $pages[0]->name));
        $data['revisionView'] = $revisionView->render();
        // Generate pagedata view
        if (count($data['pagesData']) > 0) {
            $pageView = View('account.website.sitebuilder.partials.pagedata', array('data' => $data['pagesData']));
            $data['pagedataView'] = $pageView->render();
        }
        else
        {
            $pageView = View('account.website.sitebuilder.partials.pagedata', array('data' => $data['siteData']['pages']['index']));
            $data['pagedataView'] = $pageView->render();
        }

        $data['builder'] = true;
        $data['page'] = 'site';

        return view('account.website.sitebuilder.create', ['data' => $data])->render();
    }

    /**
     * Bring the site data
     *
     * @param  Request $request
     * @return JSON
     */
    public function getSiteData(Request $request)
    {
        $siteID = $request->session()->get('siteID');

        $site = Site::where('id', $siteID)->get();

        if (count($site) > 0) {
            $siteArray['site'] = $site[0];
            $pages = Page::where('website_id', $siteID)->get();
            foreach ($pages as $page)
            {
                $frames = Frame::where('page_id', $page->id)->where('revision', 0)->orderBy('id', 'ASC')->get();
                if(!is_null($frames)) {
                    $pageDetails['blocks'] = $frames;
                    $pageDetails['page_id'] = $page->id;
                    $pageDetails['pages_title'] = $page->title;
                    $pageDetails['meta_description'] = $page->meta_description;
                    $pageDetails['meta_keywords'] = $page->meta_keywords;
                    $pageDetails['header_includes'] = $page->header_includes;
                    $pageDetails['footer_includes'] = $page->footer_includes;
                    $pageDetails['page_css'] = $page->css;
                    $pageFrames[$page->name] = $pageDetails;
                }
            }
            $siteArray['pages'] = $pageFrames;

            echo json_encode($siteArray);
        } else {
            return response('undefined');
        }
    }

    /**
     * Save page and frame
     *
     * @param  Request $request
     * @param  Integer $forPublish
     * @return JSON
     */
    public function postSave(Request $request, $forPublish = 0)
    {
        if (! isset($request['siteData'])) {
            $temp = array();
            $temp['header'] = 'Ouch! Something went wrong:';
            $temp['content'] = 'The siteData is missing, please try again.';
            $return = array();
            $return['responseCode'] = 0;
            $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
            $return['responseHTML'] = $view->render();

            die(json_encode($return));
        }
        $siteData = $request['siteData'];

        $site = Site::where('id', $siteData['id'])->first();

        $site->website_name = $siteData['website_name'];
        $site->update();

        if ($request->has('pages')) {
            foreach ($request['pages'] as $page => $pageData)
            {
                if ($pageData['status'] == 'changed') {
                    // Get page data
                    $pageNew = Page::where('website_id', $siteData['id'])->where('id', $pageData['pageID'])->first();

                    $oldName = $pageNew->name;

                    $pageNew->website_id = $siteData['id'];
                    $pageNew->name = $page;
                    $pageNew->title = $pageData['pageSettings']['title'];
                    $pageNew->meta_keywords = $pageData['pageSettings']['meta_keywords'];
                    $pageNew->meta_description = $pageData['pageSettings']['meta_description'];
                    $pageNew->header_includes = $pageData['pageSettings']['header_includes'];
                    $pageNew->footer_includes = $pageData['pageSettings']['footer_includes'];
                    $pageNew->css = $pageData['pageSettings']['page_css'];
                    $pageNew->update();
                    $pageID = $pageNew->id;
                    $pageNew1 = WebsitePage::where('website_theme_id', $siteData['id'])->where('name', $oldName)->first();
                    if($pageNew1) {
                        $pageNew1->website_theme_id = $siteData['id'];
                        $pageNew1->name = $page;
                        $pageNew1->title = $pageData['pageSettings']['title'];
                        $pageNew1->meta_keywords = $pageData['pageSettings']['meta_keywords'];
                        $pageNew1->meta_description = $pageData['pageSettings']['meta_description'];
                        $pageNew1->header_includes = $pageData['pageSettings']['header_includes'];
                        $pageNew1->css = $pageData['pageSettings']['page_css'];
                        $pageNew1->update();


                    }
                }
                elseif ($pageData['status'] == 'new') {
                    $pageNew = new Page();
                    $pageNew->website_id = $siteData['id'];
                    $pageNew->name = $page;
                    if($pageData['pageSettings']['title']=='') {
                        $pageNew->title =  $site->website_name;
                    }else{
                        $pageData['pageSettings']['title']; 
                    }
                    if($pageData['pageSettings']['meta_keywords'] == '') {
                        $pageNew->meta_keywords = $site->keywords;
                    }else{
                        $pageNew->meta_keywords = $pageData['pageSettings']['meta_keywords'];
                    }
                    if($pageData['pageSettings']['meta_description'] == '') {
                        $pageNew->meta_description = $site->website_name;
                    }else{
                        $pageNew->meta_description = $pageData['pageSettings']['meta_description'];
                    }
                    if($pageData['pageSettings']['header_includes'] == '') {
                        $pageNew->header_includes = $site->favicon.$site->header_tag.$site->google_tag;
                    }else{
                         $pageNew->header_includes = $pageData['pageSettings']['header_includes'];
                    }
                   
                    $pageNew->footer_includes =$site->footer_tag;
                    $pageNew->css = $pageData['pageSettings']['page_css'];
                    $pageNew->save();
                    $pageID = $pageNew->id;
                    $pageNew2 = new WebsitePage();
                        $pageNew2->website_theme_id = $siteData['id'];
                        $pageNew2->name = $page;
                        $pageNew2->title = $pageData['pageSettings']['title'];
                        $pageNew2->meta_keywords = $pageData['pageSettings']['meta_keywords'];
                        $pageNew2->meta_description = $pageData['pageSettings']['meta_description'];
                        $pageNew2->header_includes = $pageData['pageSettings']['header_includes'];
                        $pageNew2->css = $pageData['pageSettings']['page_css'];
                        $pageNew2->save();
                        $pageID = $pageNew2->id;
                }

                // Page done, onto the blocks
                // Push existing frames into revision
                $frames = Frame::where('page_id', $pageID)->get();
                if ($frames) {
                    foreach ($frames as $frame)
                    {
                        $frame->revision = 1;
                        $frame->update();
                    }
                }
                $themeframes = WebThemeFrame::where('website_theme_page_id', $pageID)->get();
                if ($themeframes) {
                    foreach ($themeframes as $themeframe)
                    {
                        $themeframe->update();
                    }
                }
                if (isset($pageData['blocks'])) {

                    foreach ($pageData['blocks'] as $block)
                    {
                        $frames = new Frame();
                        $frames->page_id = $pageID;
                        $frames->website_id = $siteData['id'];
                        $frames->content = $block['frameContent'];
                        $frames->height = $block['frameHeight'];
                        $frames->original_url = $block['original_url'];
                        $frames->loaderfunction = $block['loaderFunction'];
                        $frames->sandbox = ($block['sandbox'] == 'true') ? 1 : 0;
                        $frames->revision = 0;

                        $frameHTML = HtmlDomParser::str_get_html($frames->content);
                        $theme_entry = WebTheme::where('name', 'barbar')->first();
                        if (!$theme_entry) {
                            $frameContent = $frameHTML->find('input[name=type]', 0);
                            $frameContent2 = $frameHTML->find('input[name=screenshot]', 0);
                            if ($frameContent && $frameContent2) {
                                $theme_name = $frameContent->value;
                                $screenshot = $frameContent2->value;
                                $webthemes = new WebTheme();
                                $webthemes->name = $theme_name;
                                $webthemes->status = '1';
                                $webthemes->screenshot = $screenshot;
                                $webthemes->save();
                            }
                        }
                        $frameContent = $frameHTML->find('input[name=type]', 0);
                        if ($frameContent) {
                            $webthemeframe = new WebThemeFrame();
                            $webthemeframe->website_theme_page_id = $pageID;
                            $webthemeframe->content = $block['frameContent'];
                            $webthemeframe->height = $block['frameHeight'];
                            $webthemeframe->original_url = $block['original_url'];
                            $webthemeframe->loaderfunction = $block['loaderFunction'];
                            $webthemeframe->save();

                        }

                        $frames->save();
                    }
                }
            }
        }
        // Delete any pages?
        if (isset($request['toDelete']) && is_array($request['toDelete']) && count($request['toDelete']) > 0) {
            foreach ($request['toDelete'] as $page)
            {
                $page = Page::where('website_id', $siteData['id'])->where('name', $page)->first();
                if ($page) {
                    $page->delete();
                }
            }
            foreach ($request['toDelete'] as $page1)
            {
                $page1 = WebsitePage::where('website_theme_id', $siteData['id'])->where('name', $page1)->first();
                if ($page1) {
                    $page1->delete();
                }
            }

        }

        $return = array();

        // Regular site save
        if ($forPublish == 0) {
            $temp = array();
            $temp['header'] = "Success!";
            $temp['content'] = "The site has been saved successfully!";
        }
        // Saving before publishing, requires different message
        elseif ($forPublish == 1) {
            $temp = array();
            $temp['header'] = "Success!";
            $temp['content'] = "The site has been saved successfully! You can now proceed with publishing your site.";
        }
        $return['responseCode'] = 1;
        $view = View('account.website.sitebuilder.partials.success', array('data' => $temp));
        $return['responseHTML'] = $view->render();

        die(json_encode($return));
    }

    /**
     * Get frame content by Frame ID
     *
     * @param  Integer $frame_id
     * @return String
     */
    public function getFrame($frame_id)
    {
        $frame = Frame::where('id', $frame_id)->first();
        //dd($frame);
        echo $frame->content;
    }

    /**
     * Get site info with ajax call
     *
     * @param  Request $request
     * @param  Integer $website_id
     * @return JSON
     */
    public function getSiteAjax(Request $request, $website_id)
    {
        $siteData = Site::where('id', $website_id)->get();
        $return['responseCode'] = 1;
        $view = View('account.website.sitebuilder.partials.sitedata', array('data' => $siteData));
        $return['responseHTML'] = $view->render();
        echo json_encode($return);
    }

    /**
     * Live preview site
     *
     * @param  Request $request
     * @return HTML
     */
    public function postLivePreview(Request $request)
    {
        if ($request->has('siteID')) {
            $siteData = Site::where('id', $request->input('siteID'))->first();
        }
        $head = "";
        // Title
        if ($request->has('meta_title')) {
            $head .= '<title>'.$request->input('meta_title').'</title>'."\n";
        }
        // Meta description
        if ($request->has('meta_description')) {
            $head .= '<meta name="description" content="'.$request->input('meta_description').'"/>'."\n";
        }
        // Meta keywords
        if ($request->has('meta_keywords')) {
            $head .= '<meta name="keywords" content="'.$request->input('meta_keywords').'"/>'."\n";
        }
        // Header includes
        if ($request->has('header_includes')) {
            $head .= $request->input('header_includes')."\n";
        }
        // Footer includes
        if ($request->has('footer_includes')) {
            $head .= $request->input('footer_includes')."\n";
        }
        // Page css
        if ($request->has('page_css')) {
            $head .= "\n<style>".$request->input('page_css')."</style>\n";
        }
        // Global css
        if ($siteData->global_css != '') {
            $head .= "\n<style>".$siteData->global_css."</style>\n";
        }

        // Custom header to deal with XSS protection
        header("X-XSS-Protection: 0");
        echo str_replace(' <!--headerIncludes-->', $head, "<!DOCTYPE html>\n".$request['page']);
    }

    /**
     * Get revision info
     *
     * @param Integer $website_id
     * @param String  $page
     */
    public function getRevisions($website_id, $page)
    {

        if ($website_id != '' && $page != '') {
            // Grab all revisions
            $pages = Page::where('website_id', $website_id)->where('name', $page)->get();
              

            if (!is_null($pages)) {
                $page_id = $pages[0]->id;
                $frames = Frame::where('website_id', $website_id)->where('revision', 1)->where('page_id', $page_id)->orderBy('updated_at', 'DESC')->get();   
             
            }
            else
            {
                $frames = false;
            }

            $data['revisions'] = $frames;

            $revisionView = View('account.website.sitebuilder.partials.revisions', array('data' => $data['revisions'], 'page' => $pages[0]->name));
            $revision = $revisionView->render();
            echo $revision;
        }
    }

    /**
     * Retrive a preview for a revision
     *
     * @param Integer $website_id
     * @param Integer $datetime
     * @param String  $page
     */
    public function getRevisionPreview($website_id, $datetime, $page)
    {
        if ($website_id == '' || $datetime == '' || $page == '') {
            die('Missing data, revision could not be loaded');
        }

        $page = Page::where('website_id', $website_id)->where('name', $page)->first();
        $page_id = $page->id;
        $frames = Frame::where('website_id', $website_id)->where('updated_at', date('Y-m-d H:i:s', $datetime))->where('revision', 1)->where('page_id', $page_id)->get();
        $skeleton = HtmlDomParser::file_get_html('./elements/skeleton.html');

        // Get the page container
        $ret = $skeleton->find('div[id=page]', 0);

        $page = '';

        foreach($frames as $frame)
        {
            $frameHTML = HtmlDomParser::str_get_html($frame->content);
            $frameContent = $frameHTML->find('div[id=page]', 0);
            $page .= $frameContent->innertext;
        }

        $ret->innertext = $page;

        // Print it!
        echo $skeleton;

        //$revisionOutput = $this->revisionmodel->buildRevision($siteID, $revisionStamp, $page);

        //echo $revisionOutput;
    }

    /**
     * Delete Revision
     *
     * @param  Integer $website_id
     * @param  Integer $datetime
     * @param  String  $page
     * @return JSON
     */
    public function getRevisionDelete($website_id, $datetime, $page)
    {
        //DB::enableQueryLog();
        $return = array();
        if ($website_id == '' || $datetime == '' || $page == '') {
            $return['code'] = 0;
            $return['message'] = 'Some data is missing, we can not delete this revision right now. Please try again later.';
            die(json_encode($return));
        }

        $q_page = Page::where('website_id', $website_id)->where('name', $page)->first();
        $frame = Frame::where('website_id', $website_id)->where('page_id', $q_page->id)->where('updated_at', date('Y-m-d H:i:s', $datetime))->where('revision', 1)->first();
        //dd(DB::getQueryLog());

        $frame->delete();

        $return['code'] = 1;
        $return['message'] = 'The revision was removed successfully.';

        echo json_encode($return);
    }

    /**
     * Restore revision site
     *
     * @param Integer $website_id
     * @param Integer $datetime
     * @param String  $page
     */
    public function getRevisionRestore($website_id, $datetime, $page)
    {
        if ($website_id == '' || $datetime == '' || $page == '') {
            die('Missing data, revision could not be restore.');
        }

        $page = Page::where('website_id', $website_id)->where('name', $page)->first();

        // Update current frame as revision
        $page_id = $page->id;

        $frame = Frame::where('website_id', $website_id)->where('page_id', $page_id)->where('revision', 0)->update(['revision' => 1]);

        // Restore revision by recreating the old revision
        $frames = Frame::where('website_id', $website_id)->where('page_id', $page_id)->where('updated_at', date('Y-m-d H:i:s', $datetime))->get();

        foreach ($frames as $frame)
        {
            $new_frame = new Frame();
            $new_frame->page_id = $page_id;
            $new_frame->website_id = $website_id;
            $new_frame->content = $frame->content;
            $new_frame->height = $frame->height;
            $new_frame->original_url = $frame->original_url;
            $new_frame->loaderfunction = $frame->loaderfunction;
            $new_frame->sandbox = $frame->sandbox;
            $new_frame->revision = 0;
            $new_frame->save();
        }

        return redirect()->route('account.sitebuilder.site', [$website_id]);
    }

    protected function siteUpdate(Request $request)
    {
        // Test the FTP connection
        $ftp = new CI_FTP;
        $config = array(
        'hostname' => trim($request->input('siteSettings_ftpServer')),
        'username' => trim($request->input('siteSettings_ftpUser')),
        'password' => trim($request->input('siteSettings_ftpPassword')),
        'port' => trim($request->input('siteSettings_ftpPort')),
        'debug' => false,
        );
        if ($ftp->connect($config)) {
            $ftpOK = 1;
        }
        else
        {
            $ftpOK = 0;
        }

        // Update site data
        $site = Site::where('id', $request->input('siteID'))->first();
        $site->website_name = trim($request->input('siteSettings_siteName'));
        $site->ftp_server = trim($request->input('siteSettings_ftpServer'));
        $site->ftp_user = trim($request->input('siteSettings_ftpUser'));
        $site->ftp_password = trim($request->input('siteSettings_ftpPassword'));
        $site->ftp_path = trim($request->input('siteSettings_ftpPath'));
        $site->ftp_port = trim($request->input('siteSettings_ftpPort'));
        $site->ftp_ok = $ftpOK;
        $site->global_css = trim($request->input('siteSettings_siteCSS'));
        $site->remote_url = trim($request->input('siteSettings_remoteUrl'));
        $site->update();

        return $ftpOK;
    }

    public function postSiteUpdate(Request $request)
    {
        $ftpOK = $this->siteUpdate($request);

        if ($ftpOK) {
            $message = 'The site\'s details were saved successfully!';
            $status = 'success';
        }

        else {
            $message = 'The site\'s details were saved successfully, <b>however the provided FTP details could not be used to successfully establish a connection; you won\'t be able to publish your site.</b>';
            $status = 'danger';
        }

        return redirect()->route('sitebuilder.dashboard')->with(
            'response', [
            'msg' => $message,
            'status' => $status
            ]
        );
    }

    /**
     * Site Settings data update with ajax
     *
     * @param  Request $request
     * @return JSON
     */
    public function postAjaxUpdate(Request $request)
    {
        $ftpOK = $this->siteUpdate($request);

        // Send success message
        $temp['header'] = 'Yeah! All went well.';
        if ($ftpOK) {
            $temp['content'] = 'The site\'s details were saved successfully!';
            $return['ftpOK'] = 1;
        }
        else
        {
            $temp['content'] = 'The site\'s details were saved successfully, <b>however the provided FTP details could not be used to successfully establish a connection; you won\'t be able to publish your site.</b>';
            $return['ftpOK'] = 0;
        }

        $return['responseCode'] = 1;
        $view1 = View('account.website.sitebuilder.partials.success', array('data' => $temp));
        $return['responseHTML'] = $view1->render();

        // Send back the updated data
        $siteData = Site::where('id', $request->input('siteID'))->get();
        $view2 = View('account.website.sitebuilder.partials.sitedata', array('data' => $siteData));
        $return['responseHTML2'] = $view2->render();

        $return['siteName'] = $request->input('siteSettings_siteName');
        $return['siteID'] = $request->input('siteID');

        // $return['responseCode'] = 1;
        // $return['ftp'] = config('filesystems.disk.ftp.host');
        echo json_encode($return);
    }

    /**
     * Update page data with ajax call
     *
     * @param  Request $request
     * @return JSON
     */
    public function postUpdatePageData(Request $request)
    {
        // Update page data
        $page = Page::firstOrNew(array('id' => $request->input('pageID')));
        $page->website_id = $request->input('siteID');
        $page->title = $request->input('pageData_title');
        $page->meta_keywords = $request->input('pageData_metaKeywords');
        $page->meta_description = $request->input('pageData_metaDescription');
        $page->header_includes = $request->input('pageData_headerIncludes');
        $page->footer_includes = $request->input('pageData_footerIncludes');
        $page->css = $request->input('pageData_headerCss');
        $page->save();

        // Return page data as well
        // Get page details
        $pages = Page::where('website_id', $request->input('siteID'))->get();
        foreach ($pages as $page)
        {
            $frames = Frame::where('page_id', $page->id)->where('revision', 0)->orderBy('id', 'ASC')->get();
            $pageDetails['blocks'] = $frames;
            $pageDetails['page_id'] = $page->id;
            $pageDetails['pages_title'] = $page->title;
            $pageDetails['meta_description'] = $page->meta_description;
            $pageDetails['meta_keywords'] = $page->meta_keywords;
            $pageDetails['header_includes'] = $page->header_includes;
            $pageDetails['footer_includes'] = $page->footer_includes;
            $pageDetails['css'] = $page->css;
            $pageFrames[$page->name] = $pageDetails;
        }
        $siteArray['pages'] = $pageFrames;

        if (count($siteArray) > 0) {
            $return['siteData'] = $siteArray;

            $pageA = Page::where('website_id', $website_id)->get();
            foreach ($pageA as $pageB)
            {
                $framesA = Frame::where('page_id', $pageB->id)->where('revision', 0)->orderBy('id', 'ASC')->get();
                $pageFrame[$pageB->name] = $pageB;
            }
            $return['pagesData'] = $pageFrame;
        }

        $temp['header'] = 'All set!';
        $temp['content'] = 'The page settings were successfully updated.';

        $return['responseCode'] = 1;
        $view = View('account.website.sitebuilder.partials.success', array('data' => $temp));
        $return['responseHTML'] = $view->render();

        die(json_encode($return));
    }

    /**
     * Export Site
     *
     * @param Request $request
     */
    public function postExport(Request $request)
    {
        $site = Site::find($request->siteID);
        $exportation = new Exportation($site);

        $filePath = $exportation->generateZipFile($request->pages, $request->doctype);
        $fileBasename = $exportation->getFilename();

        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Disposition: attachment; filename=$fileBasename");
        header("Content-Length: " . filesize($filePath));

        readfile($filePath);

        unlink($filePath);

        exit;
    }

    protected function errorViewGenerator($content)
    {
        $temp = array();
        $temp['header'] = 'Ouch! Something went wrong:';
        $temp['content'] = $content;
        $return = array();
        $return['responseCode'] = 0;
        $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
        $return['responseHTML'] = $view->render();

        return $return;
    }

    /**
     * Publish site with ajax call
     *
     * @param  Request $request
     * @param  String  $type
     * @return JSON
     */
    public function postPublish(Request $request, $type = null)
    {
        // If none of assets selected
        if (!$request->has('item') || empty($request->item)) {
            die(json_encode($this->errorViewGenerator('It appears there are no assets selected for publication. Please select the assets you\'d like to publish and try again.')));
        }

        $site = Site::find($request->site_id);

        // If incorrect site ID.
        if (!$site) {
            die(json_encode($this->errorViewGenerator('It appears the site ID is '.$request.' missing OR '.$request->website_id.' incorrect. Please refresh your page and try again.')));
        }

        $publication = new Publication($site);

        if ($type == 'asset') {
            $publication->publishAsset($request->item);
        } elseif ($type == 'page') {
            $publication->publishPage($request->item, $request->pageContent);
        }

        $site->ftp_published = 1;
        $site->update();

        $return = array();
        $return['responseCode'] = 1;
        die(json_encode($return));
    }

    /**
     * Trash site with ajax call
     *
     * @param  Integer $website_id
     * @return JSON
     */
    public function getTrash($website_id)
    {
        if ($website_id == '' || $website_id == 'undefined') {
            $temp = array();
            $temp['header'] = 'Ouch! Something went wrong:';
            $temp['content'] = 'The site ID is missing or corrupt. Please try reloading the page and then try deleting the site once more.';

            $return = array();
            $return['responseCode'] = 0;
            $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
            $return['responseHTML'] = $view->render();

            die(json_encode($return));
        }

        // All good, move to trash
        $site = Site::where('id', $website_id)->first();
        $site->website_trashed = 1;
        $site->update();

        $temp = array();
        $temp['header'] = 'All set!';
        $temp['content'] = 'The site was successfully deleted from the system.';

        $return = array();
        $return['responseCode'] = 1;
        $view = View('account.website.sitebuilder.partials.success', array('data' => $temp));
        $return['responseHTML'] = $view->render();

        die(json_encode($return));
    }

    /**
     * List FTP folder content
     *
     * @param  Request $request
     * @return JSON
     */
    public function postFTPConnect(Request $request)
    {
        $ftp = new CI_FTP;
        $config = array(
        'hostname' => trim($request->input('siteSettings_ftpServer')),
        'username' => trim($request->input('siteSettings_ftpUser')),
        'password' => trim($request->input('siteSettings_ftpPassword')),
        'port' => trim($request->input('siteSettings_ftpPort')),
        'debug' => false,
        );
        if ($ftp->connect($config)) {
            $path = ($request->input('siteSettings_ftpPath')) ? trim($request->input('siteSettings_ftpPath')) : '/';
            $list = $ftp->list_files($path);
            if ($list) {
                $temp = array();
                $temp['list'] = $list;
                $temp['data'] = $_POST;

                $return = array();
                $return['responseCode'] = 1;
                $view = View('account.website.sitebuilder.partials.ftplist', array('data' => $temp));
                $return['responseHTML'] = $view->render();
            }
            else
            {
                $temp = array();
                $temp['header'] = 'Error:';
                $temp['content'] = 'The path you have provided is not correct or you might not have the required permissions to access this path.';

                $return = array();
                $return['responseCode'] = 0;
                $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
                $return['responseHTML'] = $view->render();
            }
        }
        else
        {
            $temp = array();
            $temp['header'] = 'Error:';
            $temp['content'] = 'The connection details (server, username, password and/or port) you provided are not correct. Please update the details and try again.';

            $return = array();
            $return['responseCode'] = 0;
            $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
            $return['responseHTML'] = $view->render();
        }

        $ftp->close();
        die(json_encode($return));
    }

    /**
     * Test FTP connection
     *
     * @param  Request $request
     * @return JSON
     */
    public function postFTPTest(Request $request)
    {
        $path = ($request->input('siteSettings_ftpPath')) ? trim($request->input('siteSettings_ftpPath')) : '/';
        $ftp = new CI_FTP;
        $config = array(
        'hostname' => trim($request->input('siteSettings_ftpServer')),
        'username' => trim($request->input('siteSettings_ftpUser')),
        'password' => trim($request->input('siteSettings_ftpPassword')),
        'port' => trim($request->input('siteSettings_ftpPort')),
        'debug' => false,
        );
        if ($ftp->connect($config)) {
            $list = $ftp->list_files($path);
            if ($list) {
                $temp = array();
                $temp['header'] = 'All good!';
                $temp['content'] = 'The provided FTP details are all good and can be used to publish this site.';

                $return = array();
                $return['responseCode'] = 1;
                $view = View('account.website.sitebuilder.partials.success', array('data' => $temp));
                $return['responseHTML'] = $view->render();
            }
            else
            {
                $temp = array();
                $temp['header'] = 'Error:';
                $temp['content'] = 'The path you have provided is not correct or you might not have the required permissions to access this path.';

                $return = array();
                $return['responseCode'] = 0;
                $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
                $return['responseHTML'] = $view->render();
            }
        }
        else
        {
            $temp = array();
            $temp['header'] = 'Error:';
            $temp['content'] = 'The connection details (server, username, password and/or port) you provided are not correct. Please update the details and try again.';

            $return = array();
            $return['responseCode'] = 0;
            $view = View('account.website.sitebuilder.partials.error', array('data' => $temp));
            $return['responseHTML'] = $view->render();
        }

        $ftp->close();
        die(json_encode($return));
    }

    /**
     * Test for FTP call
     */
    public function getTest()
    {
        $ftp = new CI_FTP;
        $config = array(
        'hostname' => 'innovativebd.net',
        'username' => 'latest@innovativebd.info',
        'password' => 'admin123!',
        'port' => 21,
        );
        if ($ftp->connect($config)) {
            $ftp->mirror(public_path() . '/elements/images/', "/");
            dd($ftp->list_files());
        }
        else
        {
            die("can't connect");
        }

    }

    public function siteSetting($id)
    {
        $user = Auth::user();
        $site = Site::hasId($id)->belongsToUser($user->id)->firstOrFail();

        return View('account.website.sitebuilder.sites.settings')
            ->with('pSettings', $this->getPageSettings())
            ->with('site', $site);
    }

    public function getPageSettings()
    {
        $user = Auth::user();
        $pSettings = [];

        $pSettings['layouts'] = 'layouts.app';
        $pSettings['userDashboard'] = 'account.dashboard';

        return $pSettings;
    }
    public function get_contact_data(Request $request)
    {
        $user_id = Auth::user()->id;
        $siteData = Site::where('user_id', $user_id)->first();
        $get_file = HtmlDomParser::file_get_html('./elements/'.$request->page);
        if($request->page == 'contact1.html') {
            /*clear previous address,email,phone*/
             $get_file->find('p[class=contact-address]', 0)->innertext = '';
             $get_file->find('p[class=contact-email]', 0)->innertext = '';
             $get_file->find('p[class=contact-phone]', 0)->innertext = '';

            /*put new address,email,phone*/  
             $get_file->find('p[class=contact-address]', 0)->innertext = $siteData->business_address;
             $get_file->find('p[class=contact-email]', 0)->innertext = $siteData->business_email;
             $get_file->find('p[class=contact-phone]', 0)->innertext = $siteData->business_phone;
        
             file_put_contents('./elements/'.$request->page, $get_file);
        }elseif($request->page == 'footer4.html') {
             /*clear previous address,email,phone*/
              $get_file->find('li[class=contact-address]', 0)->innertext = '';
              $get_file->find('li[class=contact-email]', 0)->innertext = '';
              $get_file->find('li[class=contact-phone]', 0)->innertext = '';

               /*put new address,email,phone*/  
              $get_file->find('li[class=contact-address]', 0)->innertext = '<a href="#" target="_blank"><i class="far fa-map"></i>'.$siteData->business_address.'</a>';
              $get_file->find('li[class=contact-email]', 0)->innertext = '<a href=mailto:'.$siteData->business_email.' target="_blank"><i class="far fa-envelope-open"></i>'.$siteData->business_email.'</a>';
              $get_file->find('li[class=contact-phone]', 0)->innertext = '<a href=tel:'.$siteData->business_phone.' target="_blank"><i class="far fa-comment"></i>'.$siteData->business_phone.'</a>' ;
              file_put_contents('./elements/'.$request->page, $get_file);
        }
        elseif($request->page == 'contact3.html') {
               $google_api_key= getenv('GOOGLE_API_KEY');
               $get_file->find('div[class=contact-address]', 0)->innertext = '';
    
               $get_file->find('div[class=contact-address]', 0)->innertext =  '<section class="map"><iframe width="600" height="450" frameborder="0" style="border:0"
                  src="https://www.google.com/maps/embed/v1/place?key='.$google_api_key.'
                    &q='.$siteData->business_address.'" allowfullscreen>
                </iframe></section>';

               file_put_contents('./elements/'.$request->page, $get_file);
        }
    }
}
