<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Schedule extends Model
{
	protected $fillable = ['date_from', 'date_to', 'days']; 

	protected $dates = ['created_at', 'updated_at', 'date_from', 'date_to'];

	public function getDateFromAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function getDateToAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function setDateFromAttribute($value)
    {
        $this->attributes['date_from'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function setDateToAttribute($value)
    {
        $this->attributes['date_to'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    public function getDaysAttribute($value)
    {
        $dayNames = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];

        $workingDays = [];

        $i = 0;
        foreach(json_decode($value, true) as $day)
        {
            $workingDays[] = [
                'name'  => $dayNames[$i],
                'active' => $day['isActive'],
                'from'  => str_replace(' ', '', $day['timeFrom']),
                'to'    => str_replace(' ', '', $day['timeTill']),
            ];

            $i++;
        }

        $splitted = [];

        for ($i = 0; $i < count($workingDays); $i++) 
        { 
            if($workingDays[$i]['active'] == true)
            {
                $start = $workingDays[$i];
                
                $now = $start;

                if($i < count($workingDays) - 1)
                {
                    $next = $workingDays[$i + 1];
                    while ($next['active'] == 'true' && $now['from'] == $next['from'] && $now['to'] == $next['to'] && $i < count($workingDays) - 1)
                    {
                        $now = $workingDays[$i];
                        $next = $workingDays[++$i];
                    }
                    if($i == count($workingDays) - 1){
                        $now = $next;
                    }
                }

                $names = ucfirst($start['name']);
                if($start['name'] != $now['name'])
                {
                    $names .= ' - ' . ucfirst($now['name']);
                    if($i != count($workingDays) - 1){
                        $i--;
                    }
                }

                $splitted[] = [
                    'names' => $names,
                    'from'  => $start['from'],
                    'to'    => $start['to'],
                ];
            }
        }

        return $splitted;
    }
}
