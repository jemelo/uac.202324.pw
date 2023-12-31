<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PunchEventType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function punchEvents()
    {
        return $this->hasMany(PunchEvent::class);
    }
}
