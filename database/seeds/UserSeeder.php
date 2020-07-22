<?php
use Illuminate\Database\Seeder;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Tạo Admin bằng migration
        $admin=new User;
        $admin->name='admin';
        $admin->email='thanhdoan2000pn@gmail.com';
        $admin->address='Quảng Bình';
        $admin->password=Hash::make('admin');
        $admin->position='admin';
        $admin->save();
        // Tạo ra 5 users bằng migration
        for($i=0;$i<5;$i++){
            $users= new User;
            $users->name=$faker->name;
            $users->email=$faker->safeEmail;
            $users->address=$faker->address;
            $users->password=Hash::make('users');
            $users->position='users';
            $users->save();
        }
         // Tạo ra 1 carkeeper bằng migration
            $carKeeper= new User;
            $carKeeper->name='carkeeper';
            $carKeeper->email='carKeeper@gmail.com';
            $carKeeper->address='Đà Nẵng';
            $carKeeper->password=Hash::make('carkeeper');
            $carKeeper->position='carkeeper';
            $carKeeper->save();
    }
}
