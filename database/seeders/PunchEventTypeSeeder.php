<?php

namespace Database\Seeders;

use App\Models\PunchEventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PunchEventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PunchEventType::create([
            'name' => 'ENTRADA'
        ]);

        PunchEventType::create([
            'name' => 'SAÍDA'
        ]);
    }
}
