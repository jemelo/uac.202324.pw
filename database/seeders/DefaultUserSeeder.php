<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'José',
            'email' => "admin@local",
            'password' => bcrypt('testes'),
            'email_verified_at' => Carbon::now(),
            'is_admin' => true,
        ]);
    }
}
