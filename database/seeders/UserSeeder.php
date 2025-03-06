<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nombre' => 'Carlos',
                'apellido' => 'Gómez',
                'email' => 'carlos@example.com',
                'feccre' => Carbon::now()->toDateString(),
                'estado' => 'A',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'nombre' => 'María',
                'apellido' => 'Pérez',
                'email' => 'maria@example.com',
                'feccre' => Carbon::now()->toDateString(),
                'estado' => 'I',
                'password' => Hash::make('password123'),
                'email_verified_at' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [

                'nombre' => 'Juan',
                'apellido' => 'Martínez',
                'email' => 'juan@example.com',
                'feccre' => Carbon::now()->toDateString(),
                'estado' => 'A',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Adriana',
                'apellido' => 'Fonseca',
                'email' => 'yfonseca171@gmail.com',
                'feccre' => Carbon::now()->toDateString(),
                'estado' => 'A',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
