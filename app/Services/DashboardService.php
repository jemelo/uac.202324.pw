<?php

namespace App\Services;

use App\Models\PunchEvent;
use App\Models\PunchEventType;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class DashboardService
{
    public function getDashboardData(): Collection
    {
        if (Auth::user()->is_admin) {
            return $this->getAdminData();
        } else {
            return $this->getUserData();
        }
    }

    public function getAdminData(): Collection
    {
        return collect([
            'punchins' => $this->getPunchEvents(PunchEventType::find(1), Carbon::now()->subDay()),
            'punchouts' => $this->getPunchEvents(PunchEventType::find(2), Carbon::now()->subDay()),
        ]);
    }

    public function getUserData(): Collection
    {
        return collect();
    }

    protected function getPunchEvents(PunchEventType $punchEventType, ?Carbon $date = null)
    {
        if ($date == null) {
            $date = Carbon::now();
        }

        return PunchEvent::query()
            ->where('punch_event_type_id', $punchEventType->id)
            ->where('created_at', '>=', $date->startOfDay()->toDateTimeString())
            ->where('created_at', '<=', $date->endOfDay()->toDateTimeString())
            ->orderBy('created_at')
            ->get();
    }



}
