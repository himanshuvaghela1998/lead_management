<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeadSources;

class LeadsSources extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeadSources::insert([
            'source' => 'LinkedIn'
        ]);
    }
}
