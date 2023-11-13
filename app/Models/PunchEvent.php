<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PunchEvent extends Model
{
    use HasFactory, SoftDeletes;

    public function punchEventType()
    {
        return $this->belongsTo(PunchEventType::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
