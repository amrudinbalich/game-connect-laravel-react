<?php

namespace Database\Seeders;

use App\Models\PublisherProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublisherProfile::factory()->count(15)->create();
    }
}
