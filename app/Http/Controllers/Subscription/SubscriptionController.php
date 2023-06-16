<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Models\Plan;
use App\Models\User;
use App\Services\PlansService;
use App\Services\SaasApplicationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class SubscriptionController extends Controller
{
    private $planSservice;

    private $saasService;

    public function __construct(PlansService $plansService, SaasApplicationService $saasService)
    {
        $this->plansService = $plansService;
        $this->saasService = $saasService;
    }

    public function index(Request $request)
    {
        $countries = DB::table('countries')->get();
        $cities    = DB::table('cities')->limit(5)->get();
        $plans     = Plan::active()->get();
        
        $plan_type = $request->query('plan')?$request->query('plan'):$plans[0]['slug'];
        
        return view('subscription.index', compact('plans', 'plan_type', 'countries', 'cities'));
    }


    /**
     * Store account in application
     *
     * @param  SubscriptionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SubscriptionStoreRequest $request)
    {
        $company_name   = $request->get('company_name');
        $user_email     = $request->get('user_email');
        $user_password  = $request->get('user_password');
        $phone          = $request->get('phone');
        $address        = $request->get('address');
        $country        = $request->get('country');
        $city           = $request->get('city');
        $state          = $request->get('state');
        $sub_total      = $request->get('sub_total');
        $payment_type   = $request->get('payment_type');
        $user_name      = $request->get('user_name').' '.$request->get('last_name'); 
        $user_data      = [
                            "email"        => $user_email,
                            "phone"        => $phone,
                            "address"      => $address,
                            "country"      => $country,
                            "city"         => $city,
                            "state"        => $state,
                            "payment_type" => $payment_type,
                            "company_name" => $company_name,
                            "name"         => $user_name,
                            "password"     => bcrypt($user_password),
                            'api_token'    => Str::random(60),
                            ];       
        
        if(!Auth::user()) {
            $user = User::create($user_data);
            \Auth::login($user);
        }
        
        $user = Auth::user();

        $plan = $this->plansService->getByGateway($request->get('plan'));       

        $subscription = $request->user()->newSubscription('main', $request->plan);

        if ($request->has('coupon')) {
            $subscription->withCoupon($request->coupon);
        }

        try{
            if(config('saas.payment_gateway') == 'stripe') {
                $subscription->create($request->token);
            }else{
                $subscription->create($request->payment_method_nonce);
            }

        }catch (\Exception $exception){

            flash(trans($exception->getMessage()))->warning();
        }
        if ($user->subscribed('main')) {
            $user->activated = '1';
            $user->save();
        }
        return redirect(route('account.dashboard'));
        
    }

    public function validate_email(Request $request)
    {
        if($request->email) {
            if(!$this->valid_email($request->email)) {
                return response()->json(['data'=>'user_email_exist','validator'=>'Invalid email address.']);
            }else{
                $user = User::where('email', $request->email)->first();
                if ($user === null) {
                    return response()->json(['data'=>'user_email_exist','validator'=>'Email Available']);
                }else{
                    return response()->json(['data'=>'user_email_exist','validator'=>'Email has already been taken, please choose a different email.']);
                }
            }
        }
    }
    public function valid_email($str)
    {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
    }
}