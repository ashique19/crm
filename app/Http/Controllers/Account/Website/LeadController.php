<?php

namespace App\Http\Controllers\Account\Website;

use App\Http\Controllers\Controller;
use App\Repositories\WebsiteLeadRepository as WebsiteLeadRepository;
use Illuminate\Http\Request;
use App\Models\WebsiteLead;
use App\Models\Website;
use Storage;
use Auth;

class LeadController extends Controller
{

    public function index()
    {
        $user_id        = Auth::user()->id;
        $website        = Website::where('user_id', $user_id)->firstOrFail();
        $leads          = WebsiteLead::where('website_id', $website->id)->get();
        $new_c_count    = WebsiteLead::where(['website_id'=>$website->id,'status'=>'0'])->count();
        $client_count   = WebsiteLead::where(['website_id'=>$website->id,'status'=>'1'])->count();
        $inacv_c_count  = WebsiteLead::where(['website_id'=>$website->id,'status'=>'2'])->count();
        $status         =   [
                                ['name'=>'New Lead','count'=>$new_c_count],
                                ['name'=>'Client','count'=>$client_count],
                                ['name'=>'Inactive Client','count'=>$inacv_c_count]
                            ];
        return view('account.website.leads', compact('leads', 'status'));
    }

    public function addLead(Request $request)
    {
        $user_id                = Auth::user()->id;
        $website                = Website::where('user_id', $user_id)->firstOrFail();
        $lead                   = new WebsiteLead;
        $lead->user_id          = Auth::user()->id;
        $lead->website_id       = $website->id;
        $lead->first_name       = $request->first_name;
        $lead->last_name        = $request->last_name;
        $lead->notes            = $request->notes;
        $lead->phone            = $request->phone;
        $lead->email            = $request->email;
        $lead->conversion_point = $request->conversion_point;
        $lead->status           = $request->status;   
        $lead_id = $lead->save();
        if (!empty($lead_id)) {
            return redirect()->route('account.website.leads')->with('success_msg', 'Lead Created');
        }
    }
    public function updateLead(Request $request)
    {
        $user_id                = Auth::user()->id;
        $lead                   = WebsiteLead::findOrFail($request->id);
        $lead->first_name       = $request->first_name;
        $lead->last_name        = $request->last_name;
        $lead->notes            = $request->notes;
        $lead->phone            = $request->phone;
        $lead->email            = $request->email;
        $lead->conversion_point = $request->conversion_point;
        $lead->status           = $request->status;
        $lead                   = $lead->save();
        if (!empty($lead)) {
            return redirect()->back()->with('success_msg', 'Lead Updated');
        }
    }
    public function getLeadById(Request $request)
    {
        $id= $request->id;
        $WebsiteLead     = new WebsiteLeadRepository();
        $val = $WebsiteLead->getLeadById($id);
        return response()->json(array('data'=> $val->original), 200);
    }
    public function deleteLeadById(Request $request)
    {
        if($request->action == 'lead_delete' && $request->id) {
            $lead = WebsiteLead::findOrFail($request->id);
            $lead->delete();
            return response()->json(array('msg'=> 'Data deleted','status'=>'success'), 200);
        }
    }
    public function change_status(Request $request, $blog_id)
    {
        $lead          = WebsiteLead::findOrFail($blog_id);
        $lead->status  = $lead->status==1?0:1;
        $lead->save();
        return redirect()->route('account.website.leads')->with('success_msg', 'Lead Status Updated!');
    }

}
