<?php
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'danuja',
            'user_name' => 'danuja',
            'email' => 'ldashanfernando@gmail.com',
            'password' => Hash::make('asdfasdf'),
            'role_id' => Role::ROLE_ADMIN,
            'is_verify' => User::USER_VERIFIED,
            'registered_at' => Carbon::now()
        ]);
    }
}
