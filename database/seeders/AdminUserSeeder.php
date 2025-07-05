<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // IMPORTANT: Change this to the email of the user you want to make an admin.
        $user = User::where('email', 'levi@gmail.com')->first();

        if ($user) {
            $user->role = 'admin';
            $user->save();
            $this->command->info('Admin user updated successfully.');
        } else {
            $this->command->error('User with that email not found.');
        }
    }
}
