<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\WebsiteLead;
use App\Models\Website;
use App\Models\User;
use Storage;
use Auth;

class LeadController extends Controller
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
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'notes' => 'required',
                    'conversion_point' => 'required',
                                   ]
                );
                    
                if($validator->fails()) {
                       return response()->json($validator->messages()->first(), $this->status);
                }else{
                    $website = Website::where('user_id', $user->id)->first();
                    if($website) {
                        $lead      = new WebsiteLead;
                        $lead->website_id         = $website->id;
                        $lead->user_id             = $user->id;
                        $lead->first_name         = $request->first_name;
                        $lead->last_name         = $request->last_name;
                        $lead->email             = $request->email;
                        $lead->phone             = $request->phone;
                        $lead->notes             = $request->notes;
                        $lead->status             = '1';
                        $lead->conversion_point = $request->conversion_point;
                        $lead->save();
                        $leads   = WebsiteLead::where('website_id', $website->id)->get();
                        return response()->json($leads, $this->status);
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