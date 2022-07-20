<?php

namespace App\Interfaces;

interface SettingRepositoryInterface
{
    public function getSetting();
    public function updateSetting($data, $key);
}