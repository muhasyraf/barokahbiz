<?php

namespace App\Observers;

use App\Models\ChartOfAccount;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ChartOfAccountActionObserver
{
    public function created(ChartOfAccount $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'ChartOfAccount'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function updated(ChartOfAccount $model)
    {
        $data  = ['action' => 'updated', 'model_name' => 'ChartOfAccount'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }

    public function deleting(ChartOfAccount $model)
    {
        $data  = ['action' => 'deleted', 'model_name' => 'ChartOfAccount'];
        $users = \App\Models\User::whereHas('roles', function ($q) { return $q->where('title', 'Admin'); })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
