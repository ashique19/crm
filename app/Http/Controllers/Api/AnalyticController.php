<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\User;
use App\Models\WebsiteAnalytic;
use Storage;
use Auth;

class AnalyticController extends Controller
{
    public $status = 200;
    public function index(Request $request)
    {
        $token   = $request->header('php-auth-user');
        if($token) {
            $user    = User::where('api_token', $token)->first();
            
            if($user) {
                $validator = Validator::make(
                    $request->all(), [
                    'url' => 'required|url',
                    'referrer' => 'required',
                    'ip' => 'required|ip',
                    'device' => 'required',
                    'device_version' => 'required',
                    'browser' => 'required',
                    'browser_version' => 'required',
                                   ]
                );
                    
                if($validator->fails()) {
                       return response()->json($validator->messages()->first(), $this->status);
                }else{
                    $website = Website::where('user_id', $user->id)->first();
                    if($website) {
                        $analytic                      = new WebsiteAnalytic;
                        $analytic->website_id         = $website->id;
                        $analytic->user_id             = $user->id;
                        $analytic->url                 = $request->url;
                        $analytic->referrer         = $request->referrer;
                        $analytic->ip                 = $request->ip;
                        $analytic->device             = $request->device;
                        $analytic->device_version     = $request->device_version;
                        $analytic->browser             = $request->browser;
                        $analytic->browser_version     = $request->browser_version;
                        $analytic->save();
                        $analytics                   = WebsiteAnalytic::where('website_id', $website->id)->orderBy('id', 'desc')->get();
                        return response()->json($analytics, $this->status);
                    }else{
                        return response()->json("Website not found !", $this->status);
                    }
                }
                
            }else{
                return response()->json("Token is invalid", $this->status);
            }
        }else{
            return response()->json("Token is required", $this->status);
        }
    }
}