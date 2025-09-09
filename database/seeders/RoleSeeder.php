<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'description' => 'System Administrator with full access'
            ],
            [
                'name' => 'teacher',
                'description' => 'Teacher with access to course management and student data'
            ],
            [
                'name' => 'student',
                'description' => 'Student with access to courses, assignments, and grades'
            ]
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
