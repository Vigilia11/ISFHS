<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\profile;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::beginTransaction();

            $user =User::create([
                'email' =>'admin@isfhs.com',
                'password'=>hash::make('adminPassword')
            ]);

            profile::create([
                'user_id'=>$user->id,
                'first_name'=>'admin',
                'last_name'=>'admin',
                'sex'=>'Male',
                'birthdate'=>now(),
                'barangay'=>'brgy',
                'city'=>'city',
                'province'=>'province',
                'picture'=>"user.jpg",
            ]);
            
            $user->assignRole('admin');

            DB::commit();

        }
        catch(exception $e){
            throw $e;
            DB::rollback();
        }
    }
}
