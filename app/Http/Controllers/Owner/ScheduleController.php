<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;

use Contacts;

use Carbon\Carbon;

use App\Schedule;

use Auth;
use Validator;
use Session;

use App\Profile;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index($profile_id)
    {
        
        if(intval(Session::get('step')) > 0 && intval(Session::get('step')) != 3)
        {
            return redirect()->to('profile');
        }

        $profile = Profile::findOrFail($profile_id);

        return view('profile.schedule.index')->with(['profile' => $profile, 'schedules' => $profile->schedules()->orderBy('date_from')->get()]);
    }

    public function edit($profile_id, $schedule)
    {
        if(Auth::user()->profile->id != $profile_id && !Auth::user()->hasRole('admin'))
            return redirect()->to('/profile');

        return view('profile.schedule.edit')->with(['profile_id' => $profile_id ,'schedule' => Profile::findOrFail($profile_id)->schedules()->find($schedule)]);
    }

    public function create($profile_id)
    {
        if(intval(Session::get('step')) > 0 && intval(Session::get('step')) != 3)
        {
            return $redirect->to('profile');
        }

        return view('profile.schedule.create')->with('profile_id', $profile_id);
    }

    public function store(Request $request, $profile_id)
    {
        $this->validate($request, [
            'business_hours' => 'required',
            'date_to' => 'required|date_format:d/m/Y',
            'date_from' => 'required|date_format:d/m/Y'
        ]);

        $profile = Profile::findOrFail($profile_id);

        $dateFrom = Carbon::createFromFormat('d/m/Y', $request->input('date_from'))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', $request->input('date_to'))->toDateString();

        $overlap = $profile->schedules()->where('date_from', '<=', $dateTo)->where('date_to', '>=', $dateFrom)->count() > 0;

        if($overlap)
        {
            return redirect('profile/'.$profile_id.'/schedule/create')
                        ->withErrors(['Selected date range overlaps another date range'])
                        ->withInput();
        }

        $profile->schedules()->create([
            'date_from'  => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'days'  => $request->input('business_hours'),
        ]);
        
        if(intval(Session::get('step')) == 3)
        {
            Session::put('step', 4);
            return redirect()->to('profile/' . $profile_id . '/gallery');
        }

        return redirect('profile/'.$profile_id.'/schedule');
    }

    public function update(Request $request, $profile_id, $schedule)
    {
        if(Auth::user()->profile->id != $profile_id && !Auth::user()->hasRole('admin'))
            return redirect()->to('/profile');

        $this->validate($request, [
            'business_hours' => 'required',
            'date_to' => 'required|date_format:d/m/Y',
            'date_from' => 'required|date_format:d/m/Y'
        ]);

        $dateFrom = Carbon::createFromFormat('d/m/Y', $request->input('date_from'))->toDateString();
        $dateTo = Carbon::createFromFormat('d/m/Y', $request->input('date_to'))->toDateString();

        $profile = Profile::findOrFail($profile_id);

        $overlap = $profile->schedules()->where('date_from', '<=', $dateTo)
            ->where('date_to', '>=', $dateFrom)
            ->where('id', '<>', $schedule)
            ->count() > 0;

        if($overlap)
        {
            return redirect('profile/'.$profile_id.'/schedule/'.$schedule.'/edit')
                        ->withErrors(['Selected date range overlaps another date range'])
                        ->withInput();
        }

        $scheduleObj = Schedule::findOrFail($schedule);

        $scheduleObj->days = $request->input('business_hours');
        $scheduleObj->date_from = $request->input('date_from');
        $scheduleObj->date_to = $request->input('date_to');

        $scheduleObj->save();
        
        return redirect('profile/'.$profile_id.'/schedule');
    }

    public function destroy($profile_id, $schedule)
    {
        if(Auth::user()->profile->id != $profile_id && !Auth::user()->hasRole('admin'))
            return ['error' => 'You don\'t have access to do this'];

        $list = explode('-', $schedule);

        Schedule::destroy($list);

        return $list;
    }
}
