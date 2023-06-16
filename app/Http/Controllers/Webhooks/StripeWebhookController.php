<?php

namespace App\Http\Controllers\Webhooks;

use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use App\Models\User;
use Laravel\Cashier\Subscription;
use Laravel\Cashier\Http\Controllers\WebhookController;
use Carbon\Carbon;
use Mail;

class StripeWebhookController extends WebhookController
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();
        
        if(!isset($payload['type'])) {
            return response('Webhook Validation Failed!', 422);
        };

        switch ($payload['type']) {
        case 'invoice.payment_failed':
            return $this->handlePaymentFailed($payload);
           /* case 'customer.subscription.deleted':
                return $this->handleSubscriptionDeleted($payload);
            case 'invoice.payment_succeeded':
                return $this->handleSubscriptionRenewed($payload);*/
        default:
            return response();
        }
    }
    
    protected function handlePaymentFailed($payload)
    {
        if($payload['data']['object']['customer_email']) {
            $email          = $payload['data']['object']['customer_email'];
            $user           = User::where('email', $email)->first();
            if($user) {
                $subscription               = Subscription::where('user_id', $user->id)->first();
                if($subscription) {
                    $subscription->ends_at  = Carbon::now()->toDateTimeString();
                    $subscription->save();
                    $subscription->user     = $user;
                    Mail::send(
                        'emails.payment_failure', ['data'=>$subscription], function ($message) use ($subscription) {
                            $message->to($subscription->user->email, $subscription->user->first_name.' '.$subscription->user->last_name)->subject('Payment Failed!');
                        }
                    );
                    return response('Webhook Handled!', 200);
                }else{
                    return response('Subscription Not Found!', 200);
                }
            }else{
                return response('User Not Found!', 200);
            }
        }else{
            return response('Webhook Not Handled!', 200);
        }
    }
    /* protected function handleSubscriptionDeleted($payload)
    {
        $gatewayId = $payload['data']['object']['id'];

        $subscription = $this->subscription->where('gateway_id', $gatewayId)->first();

        if ($subscription && ! $subscription->cancelled()) {
            $subscription->markAsCancelled();
        }

        return response('Webhook Handled', 200);
    }

    protected function handleSubscriptionRenewed($payload)
    {
        $gatewayId = $payload['data']['object']['subscription'];

        $subscription = $this->subscription->where('gateway_id', $gatewayId)->first();

        if ($subscription) {
            $stripeSubscription = $this->gateway->subscriptions()->find($subscription);
            $subscription->fill(['renews_at' => $stripeSubscription['renews_at']])->save();
        }

        return response('Webhook Handled', 200);
    }*/
    
}
