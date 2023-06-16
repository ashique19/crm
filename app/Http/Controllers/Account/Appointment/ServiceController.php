<?php

namespace App\Http\Controllers\Account\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentService;
use App\Models\Appointment;
use Auth;

class ServiceController extends Controller
{

    public function index()
    {
        $user_id                = Auth::user()->id;
        $appointment_services   = AppointmentService::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        return view('account.appointments.services', compact('appointment_services'));
    }

    public function store(Request $request)
    {
        $user_id                    = Auth::user()->id;
        $service                    = new AppointmentService;

        $service->user_id           = $user_id;
        $service->name              = $request->name;
        $service->description       = $request->description;
        $service->duration          = $request->duration;
        $service->amount            = $request->amount;
        $service->appointment_types = !empty($request->appointment_types)?json_encode($request->appointment_types):'';
        $service->color             = $request->color;
        $service->active            = 1;
           $service                 = $service->save();

        if (!empty($service)) {
            return redirect()->route('account.appointments.services')->with('success_msg', 'Service Created');
        }
    }

    public function getServiceById(Request $request)
    {
        $user_id     = Auth::user()->id;
        $service     = AppointmentService::select('*')->where(['user_id'=>$user_id,'id'=>$request->id])->first();
        if(!empty($service->appointment_types)) {
            $type                       = implode(',', json_decode($service->appointment_types));
            $service->appointment_types = $type;
        }else{
            $service->appointment_types = '';
        }

        return response()->json(array('data'=> $service), 200);
    }

    public function updateService(Request $request)
    {
        
        $service                    = AppointmentService::findOrFail($request->id);
        $service->name              = $request->name;
        $service->description       = $request->description;
        $service->duration          = $request->duration;
        $service->amount            = $request->amount;
        $service->appointment_types = !empty($request->appointment_types)?json_encode($request->appointment_types):'';
        $service->color             = $request->color;
        $service->save();

        return redirect()->route('account.appointments.services')->with('success_msg', 'Service Updated!');
    }

    public function change_status(Request $request, $id)
    {
        $service          = AppointmentService::find($id);
        $service->active  = $service->active==1?0:1;
        $service->save();

        return redirect()->route('account.appointments.services')->with('success_msg', 'Service Status Updated!');
    }

    public function deleteServiceById(Request $request)
    {
        if($request->action == 'service_delete' && $request->id) {
            $service = AppointmentService::find($request->id);
            $service->delete();
            return response()->json(array('msg'=> 'Data deleted','status'=>'success'), 200);
        }
    }
}