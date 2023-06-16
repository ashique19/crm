<?php

namespace App\Http\Requests\Subscription;

use Illuminate\Validation\Rule;
use App\Rules\ValidStripeCoupon;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'plan' => [
                'required',
                Rule::exists('plans', 'gateway_id')->where('active', true),
            ],
            'coupon' => ['nullable', new ValidStripeCoupon()],
            'company_name' => 'required',
            'user_email' => 'required|email|unique:users,email|confirmed',
            'user_password' => 'required|confirmed',
            'user_name' =>  'required',
            'last_name' =>  'required',
            'phone' =>  'required',
            'address' =>  'required',
            'city' =>  'required',
            'state' =>  'required',
            'country' =>  'required',
            'accept' =>  'required',
        ];
    }
    public function messages()
    {
        return [
            'user_name.required' => 'The first name field is required.',
            'user_email.required' => 'The email field is required.',
            'user_password.required' => 'The password field is required.',
        ];
    }
}