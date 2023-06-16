<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentAvailability;
use App\Models\AppointmentService;
use App\Models\User;
use Storage;
use Auth;

class AppointmentController extends Controller
{
    public $status = 200;
    public function appointments(Request $request)
    {
        $token              = $request->header('php-auth-user');
        if($token) {
            $user           = User::where('api_token', $token)->first();
            if($user) {
                $validator  =   Validator::make(
                    $request->all(), [
                    'appointment_availability_id' => 'required|integer',
                    'appointment_service_id'       => 'required|integer',
                    'appointment_type'               => 'required|integer|between:1,4',
                    'first_name'                   => 'required',
                    'last_name'                   => 'required',
                    'email'                       => 'required|email',
                    'phone'                       => 'required',
                    'email_notification'           => 'required',
                    'sms_notification'               => 'required',
                                   ]
                );
                    
                if($validator->fails()) {
                       return response()->json($validator->messages()->first(), $this->status);
                }else{
                    $appointment                              = new Appointment;
                       
                    $appointment->user_id                       = $user->id;
                    $appointment->appointment_availability_id = $request->appointment_availability_id;
                    $appointment->appointment_service_id       = $request->appointment_service_id;
                    $appointment->appointment_type               = $request->appointment_type;
                    $appointment->first_name                   = $request->first_name;
                    $appointment->last_name                   = $request->last_name;
                    $appointment->email                       = $request->email;
                    $appointment->phone                       = $request->phone;
                    $appointment->email_notification           = $request->email_notification;
                    $appointment->sms_notification            = $request->sms_notification;
                    
                    $appointment->save();
                    $appointments                             = Appointment::where('user_id', $user->id)->orderBy('id', 'desc')->get();
                    return response()->json($appointments, $this->status);
                }
                
            }else{
                return response()->json("Token is invalid", $this->status);
            }
        }else{
            return response()->json("Token is required", $this->status);
        }
    }
    public function availabilities(Request $request)
    {
        $token                     = $request->header('php-auth-user');
        if($token) {
            $user                  = User::where('api_token', $token)->first();
            if($user) {
                $appointment_ids   = Appointment::select('appointment_availability_id')->where('user_id', $user->id)->get();
                $plucked            = $appointment_ids->pluck('appointment_availability_id')->all();
                $availabilities    = AppointmentAvailability::whereNotIn('id', $plucked)->where('user_id', $user->id)->get();
                return response()->json($availabilities, $this->status);
            }else{
                return response()->json("Token is invalid", $this->status);
            }
        }else{
            return response()->json("Token is required", $this->status);
        }
    }
    public function services(Request $request)
    {
        $token             = $request->header('php-auth-user');
        if($token) {
            $user          = User::where('api_token', $token)->first();
            if($user) {
                $services = AppointmentService::where('user_id', $user->id)->get();
                return response()->json($services, $this->status);
            }else{
                return response()->json("Token is invalid", $this->status);
            }
        }else{
            return response()->json("Token is required", $this->status);
        }
    }
}