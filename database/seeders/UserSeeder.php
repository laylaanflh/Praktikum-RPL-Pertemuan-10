<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada — hindari duplikasi saat seed dijalankan ulang
        if (!User::where('email', 'admin@b-university.ac.id')->exists()) {
            User::create([
                'name'     => 'Layla_Nflh',
                'email'    => 'admin@gmail.com',
                'password' => Hash::make('admin12345'),
            ]);

            $this->command->info('✅ Admin user berhasil dibuat!');
            $this->command->info('   Email    : admin@gmail.com');
            $this->command->info('   Password : admin12345');
        } else {
            $this->command->warn('⚠️  Admin user sudah ada, seeder dilewati.');
        }
    }
}