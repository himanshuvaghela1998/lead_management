<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\project_types;

class admin_projecttitle extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        project_types::insert([
            'project_type' => 'lead manager'
        ]);
    }
}
