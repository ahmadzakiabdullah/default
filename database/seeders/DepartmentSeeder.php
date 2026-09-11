<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Pusat Komputer', 'Hal Ehwal Pelajar', 'Pendaftar', 'Bendahari'] as $name) {
            Department::firstOrCreate(['name' => $name], ['is_active' => true]);
        }
    }
}
