<?php

use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::unguard();
        if (!empty(User::first())) {
            return;
        }

        $now = new Carbon();
        $passwordHash = Hash::make('test123');
        $usersData = [];
        for ($i = 0; $i < 100; $i++) {
            $usersData[] = [
                'name'       => $this->faker->name,
                'email'      => $this->faker->email,
                'password'   => $passwordHash,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        User::insert($usersData);
    }
}
