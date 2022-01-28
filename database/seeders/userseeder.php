<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','dourjoy@gmail.com')->first();
        if (is_null($user)) {
           $user= new User;
           $user->name='Dourjoy Khan';
           $user->email='dourjoy@gmail.com';
           $user->password=Hash::make('12345678');
           $user->save();
        }
    }
}
