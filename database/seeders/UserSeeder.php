<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::connection('mongodb')->getCollection('users')->drop();
        $manager = new User;
        $manager->nextid();
        $manager->username = "tester";
        $manager->password = Hash::make("PASSWORD");
        $manager->role = "mananger";
        $manager->is_active = true;
        $manager->save();

        $agent = new User;
        $agent->nextid();
        $agent->username = "agtester";
        $agent->password = Hash::make("PASSWORD");
        $agent->role = "agent";
        $agent->is_active = true;
        $agent->last_login = null;
        $agent->save();

        $agent = new User;
        $agent->nextid();
        $agent->username = "agtester2";
        $agent->password = Hash::make("PASSWORD");
        $agent->role = "agent";
        $agent->is_active = true;
        $agent->last_login = null;
        $agent->save();
    }
}
