<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Categ;
use App\Models\Usercateg;
use App\Models\Submission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $password = bcrypt('123456');

        User::factory()->create([
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'email' => 'dj@meow.com',
            'password' => $password,
            'role' => 'FDO',
            // 'categ_id' => "|1|12|",
            'verified' => false,
        ]);

        User::factory()->create([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@meow.com',
            'password' => $password,
            'role' => 'Admin',
            // 'categ_id' => "|2|4|",
            'verified' => true,
            'email_verified_at' => now(),
        ]);

        Categ::factory()->create([
            'name' => 'Payment Concern',
            'type' => 'Concerns',
            'description' => 'Payments issues in the bank'
        ]);

        Categ::factory()->create([
            'name' => 'Enrollment Issue',
            'type' => 'Concerns',
            'description' => 'Registration Form and student portal'
        ]);

        Categ::factory()->create([
            'name' => 'Exam Schedule',
            'type' => 'Inquiries',
            'description' => 'Clarifications for the final exam schedule'
        ]);

        Categ::factory()->create([
            'name' => 'Good Moral Certificate',
            'type' => 'Request',
            'description' => 'basta'
        ]);

        Categ::factory()->create([
            'name' => 'UST ID',
            'type' => 'Others',
            'description' => 'Issuance of the UST ID'
        ]);

        // Submission::factory()->create([
        //     'email' => 'jemina.sy.iics@ust.edu.ph',
        //     'tickets' => 1
        // ]);
    }
}
