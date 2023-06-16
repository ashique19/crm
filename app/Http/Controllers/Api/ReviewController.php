<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\AppointmentReview;
use App\Models\User;
use Auth;

class ReviewController extends Controller
{
    public $status = 200;
    public function index(Request $request)
    {
        $token   = $request->header('php-auth-user');
        
        if($token) {
            $user    = User::where('api_token', $token)->first();
            if($user) {
                $validator =    Validator::make(
                    $request->all(), [
                                        'appointment_id' => 'required|integer',
                                        'rating'         => 'required|integer|between:1,5',
                                        'review'         => 'required',
                                    ]
                );
                    
                if($validator->fails()) {
                    return response()->json($validator->messages()->first(), $this->status);
                }else{
                    $review                  = new AppointmentReview;
                    $review->user_id         = $user->id;
                    $review->appointment_id  = $request->appointment_id;
                    $review->rating          = $request->rating;
                    $review->review          = $request->review;
                    
                    $review->save();
                    $reviews = AppointmentReview::where('user_id', $user->id)->orderBy('id', 'desc')->get();
                    
                    return response()->json($reviews, $this->status);
                }
            }else{
                return response()->json("Token is invalid", $this->status);
            }
        }else{
            return response()->json("Token is required", $this->status);
        }
    }
}