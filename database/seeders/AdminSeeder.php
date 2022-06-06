<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=new Admin();
        $admin->name="barakat alrashdan";
        $admin->email="barakatalrashdan@ymail.com";
        $admin->password=bcrypt('admin');
        $admin->save();
    }
}
