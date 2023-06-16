<?php

namespace App\Http\Controllers\Frontend;

use Session;
use App\Http\Controllers\Controller;
use App\Models\Admin\Lead;
use App\Models\Admin\Package;
use Illuminate\Http\Request;


class CtaController extends Controller
{
    public function storeLead(Request $request)
    {

        $request->validate(
            [
            'email' => 'required|email|unique:leads,email'
            ]
        );

        $data = [
            'email' => $request->email,
            'conversion_point' => $request->conversion_point
        ];

        $lead = Lead::create($data);
        $request->request->add(
            [
            'user_email' => $request->email,
            'user_email_confirmation' => $request->email
            ]
        );
        return redirect()->route('subscription.index')->withInput();

        if ($lead) {
            \Session::put('cta_lead', $lead);
            $package = Package::first();
            if($package->disable_payment==1) {
                return redirect()->route('contact')->withInput();
            } else {
                return redirect()->route('subscription_pay_page')->withInput();
            }
        } else {
            return redirect()->back();
        }
    }

    public function updateLead(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $lead = \Session::get('cta_lead');

        $lead->update($request->all());

        \Session::put('cta_lead', $lead);
    }
}
