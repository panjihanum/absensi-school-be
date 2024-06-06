<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Schools
        $schoolId = (string) Str::uuid();
        DB::table('schools')->insert([
            'id' => $schoolId,
            'name' => 'SMP Negeri 11',
            'government_name' => 'Pemerintah Kota Malang',
            'type' => 'SMP',
            'address' => 'Jl. Ikan Piranha Atas No.185',
            'phone' => '0341494086',
            'postal_code' => '65142',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Users
        $teacherUserId = (string) Str::uuid();
        $parentUserIds = [];
        $parentIds = [];

        DB::table('users')->insert([
            [
                'id' => $teacherUserId,
                'username' => 'teacher1',
                'email' => 'pan.hanum@gmail.com',
                'role' => 'TEACHER',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        for ($i = 0; $i < 40; $i++) {
            $parentUserId = (string) Str::uuid();
            $parentUserIds[] = $parentUserId;
            DB::table('users')->insert([
                'id' => $parentUserId,
                'username' => 'parent' . $i,
                'email' => 'student.absence.' . $i . '@maildrop.cc',
                'role' => 'PARENT',
                'password' => Hash::make('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Teacher Profiles
        $teacherId = (string) Str::uuid();
        DB::table('teacher_profiles')->insert([
            'id' => $teacherId,
            'name' => $faker->name,
            'address' => $faker->address,
            'phone' => $faker->phoneNumber,
            'email' => $faker->email,
            'user_id' => $teacherUserId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Parent Profiles
        foreach ($parentUserIds as $userId) {
            $parentId = (string) Str::uuid();
            $parentIds[] = $parentId;
            DB::table('parent_profiles')->insert([
                'id' => $parentId,
                'name' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->email,
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Students
        $students = [
            ['name' => 'Ahmad Fadilah', 'gender' => 'L'],
            ['name' => 'Ainur Nadiva', 'gender' => 'P'],
            ['name' => 'Ananda Hafidz Pratama', 'gender' => 'L'],
            ['name' => 'Ananta Abdus Syukurriansyah', 'gender' => 'L'],
            ['name' => 'Andina Hari Marisha', 'gender' => 'P'],
            ['name' => 'Angeline Gwinnent Laisina', 'gender' => 'P'],
            ['name' => 'Anggita Putri Savira', 'gender' => 'P'],
            ['name' => 'Anggun Larasati Kirman Saputri', 'gender' => 'P'],
            ['name' => 'Antoni Ariya Sadewa', 'gender' => 'L'],
            ['name' => 'Arya Bagaskara', 'gender' => 'L'],
            ['name' => 'Baruna Arya Pramudya', 'gender' => 'L'],
            ['name' => 'Bayu Dwi Arta Prasetyo', 'gender' => 'L'],
            ['name' => 'Bramasta Maheswara Wirawan', 'gender' => 'L'],
            ['name' => 'Chandra Karunia Hutama', 'gender' => 'L'],
            ['name' => 'Claudia Hartlyn Valencia', 'gender' => 'P'],
            ['name' => 'Gracia Christy Rina Putri', 'gender' => 'P'],
            ['name' => 'Herald Abdiel Shalom', 'gender' => 'L'],
            ['name' => 'I Putu Dharma Widhi Nugraha', 'gender' => 'L'],
            ['name' => 'Julia Sani Br Simanjuntak', 'gender' => 'P'],
            ['name' => 'Kaisar Satria Abizard', 'gender' => 'L'],
            ['name' => 'Kristiani Putri Sutrisno', 'gender' => 'P'],
            ['name' => 'Lisvia Julia Amanda', 'gender' => 'P'],
            ['name' => 'Mochamad Rasya Malik Al Rasyid', 'gender' => 'L'],
            ['name' => 'Muhammad Satrio Nugroho', 'gender' => 'L'],
            ['name' => 'Mutiara Azzahrani Dwi Nur Ifada', 'gender' => 'P'],
            ['name' => 'Natasya Stefani Putri', 'gender' => 'P'],
            ['name' => 'Nazril Nurfadilah', 'gender' => 'L'],
            ['name' => 'Nersita Ghafisani', 'gender' => 'P'],
            ['name' => 'Nur Azizah Ningsih Hariyanti', 'gender' => 'P'],
            ['name' => 'Patricia Calista Dewanty', 'gender' => 'P'],
            ['name' => 'Prisilka Arda Christian', 'gender' => 'P'],
            ['name' => 'Raihan Fajar Aydina', 'gender' => 'L'],
            ['name' => 'Wahyu Samudra', 'gender' => 'L'],
            ['name' => 'Yolanda Vionaldy', 'gender' => 'P'],
        ];

        $studentIds = [];
        foreach ($students as $index => $student) {
            $studentId = (string) Str::uuid();
            $studentIds[] = $studentId;
            DB::table('students')->insert([
                'id' => $studentId,
                'name' => $student['name'],
                'nis' => $faker->unique()->numerify('##########'),
                'nisn' => $faker->unique()->numerify('##########'),
                'gender' => $student['gender'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Seed Student Parents
        foreach ($studentIds as $studentId) {
            $parentCount = rand(1, 2);
            $randomParents = (array) array_rand($parentIds, $parentCount);
            foreach ($randomParents as $parentIndex) {
                DB::table('student_parents')->insert([
                    'student_id' => $studentId,
                    'parent_id' => $parentIds[$parentIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Seed Student Class
        $classId = (string) Str::uuid();
        DB::table('student_classes')->insert([
            'id' => $classId,
            'name' => 'VII A',
            'start_date' => now()->subYears(1),
            'end_date' => now()->addYears(1),
            'homeroom_teacher_id' => $teacherId,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Seed Student Schools
        foreach ($studentIds as $studentId) {
            DB::table('student_schools')->insert([
                'student_id' => $studentId,
                'school_id' => $schoolId,
                'is_active' => true,
                'is_graduated' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
