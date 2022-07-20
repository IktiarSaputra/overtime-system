<?php

namespace App\Repositories;

use App\Models\Overtime;
use App\Models\Employee;
use App\Models\Setting;
use App\Models\Reference;
use App\Interfaces\OvertimeRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class OvertimeRepository implements OvertimeRepositoryInterface
{
    public function getOvertime()
    {
        $overtime = Overtime::all();
        return [
            'success' => true,
            'data' => $overtime
        ];
        
    }
    
    public function storeOvertime($data)
    {
        $validator = Validator::make($data, [
            'employee_id' => 'required',
            'date' => 'required|date|date_format:Y-m-d',
            'time_start' => 'required|date_format:H:i|before:time_end',
            'time_ended' => 'required|date_format:H:i|after:time_start',
        ]);
        
        if ($validator->fails()) {
           return ['success' => false, 'message' => $validator->errors()];
        }

        $employee = Employee::where('id', $data['employee_id'])->get();
        if ($employee) {
            $overtimes = Overtime::all();
            if ($overtimes->count() > 0) {
                $ovrtime = Overtime::where('employee_id', $data['employee_id'])->where('date', $data['date'])->get();
                if ($ovrtime->count() > 0) {
                    return ['success' => false, 'message' => 'Overtime already exist'];
                } else {
                    $overtime = new Overtime();
                    $overtime->employee_id = $data['employee_id'];
                    $overtime->date = $data['date'];
                    $overtime->time_start = $data['time_start'];
                    $overtime->time_ended = $data['time_ended'];
                    $overtime->save();
                    return ['success' => true, 'message' => 'Overtime added successfully', 'data' => $overtime];
                }
            } else {
                $overtime = new Overtime();
                $overtime->employee_id = $data['employee_id'];
                $overtime->date = $data['date'];
                $overtime->time_start = $data['time_start'];
                $overtime->time_ended = $data['time_ended'];
                $overtime->save();
                return ['success' => true, 'message' => 'Overtime added successfully', 'data' => $overtime];
            }
            
        } else {
            return ['error' => true, 'message' => 'Employee not found'];
        }
    }
    
    public function getOvertimePay($data)
    {
        $validator = Validator::make($data,[
            'mount' => 'required|date|date_format:Y-m',
        ]);

        if ($validator->fails()) {
           return ['success' => false, 'message' => $validator->errors()];
        }

        $employee = Employee::all();
        $result = [];
        foreach($employee as $emp){
            $overtime = Overtime::where('employee_id', $emp->id)->where('date', 'like', '%'.$data['mount'].'%')->get();
            if ($overtime->count() > 0) {
                $overtime_duration_total = 0;
                foreach($overtime as $ovr){
                    $time_start = \Carbon\Carbon::parse($ovr->time_start);
                    $time_ended = \Carbon\Carbon::parse($ovr->time_ended);
                    $hours = $time_ended->diffInHours($time_start);
                    $minutes = $time_ended->diffInMinutes($time_start) - ($hours * 60);
                    $time_duration = strtotime($hours.':'.$minutes);
                    $round_time = date('H:00', round($time_duration));
                    $sum_hours = explode(':', $round_time);
                    $overtime_duration_total += $sum_hours[0];
                    $ovr->time_duration = $round_time;
                }
                $setting = Setting::orderBy('id', 'desc')->get()->first();
                $reference = Reference::where('id', $setting->value)->get();
                if ($setting->value == 1) {
                    $overtimepay = $emp->salary / 173 * $overtime_duration_total;
                    $amount = round($overtimepay, 3);
                } else {
                    $overtimepay = 10000 * $overtime_duration_total;
                    $amount = $overtimepay;
                }
                $result[] = [
                    'id' => $emp->id,
                    'name' => $emp->name,
                    'salary' => $emp->salary,
                    'overtimes' => $overtime,
                    'overtime_duration_total' => $overtime_duration_total,
                    'amount' => $amount,
                ];
            }
        }
        
        return ['success' => true, 'message' => 'List Overtime Pay', 'data' => $result];
    }
}