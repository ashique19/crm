<?php
namespace App\Http\Requests\Account;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
class ChangeEmailAccountPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check());
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }
}
