<?php
namespace App\Http\Controllers\Account\Appointment;
use App\Models\Appointment;
use App\Models\AppointmentAvailability;
use App\Models\AppointmentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;

class OverviewController extends Controller
{
    public function index()
    {
        $user_id                  = Auth::user()->id;
        $appointments             = Appointment::select('*')->where(['user_id'=>$user_id])->with(['appointment_services'])->get();
        $appointment_availability = AppointmentAvailability::select('*')->where(['user_id'=>$user_id])->get();

        $appointment_service      = AppointmentService::select('*')->where(['user_id'=>$user_id])->get();
        $appointment_type         = ['1'=>'In-person','2'=>'Webcam','3'=>'Phone','4'=>'Messaging'];
        return view('account.appointments.overview', ['appointments'=>$appointments,'appointment_type'=>$appointment_type,'appointment_service'=>$appointment_service,'appointment_availability'=>$appointment_availability]);
    }

    public function getAppointmentById(Request $request)
    {
        $user_id          = Auth::user()->id;
        $appointments     = Appointment::select('*')->where(['user_id'=>$user_id,'id'=>$request->id])->with(['appointment_services'])->first();
        return response()->json(array('data'=> $appointments), 200);
    }

    public function updateAppointment(Request $request)
    {
        $appointment                               = Appointment::find($request->appmt_id);
        $appointment->first_name                   = $request->first_name;
        $appointment->last_name                    = $request->last_name;
        $appointment->email                        = $request->email;
        $appointment->phone                        = $request->phone;
        $appointment->appointment_availability_id  = $request->availability;
        $appointment->appointment_service_id       = $request->service;
        $appointment->appointment_type             = $request->type;
        $appointment->active                       = $request->active;
        $mail_data                                 = $appointment;

        $appointment->save();
        
        if($appointment->email) {
            $this->sendUpdatedMail($request->appmt_id);
        }
        
        if($request->has('redirect')) {
            return redirect()->route('account.appointments.calendar')->with('alert-success', 'Appointment Updated!');
        }else{
             return redirect()->route('account.appointments.overview')->with('alert-success', 'Appointment Updated!');
        }
    }

    public function sendUpdatedMail($appointment_id)
    {
        $appointment     = Appointment::with(['appointment_services','appointment_avail'])->find($appointment_id);
        $appointment->appointment_types = ['1'=>'In-person','2'=>'Webcam','3'=>'Phone','4'=>'Messaging'];
        Mail::send(
            'emails.appointment_update', ['data'=>$appointment], function ($message) use ($appointment) {
                $message->to($appointment->email, $appointment->first_name.' '.$appointment->last_name)->subject('Appointment Updated');
            }
        );

        return "Sent";
    }

    public function change_status(Request $request, $id)
    {
        $appointment             = Appointment::find($id);
        $appointment->active     = $appointment->active==1?0:1;
        $appointment->save();
        return redirect()->route('account.appointments.overview')->with('alert-success', 'Appointment Status Updated!');
    }

    public function deleteAppointmentById(Request $request)
    {
        if($request->action == 'apmt_delete' && $request->id) {
            $appointment             = Appointment::find($request->id);
            $appointment->delete();
            return response()->json(array('msg'=> 'Data deleted','status'=>'success'), 200);
        }
    }

    public function addAppointment(Request $request)
    {
        $appointment                               = new Appointment();
        $appointment->first_name                   = $request->first_name;
        $appointment->last_name                    = $request->last_name;
        $appointment->email                        = $request->email;
        $appointment->phone                        = $request->phone;
        $appointment->appointment_availability_id  = $request->availability;
        $appointment->appointment_service_id       = $request->service;
        $appointment->appointment_type             = $request->type;
        $appointment->active                       = 1;
        $appointment->user_id                      = \Auth::user()->id;
        $mail_data                                 = $appointment;

        $appointment->save();
        
        $this->sendUpdatedMail($appointment->id);
        
        if($request->has('redirect')) {
            return redirect()->route('account.appointments.calendar')->with('alert-success', 'Appointment Added!');
        }else{
             return redirect()->route('account.appointments.overview')->with('alert-success', 'Appointment Added!');
        }
    }
}