<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Score;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i<=20; $i++) {
            $user = User::create([
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
            ]);
            for($s=1; $s<=50; $s++) {
                Score::create([
                    'user_id' => $user->id,
                    'score' => mt_rand(10,99)
                ]);
            }
        }

    }
}
