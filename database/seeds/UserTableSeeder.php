<?php

use Illuminate\Database\Seeder;
use App\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([
		'name' => 'Pablo Caiza' ,
        'email' => 'caizap@hotmail.com',
        'password' => bcrypt('chesterman1993'), // password
        'cedula'=>'1717597510',
        'address'=>'Gatazo s22-129',
         'phone'=>'098925383',
        'role'=>'admin'


    	]); 

        User::create([
        'name' => 'Luis Caiza' ,
        'email' => 'doctor@hotmail.com',
        'password' => bcrypt('secret'), // password
        'cedula'=>'1717597502',
        'address'=>'Gatazo s22-124',
        'phone'=>'098925382',
        'role'=>'doctor'


        ]);

        User::create([
        'name' => 'David Caiza' ,
        'email' => 'paciente@hotmail.com',
        'password' => bcrypt('secret'), // password
        'cedula'=>'1717597505',
        'address'=>'Gatazo s22-123',
        'phone'=>'098925381',
        'role'=>'patient'


        ]); 
         
      factory(User::class, 50)->states('patient')->create();
    }
}
