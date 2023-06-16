<?php
namespace App\Http\Controllers\Account\Appointment;

use App\Models\Appointment;
use App\Models\AppointmentAvailability;
use App\Models\AppointmentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $appointment_availability = AppointmentAvailability::where('user_id', \Auth::user()->id)->with(['appointments','appointments.appointment_services'])->get();

        $appointment_services     = AppointmentService::where('user_id', \Auth::user()->id)->get();
        $appointments             = Appointment::select('*')->where('user_id', \Auth::user()->id)->with(['appointment_services','appointment_avail'])->get();
        return view('account.appointments.calendar', compact('appointment_availability', 'appointment_services', 'appointments'));
    }
    public function event(Request $request)
    {
        $appointment_availability = AppointmentAvailability::all();
        $appointment_services     = AppointmentService::all();

        $appointment              = Appointment::where('appointments.id', $request->id)->select('*')->with(['appointment_services','appointment_avail'])->first();

        return view("account.appointments.appointment", compact('appointment', 'appointment_availability', 'appointment_services'))->render();
    }
    public function eventAdd(Request $request)
    {   
        $appointment_availability_id = $request->id;
        $appointment_availability    = AppointmentAvailability::all();
        $appointment_services        = AppointmentService::all();
        
        return view("account.appointments.appointment_add", compact('appointment_availability_id', 'appointment_services', 'appointment_availability'))->render();
    }
}
