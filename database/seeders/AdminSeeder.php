<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $username = env('ADMIN_USERNAME');
        $password = env('ADMIN_PASSWORD');

        if ($username && $password) {
            User::updateOrCreate([
                'username' => $username,
                'password' => Hash::make($password),
                'role' => 'admin'
            ]);
        } else {
            $this->command->info('ADMIN_EMAIL or ADMIN_PASSWORD are not set in .env file.');
        }
    }
}
