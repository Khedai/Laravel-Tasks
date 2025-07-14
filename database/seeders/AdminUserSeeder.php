<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // List of emails to make admin
        $adminEmails = [
            'gomo@gmail.com',
            'simnikiwe@gmail.com',
            'levi@gmail.com',
        ];

        foreach ($adminEmails as $email) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->role = 'admin';
                $user->save();
                $this->command->info("Admin user updated successfully: $email");
            } else {
                $this->command->error("User with email $email not found.");
            }
        }
    }
}
