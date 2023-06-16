<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\WebsiteLead;
use App\Models\AppointmentAvailability;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Account\PasswordUpdated;
use App\Http\Requests\Account\PasswordStoreRequest;
use App\Repositories\WebsiteLeadRepository as WebsiteLeadRepository;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use DateInterval;
use DatePeriod;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {    
        /*For Recent Appointment */
        $user_id          = Auth::user()->id;
        $appointments     = Appointment::select('*')->where(['user_id'=>$user_id])->with(['appointment_avail'])->orderby('id', 'desc')
            ->first();

        /*For Recent Website lead */
        $lead = WebsiteLead::orderby('id', 'desc')
            ->limit(1)
            ->first();
        $appointment_availability     = AppointmentAvailability::select('*')->where(['user_id'=>$user_id])->get();

        /*For Upcoming appointments */
        $currentDate = \Carbon\Carbon::now();
        $now =date('Y-m-d h:i:s', strtotime($currentDate));
        $next_7_days = $currentDate->addDays(7);
        $next_7 =date('Y-m-d h:i:s', strtotime($next_7_days));
    
        $upcoming_apptmt = Appointment::select('*')->where(['user_id'=>$user_id])->with(['appointment_avail'])                ->whereHas(
            'appointment_avail', function ($q) use ($now , $next_7) {
                $q->whereBetween('availability', [$now,$next_7]);
            }
        )
                            ->limit(10)
                            ->get()->sortByDesc('appointment_avail.availability');       

         $user_created_date = User::where('id', $user_id)->first();
         $to = now()->todatestring();
         $to = new Carbon($to);
         $from =  $user_created_date->created_at->todatestring();
         $from =  new Carbon($from);
         $start    = (new DateTime($from))->modify('first day of this month');
         $end      = (new DateTime($to))->modify('first day of next month');
         $interval = DateInterval::createFromDateString('1 month');
         $interval2 = DateInterval::createFromDateString('1 year');
         $period   = new DatePeriod($start, $interval, $end);
         $period2   = new DatePeriod($start, $interval2, $end);
        
        foreach ($period as $dt) {
            $lists[] = $dt->format("F Y");
            $lists1[] = $dt->format("Y-m-d");
        }
        $lists= array_reverse($lists);
        $lists1= array_reverse($lists1);
        foreach ($period2 as $year) {
           
            $areaData[] = ['y'=>$year->format("Y") ,'a'=>0,'b'=> 0, 'c'=>0];
         
        } 
       
        $countValues = $this->getCounts($lists[0], false);
        if ($upcoming_apptmt == '[]') {
            $upcoming_apptmt=null;
        }else{
            $upcoming_apptmt=$upcoming_apptmt;
        }

        return view('account.dashboard', ['appointments' => $appointments, 'lead'=>$lead, 'up_cmg_appmt'=>$upcoming_apptmt,'appointment_availability'=>$appointment_availability,'lists'=>$lists,'lists1'=>$lists1,'countValues'=>$countValues,'areaData'=>json_encode($areaData),'type'=>'dashboard']);
    }
    public function appointment_data(Request $request)
    {
         $id = $request->input('id');
         $data= Appointment::where('id', $id)->first();
         return response()->json(['data'=>$data]);
    }
    
    public function appointment_update(Request $request)
    {
        $appointment             = Appointment::find($request->appmt_id);
        $appointment->first_name = $request->first_name;
        $appointment->last_name  = $request->last_name;
        $appointment->active     = $request->active;
        $appointment->appointment_type                = $request->appointment_type;
        $appointment->appointment_availability_id  = $request->availability;
        $appointment->save();
        return redirect()->route('account.dashboard')->with('alert-success', 'Appointment Updated!');
    }
    public function all_record(Request $request)
    {
        $date = $request->input('selected_date');
        $data = $this->getCounts($date, true);
        return response()->json($data);
    }
    public function getCounts($date,$json = true)
    {
        $current = now()->todatestring();
        $current2 = new Carbon($date);
        $selected = $current2->format("Y-m-01");
        $start_date = new Carbon($date);
        $selected       = $start_date->format("Y-m-d");

        $appointmentsbooked =DB::select("SELECT count(*) as total FROM appointments  WHERE date(created_at) BETWEEN '".date($selected)."' AND '".date($current)."' AND user_id = '".Auth::user()->id."' ");
        $leadsReceived =DB::select(" SELECT count(*) as total FROM website_leads WHERE date(created_at) BETWEEN '".date($selected)."' AND '".date($current)."' AND user_id = '".Auth::user()->id."' ");
        $uniqueVisitors =DB::select("SELECT count(DISTINCT ip) as total FROM website_analytics  WHERE date(created_at) BETWEEN '".date($selected)."' AND '".date($current)."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')");
        $newclients = DB::select("SELECT count(*) as total FROM appointments  WHERE date(created_at) BETWEEN '".date($selected)."' AND '".date($current)."' AND user_id = '".Auth::user()->id."' AND email NOT IN (SELECT email FROM appointments GROUP BY email HAVING count(email) >= 2)");
        $total_visits = DB::select("SELECT count(*) as total FROM website_analytics  WHERE date(created_at) BETWEEN '".date($selected)."' AND '".date($current)."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')");
        $revenue = DB::select("SELECT sum(appointment_services.amount) as total FROM appointments LEFT JOIN appointment_services ON appointment_services.id = appointments.appointment_service_id WHERE date(appointments.created_at) BETWEEN '".date($selected)."' AND '".date($current)."' AND appointments.user_id = '".Auth::user()->id."'"); 
           
        $data = ['appointmentsbooked'=>$appointmentsbooked[0] , 'leadsReceived'=> $leadsReceived[0], 'newclients'=>$newclients[0], 'total_visits'=>$total_visits[0],'revenue'=>$revenue[0],'uniqueVisitors'=>$uniqueVisitors[0]];
        return $data;      
    }
    public function graph_data(Request $request)
    {
         $start_date = $request->start_date;
         $end_date = $request->end_date;
         $start_date = new DateTime($start_date);
         $end_date = new DateTime($end_date);
         $interval = $start_date->diff($end_date);
         $days = $interval->format('%a');

        if ($request->metric_type == '') { 
            $date = \Carbon\Carbon::today()->subDays(30);
            $st_date= $date->todatestring();
            $areaData[] = ['y'=>0 ,'a'=>0,'b'=> 0, 'c'=>0]; 
            $chart_json = ['data'=>$areaData ,'title' => ''];
            return response()->json($chart_json);
        }    
        if ($request->metric_type == 'visitors') {
            if($start_date > $end_date) {
                $areaData[] = ['y'=>0 ,'a'=>0,'b'=> 0, 'c'=>0];
            }
            if($days <= '7') {
                $interval_by_day = DateInterval::createFromDateString('1 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                if($days) {
                    foreach ($period as $dt) {
                          $from = $dt->format('Y-m-d');
                          $query = "SELECT count(*) as total FROM website_analytics WHERE created_at = '".$from."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                          $total_visits = DB::select($query);
                          $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                    }
                }else{
                    $start_date = new Carbon($request->start_date);
                    $from       = $start_date->format("Y-m-d");
                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at = '".$from."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
            elseif($days <= '28') {
                $interval_by_day = DateInterval::createFromDateString('3 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+3 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
            elseif($interval->m <= '3' && $days > '28') {
                $interval_by_day = DateInterval::createFromDateString('14 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $key =>$dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+14 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }  
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            } 
            elseif($interval->m <= '6' && $interval->m != '0') {
                $interval_by_day = DateInterval::createFromDateString('21 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+21 day", strtotime($from)));
                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
            elseif($interval->m >= '6' && $interval->y < '1') {
                $interval_by_day = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("1 Month", strtotime($from)));
                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
            elseif($interval->y >= '1' && $interval->y < '2') {
                $interval_by_day = DateInterval::createFromDateString('2 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("2 Month", strtotime($from)));
                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
            elseif($interval->y == '2') {
                $interval_by_day = DateInterval::createFromDateString('4 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("4 Month", strtotime($from)));
                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
            elseif($interval->y >= '3') {
                $interval_by_day = DateInterval::createFromDateString('1 year');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("1 Year", strtotime($from)));
                    $query = "SELECT count(*) as total FROM website_analytics WHERE created_at BETWEEN '".$from."' AND '".$to."' AND website_id IN (SELECT id FROM websites WHERE user_id = '".Auth::user()->id."')";
                    $total_visits = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_visits[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Visitors'];
                return response()->json($chart_json);
            }
           

      
        }
        elseif ($request->metric_type == 'appointments') {
            if($start_date > $end_date) {
                $areaData[] = ['y'=>0 ,'a'=>0,'b'=> 0, 'c'=>0];
            }
            if($days <= '7') {
                $interval_by_day = DateInterval::createFromDateString('1 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                if($days) {
                    foreach ($period as $dt) {
                          $from = $dt->format('Y-m-d');
                          $query = "SELECT count(*) as total FROM appointments WHERE created_at = '".$from."' AND user_id = '".Auth::user()->id."' ";
                          $total_appointments = DB::select($query);
                          $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                    }
                    $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                    return response()->json($chart_json);
                }else{
                    $start_date = new Carbon($request->start_date);
                    $from       = $start_date->format("Y-m-d");
                    $query = "SELECT count(*) as total FROM appointments WHERE created_at = '".$from."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = [ 'data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
            elseif($days <= '28') {
                $interval_by_day = DateInterval::createFromDateString('3 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+3 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = [ 'data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
            elseif($interval->m <= '3' && $days > '28') {
                $interval_by_day = DateInterval::createFromDateString('14 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
           
                foreach ($period as $key =>$dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+14 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";

                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }  
                $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            } 
            elseif($interval->m <= '6' && $interval->m != '0') {
                $interval_by_day = DateInterval::createFromDateString('21 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+21 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
            elseif($interval->m >= '6' && $interval->y < '1') {
                $interval_by_day = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("1 Month", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
            elseif($interval->y >= '1' && $interval->y < '2') {
                $interval_by_day = DateInterval::createFromDateString('2 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("2 Month", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
            elseif($interval->y == '2') {
                $interval_by_day = DateInterval::createFromDateString('4 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("4 Month", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
            elseif($interval->y >= '3') {
                $interval_by_day = DateInterval::createFromDateString('1 year');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("1 Year", strtotime($from)));

                    $query = "SELECT count(*) as total FROM appointments WHERE created_at BETWEEN '".$from."' AND  '".$to."' AND user_id = '".Auth::user()->id."' ";
                    $total_appointments = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_appointments[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Appointments'];
                return response()->json($chart_json);
            }
           
        }
        elseif ($request->metric_type == 'leads') {
            if($start_date > $end_date) {
                $areaData[] = ['y'=>0 ,'a'=>0,'b'=> 0, 'c'=>0];
            }
            if($days <= '7') {
                $interval_by_day = DateInterval::createFromDateString('1 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                if($days) {
                    foreach ($period as $dt) {
                        $from = $dt->format('Y-m-d');
               
                        $query = "SELECT count(*) as total FROM website_leads WHERE created_at = '".$from."' AND user_id = '".Auth::user()->id."' ";

                        $total_leads = DB::select($query);
                        $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                    }
                    $chart_json = [ 'data' => $areaData,'title' => 'Leads'];
                    return response()->json($chart_json);
                }else{
                    $start_date = new Carbon($request->start_date);
                    $from       = $start_date->format("Y-m-d");
                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at = '".$from."' AND user_id = '".Auth::user()->id."' ";

                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                    $chart_json = [ 'data' => $areaData,'title' => 'Leads'];
                    return response()->json($chart_json);
                }
            }
            elseif($days <= '28') {
                $interval_by_day = DateInterval::createFromDateString('3 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+3 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }
                $chart_json = [ 'data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            }
            elseif($interval->m <= '3' && $days > '28') {
                $interval_by_day = DateInterval::createFromDateString('14 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $key =>$dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+14 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }  
                $chart_json = ['data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            } 
            elseif($interval->m <= '6' && $interval->m != '0') {
                $interval_by_day = DateInterval::createFromDateString('21 day');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("+21 day", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            }
            elseif($interval->m >= '6' && $interval->y < '1') {
                $interval_by_day = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("1 Month", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            }
            elseif($interval->y >= '1' && $interval->y < '2') {
                $interval_by_day = DateInterval::createFromDateString('2 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("2 Month", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            }
            elseif($interval->y == '2') {
                $interval_by_day = DateInterval::createFromDateString('4 month');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("4 Month", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            }
            elseif($interval->y >= '3') {
                $interval_by_day = DateInterval::createFromDateString('1 year');
                $period   = new DatePeriod($start_date, $interval_by_day, $end_date);
                foreach ($period as $dt) {
                    $from = $dt->format('Y-m-d');
                    $to   = date("Y-m-d", strtotime("1 Year", strtotime($from)));

                    $query = "SELECT count(*) as total FROM website_leads WHERE created_at BETWEEN '".$from."' AND '".$to."'";
                    $total_leads = DB::select($query);
                    $areaData[] = ['y'=>$from ,'a'=>$total_leads[0]->total];
                }
                $chart_json = ['data' => $areaData,'title' => 'Leads'];
                return response()->json($chart_json);
            }
           
        }

    }
}