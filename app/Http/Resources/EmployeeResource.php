<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'updated_at' => $this->updated_at,
            'name' => $this->name,
            'code' => $this->code,
            'uuid' => $this->uuid,
            'events' => new PunchEventResourceCollection(
                $this->punchEvents()
                    ->where('created_at', '>=', Carbon::now()->subDays(7))
                    ->get()
            ),
        ];
    }
}
