<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('attendance.checkin_time','5:00');
        $this->migrator->add('attendance.checkout_time','5:30');
    }
};
