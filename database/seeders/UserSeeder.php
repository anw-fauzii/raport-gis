<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Anwar Fauzi',
            'email' => '21990155-1',
            'password' => bcrypt('Young*Guns29'),
        ]);
        $admin->assignRole('admin');
    }
}
