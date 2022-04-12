<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'role_id' => '1',
            'name' => 'Admin',
            'email' => 'admin@mailinator.com',
            'password' => Hash::make('aipX@1234'),
        ]);

        // DB::table('translations')->where('field', 'page_desc')->update(['field' => 'meta_desc']);
        // User::where('email', 'admin@mailinator.com')->update(['email' => 'admin@mailinator.com']);

    }
}
