<?php

namespace App\Repositories;

use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;
use App\Models\Reference;
use Illuminate\Support\Facades\Validator;

class SettingRepository implements SettingRepositoryInterface
{
    public function getSetting()
    {
        return Setting::all();
    }
    
    public function getSettingByKey($key)
    {
        return Setting::where('key', $key)->first();
    }
    
    public function updateSetting($data, $key)
    {
        $validator = Validator::make($data, [
            'value' => 'required',
        ]);

        if ($validator->fails()) {
           return [
                'code' => 400,
                'success' => false,
                'message' => $validator->errors()->first(),
           ];
        }
        
        if($key == 'overtime_method'){
            $reference = Reference::where('id', $data['value'])->get();
            if ($reference->count() > 0) {
                $setting = Setting::where('key', $key)->first();
                if ($setting) {
                    $setting->value = $data['value'];
                    $setting->save();
                    return ['success' => true, 'message' => 'Setting updated successfully', 'data' => $setting];
                } else {
                    return ['success' => false, 'message' => 'Setting not found'];
                }
            }
            else{
                return ['succsee' => false, 'message' => 'Invalid value'];
            }
        }
        else{
            return ['success' => false, 'message' => 'Invalid Key'];
        }
    }
}