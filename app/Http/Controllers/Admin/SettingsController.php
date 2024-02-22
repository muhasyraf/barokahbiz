<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings\AttendanceSettings;

class SettingsController extends Controller
{
    public function attendance(AttendanceSettings $settings){
        $title = 'attendance settings';
        return view('backend.settings.attendance',compact(
            'title','settings'
        ));
    }
}
