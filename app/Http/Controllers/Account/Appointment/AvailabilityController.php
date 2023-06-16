<?php
namespace App\Http\Controllers\Account\Appointment;
use Auth;
use App\Models\User;
use App\Models\{
    AppointmentAvailability as Availability
};
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
class AvailabilityController extends Controller
{
    public function index()
    {
        return view('account.appointments.availability');
    }
    public function all(Request $request)
    {
        $user = Auth::user();
        if (!$request->ajax() && Auth::check()) {
            return response()->json(get_string('something_happened'), 400);
        }
        $availabilities = Availability::where('user_id', $user->id);
        if ($request->has('start') && $request->has('end')) {
            $availabilities->between(
                [
                'start' => $request->start,
                'end' => $request->end
                ]
            );
        }
        return $availabilities->get();
    }
    public function create($serviceId)
    {
        $user = Auth::user();
        return view('account.availability.create');
    }
    public function delete(Request $request)
    {
        $user = Auth::user();
        if (!$request->ajax() && Auth::check()) {
            return response()->json($static_data['strings']['something_happened'], 400);
            return response()->json(get_string('something_happened'), 400);
        }
        $availability = Availability::where('user_id', $user->id)
            ->where('id', $request->id)
            ->firstOrFail();
        if ($availability->booked == 0) {
            $availability->delete();
            return response()->json(get_string('success_delete_availability'), 200);
        } else {
            Log::error("Error occured when deleting availability: {$ex->getMessage()}");
            
            return response()->json(get_string('fail_delete_availability'), 400);
        }
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $this->generateAvailabilities($request, $user);
        DB::beginTransaction();
        try {
            Availability::insert($data);
            DB::commit();
            return redirect()->route('account.appointments.calendar')->with(
                'response', [
                    'status' => 'success',
                    'class' => 'success',
                    'code' => 200,
                    'msg' => 'Successfully Added Availabililty'
                ]
            );
        } catch (PDOException $ex) {
            Log::error("Error occured when adding availability: {$ex->getMessage()}");
            DB::rollBack();
            return redirect()->back()->with(
                'response', [
                    'status' => 'fail',
                    'class' => 'danger',
                    'code' => 400,
                    'msg' => 'Failed Adding Availability'
                ]
            );
        }
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$request->ajax() && Auth::check()) {
            return response()->json($static_data['strings']['something_happened'], 400);
            return response()->json(get_string('something_happened'), 400);
        }
        $availability = Availability::where('user_id', $user->id)
            ->where('id', $request->id)
            ->firstOrFail();
        $eDate = Carbon::parse("{$availability->date} {$request->get('availability_time')}", $this->userTimezone())
                ->timezone('UTC')->toDateTimeString();
        
        // Check whether someone has booked this availability
        if ($availability->booked == 1) {
            return response()->json(get_string('fail_update_booked_availability'), 400);
        }
        
        DB::beginTransaction();
        try {
            $availability->update(
                [
                'availability' => $eDate
                ]
            );
            
            DB::commit();
            return response()->json(get_string('success_update_availability'), 200);
        } catch (Exception $ex) {
            Log::error("Error occured when updating availability: {$ex->getMessage()}");
            
            return response()->json(get_string('fail_update_availability'), 400);
        }
    }
    public function generateAvailabilities(Request $request, User $user)
    {
        $date = Carbon::parse($request->fromdate);
        $to = Carbon::parse($request->todate);
        $days = [];
        if($date->lt($to)) {
            while ($date->lt($to)) {
                $date->addDay();
                $dayName = strtolower($date->format('l'));
                if ($request->has($dayName)) {
                    $events = $this->aDayEvents(
                        $user->id, $request->service_id, $date, $request->get("{$dayName}_from"), $request->get("{$dayName}_to"), $request->length, $request->break
                    );
                    $days = array_merge(array_values($days), array_values($events));
                }
            }
        }else{
            $dayName = strtolower($date->format('l'));
            if ($request->has($dayName)) {
                $events = $this->aDayEvents(
                    $user->id, $request->service_id, $date, $request->get("{$dayName}_from"), $request->get("{$dayName}_to"), $request->length, $request->break
                );
                $days = array_merge(array_values($days), array_values($events));
            }
        }
        return $days;
    }
    public function aDayEvents($userId, $serviceId, Carbon $date, $from, $to, $lengthOfEvent, $breaktime)
    {
        $dayOf = $date->dayOfWeek;
        $range = range(strtotime($from), strtotime($to), ($lengthOfEvent * 60 + $breaktime * 60));
        foreach ($range as $time) {
            if (date("H:i:s", $time) != $to) {
                $thisTimeIs = date("H:i:s", $time);
                $event = "{$date->toDateString()} {$thisTimeIs}";
                $toUtc = Carbon::parse($event, $this->userTimezone())
                        ->timezone('UTC')->toDateTimeString();
                $rows[] = [
                    'user_id' => $userId,
                    'availability' => $toUtc,
                ];
            }
        }
        return $rows;
    }
    public function userTimezone()
    {
        $user = Auth::user();
        if ($user->timezone) {
            return $user->timezone;
        } else {
            return 'UTC';
        }
    }
}
