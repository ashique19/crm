<?php

namespace App\Http\Controllers\Account\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppointmentReview;
use Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $user_id              = Auth::user()->id;
        $appointment_reviews = AppointmentReview::where('user_id', $user_id)->where('active', 1)->with(['appointment.appointment_services','appointment.appointment_avail'])->get();
        
        return view('account.appointments.reviews', compact('appointment_reviews'));
    }

}
