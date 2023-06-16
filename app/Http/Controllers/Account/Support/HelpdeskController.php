<?php

namespace App\Http\Controllers\Account\Support;

use App\Models\Category;
use App\Models\KnowledgeBase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use Auth;

class HelpdeskController extends Controller
{

    public function index()
    {    
        $categories         = Category::active()->withCount('knowledge')->get();          
        $knowledgebase      = KnowledgeBase::active()->get();             
        $user               = Auth::user();
        $name               = explode(' ', $user->name);
        
        $user->first_name   = $name[0];
        $user->last_name    = isset($name[1])?$name[1]:'';
        
        return view('account.support.helpdesk', compact('knowledgebase', 'categories', 'user'));
    }

    public function submitQuery(Request $request)
    {
        $support                 = [];
        $support['first_name']  = $request->first_name;
        $support['last_name']   = $request->last_name;
        $support['subject']     = $request->subject;
        $support['message']     = $request->message;
        $support['email']       = env('SUPPORT_EMAIL');
        $query = "SELECT value FROM `settings` WHERE `key` LIKE '%site.contact_form_email%'";
        $row = DB::select($query);
        if($row) {
            $email = $row[0]->value;
            $support['email'] = $email;
            Mail::send(
                'emails.submit_query', ['data'=>$support], function ($message) use ($support) {
                    $message->to($support['email'], $support['first_name'].' '.$support['last_name'])->subject('Support Query');
                }
            );
            flash('Support Query Sent Successfully.');
            return redirect()->back()->with('success', 'We have recieved your message. We will respond shortly.');

        }else{
            flash('Support Query Was Not Sent Successfully.');
            return redirect()->back()->with('success', 'There was an error sending this message. Please try again.');
        }
    }

}
