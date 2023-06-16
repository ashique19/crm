<?php

namespace App\Http\Controllers\Account\Setting;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        $nextBillignDate = \Cache::remember(
            'next_billing_date_for_' . $user->id, 60, function () use ($user) {

                if(config('saas.payment_gateway', '') == 'stripe') {
                    if ($sub = Auth::user()->subscription('main') != null) {
                        $sub = Auth::user()->subscription('main')->asStripeSubscription();
                        return Carbon::createFromTimeStamp($sub->current_period_end)->format('Y-m-d');
                    }
                }
                if(config('saas.payment_gateway', '') == 'braintree') {
                    if ($sub = Auth::user()->subscription('main') != null) {

                        $sub = Auth::user()->asBraintreeCustomer();

                        $endDate = $sub->paymentMethods[0]->subscriptions[0]->billingPeriodEndDate;

                        return $endDate->format('Y-m-d');
                    }
                }
                return "";
            }
        );


        $invoices = \Cache::remember(
            'invoices_for_ll' . $user->id, 0, function () use ($user) {
                try {
                    return $user->invoicesIncludingPending();
                }catch (\Exception $exception){
                    return [];
                }
            }
        );
        return view('account.settings.index')->with('next_billing_date', $nextBillignDate)->with('invoices', $invoices);
    }

    public function downloadInvoice($invoiceId)
    {

        $user = Auth::user();

        return $user->downloadInvoice(
            $invoiceId, [
            'product' => config('saas.braintree_invoice.product'),
            'header' => '',
            'vendor' => config('saas.braintree_invoice.vendor')
            ]
        );

    }
}
