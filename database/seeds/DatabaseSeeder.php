<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Module;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(LaratrustSeeder::class);

        $admin = factory(App\Models\User::class)->create();
        $admin->email = 'admin@example.com';
        $admin->save();
        if($admin){
            $admin->attachRole('admin');
        }
    }
}
