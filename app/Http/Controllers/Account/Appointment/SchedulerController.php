<?php

namespace App\Http\Controllers\Account\Appointment;

use App\Models\Appointment;
use App\Models\AppointmentAvailability;
use App\Models\AppointmentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Mail;

class SchedulerController extends Controller
{
    public function index()
    {
        $user_id                    = Auth::user()->id;
        $today_date                 = date('Y-m-d');
        $appointment_availability   = AppointmentAvailability::select('*')->where('user_id', $user_id)->get();
        $appointment_services       = AppointmentService::select('*')->where('user_id', $user_id)->get();
        $appointments               = Appointment::select('appointment_availability_id')->groupBy('appointment_availability_id')->where('user_id', $user_id)->get();
        $appointment_avails         = $this->getAvailableDate($today_date);
        return view('account.appointments.scheduler', compact('appointment_services', 'appointment_availability', 'appointment_avails'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
            'appointment_availability' => 'required',
            'appointment_service'      => 'required',
            'first_name'               => 'required',
            'email'                    => 'required_without:phone',
            'phone'                    => 'required_without:email',
            ], [
            'appointment_availability.required' => 'Available Slots is required ',
            'appointment_service.required'      => 'Service is required'
            ]
        );

        if($request->sms_notification=='1') {
            $sms_notification = 1;
        }else{
            $sms_notification = 0;
        }
        if($request->email_notification=='1') {
            $email_notification = 1;
        }else{
            $email_notification = 0;
        }
        $appointment = New Appointment;
        $appointment->user_id                       = Auth::user()->id;
        $appointment->appointment_availability_id   = $request->appointment_availability;
        $appointment->appointment_service_id        = $request->appointment_service;
        $appointment->appointment_type              = $request->appointment_type;
        $appointment->first_name                    = $request->first_name;
        $appointment->last_name                     = $request->last_name;
        $appointment->email                         = $request->email;
        $appointment->phone                         = $request->phone;
        $appointment->sms_notification              = $sms_notification;
        $appointment->email_notification            = $email_notification;
        $appointment->active                        = 1;
        
        $appointment_id = $appointment->save();
        if(!empty($request->email)) {

            $this->sendUpdatedMail($appointment->id);
        }
        if (!empty($appointment_id)) {
            return redirect()->route('account.appointments.scheduler')->with('success_msg', 'Appointment successfully created.');
        }
    }
    public function update_scheduler(Request $request)
    {
        $appointment = Appointment::find($request->apmnt_id);
        $appointment->sms_notification = (int)$request->sms_notification;
        $appointment->email_notification = (int)$request->email_notification;
        $appointment->appointment_type = (int)$request->appointment_type;
        $appointment->save();
        return response()->json(array('data'=> $appointment), 200);
    }
    public function sendUpdatedMail($appointment_id)
    {
        $appointment     = Appointment::with(['appointment_services','appointment_avail'])->find($appointment_id);
        $appointment->appointment_types = ['1'=>'In-person','2'=>'Webcam','3'=>'Phone','4'=>'Messaging']; 
        
        Mail::send(
            'emails.appointment_confirmation', ['data'=>$appointment], function ($message) use ($appointment) {
                $message->to($appointment->email, $appointment->first_name.' '.$appointment->last_name)->subject('Appointment Added');
            }
        );

        return "Sent";
    }
    public function schedulers(Request $request)
    {
        
        $user_id              = Auth::user()->id;
        $date                   = $request->date;
        $service_id           = $request->service_id;
        $appointment_service  = AppointmentService::find($service_id);
        $appointment_avails   = AppointmentAvailability::select('*')->whereDate('availability', $date)->where(['user_id'=>$user_id])->with(
            ['appointments'=> function ($query) use ($service_id,$user_id) {
                $query->where(['appointments.appointment_service_id'=>$service_id,'appointments.user_id'=>$user_id]);
            },'appointments.appointment_services','appointments.profile']
        )->get();
        $btn_class            = $request->btn_class;
       
        return view('account.appointments.schedulers', compact('appointment_avails', 'btn_class', 'service_id', 'appointment_service'));
    }

    public function appointments_avail(Request $request)
    {
        $appointment_avails     = $this->getAvailableDate($request->date);
        $date = $request->date;
        return view('account.appointments.availability_list', compact('appointment_avails', 'date'));
    }

    public function appointments_calendar(Request $request)
    {
        return view('account.appointments.calendar');
    }


    
    public function getAvailableDate($date)
    {
        $user_id                    = Auth::user()->id;
        $appointments               = Appointment::select('appointment_availability_id')->groupBy('appointment_availability_id')->where('user_id', $user_id)->get();

        if($appointments) {
            $avail_ids = [];
            foreach ($appointments as $key => $appointment) {
                $avail_ids[] = $appointment->appointment_availability_id;
            }
            $appointment_avails         = AppointmentAvailability::select('*')->whereDate('availability', $date)->whereNotIn('id', $avail_ids)->get();
        }else{
            $appointment_avails = [];
        }
        return $appointment_avails;
    }

    public function getAllSchedulers(Request $request)
    {
        
        $user_id              = Auth::user()->id;
        $date                 = $request->date;
        $appointment_avails   = AppointmentAvailability::select('*')->whereDate('availability', $date)->where(['user_id'=>$user_id])->with(
            ['appointments'=> function ($query) use ($user_id) {
                $query->where(['appointments.user_id'=>$user_id]);
            },'appointments.appointment_services','appointments.profile']
        )->get();

        return view('account.appointments.schedulers', compact('appointment_avails'));
    }
}