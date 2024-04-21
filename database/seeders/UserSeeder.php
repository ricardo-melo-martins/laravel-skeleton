<?php

namespace Database\Seeders;

use App\Modules\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Config::get('tests.enabled')) return;

        // Criar um usuário que eu saiba a senha
        DB::table('users')->insert([
            'username' => Config::get('tests.user.username'),
            'email' => Config::get('tests.user.email'),
            'password' => Hash::make(Config::get('tests.user.password_hashed')),
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'token' => Str::random(10),
        ]);

        if (Config::get('tests.seed_data_fake')) {

            // Criar alguns usuários fakes
            User::factory()->count(10)->create();
        }

    }
}
