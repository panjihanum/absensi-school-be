<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\ParentProfile;
use App\Models\TeacherProfile;
use App\Models\Student;
use App\Models\LessonClass;
use App\Models\StudentLessonClass;
use App\Models\StudentParent;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Seed Users
        $userHasanah = User::firstOrCreate(
            ['email' => 'hasanah@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Hasanah',
                'password' => Hash::make('12345678'),
                'username' => 'hasanah',
                'is_active' => true,
            ]
        );

        $userBudi = User::firstOrCreate(
            ['email' => 'budi@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Budi Santoso',
                'password' => Hash::make('12345678'),
                'username' => 'budisantoso',
                'is_active' => true,
            ]
        );

        $userSiti = User::firstOrCreate(
            ['email' => 'siti@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Siti Aminah',
                'password' => Hash::make('12345678'),
                'username' => 'sitiaminah',
                'is_active' => true,
            ]
        );

        // Seed Roles
        $roleParent = Role::firstOrCreate(
            ['role' => 'PARENT'],
            [
                'id' => (string) Str::uuid()
            ]
        );

        $roleTeacher = Role::firstOrCreate(
            ['role' => 'TEACHER'],
            [
                'id' => (string) Str::uuid()
            ]
        );

        // Seed UserRoles Parents
        UserRole::firstOrCreate(
            ['user_id' => $userBudi->id, 'role_id' => $roleParent->id],
            ['id' => (string) Str::uuid()]
        );

        UserRole::firstOrCreate(
            ['user_id' => $userHasanah->id, 'role_id' => $roleParent->id],
            ['id' => (string) Str::uuid()]
        );

        // Seed UserRoles Teacher
        UserRole::firstOrCreate(
            ['user_id' => $userSiti->id, 'role_id' => $roleTeacher->id],
            ['id' => (string) Str::uuid()]
        );

        // Seed ParentProfiles
        $parentProfileBudi = ParentProfile::firstOrCreate(
            ['user_id' => $userBudi->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Budi Santoso',
                'date_of_birth' => '1970-05-15',
                'address' => 'Jl. Merdeka No. 123, Jakarta',
                'phone_number' => '08123456789',
            ]
        );

        $parentProfileHasanah = ParentProfile::firstOrCreate(
            ['user_id' => $userHasanah->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Hasanah',
                'date_of_birth' => '1970-05-15',
                'address' => 'Jl. Rawa Badung No. 123, Jakarta',
                'phone_number' => '082113589617',
            ]
        );

        // Seed TeacherProfiles
        $teacher = TeacherProfile::firstOrCreate(
            ['user_id' => $userSiti->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Siti Aminah',
                'nip' => '198705152020121001',
                'phone_number' => '081987654321',
                'address' => 'Jl. Pahlawan No. 45, Bandung',
            ]
        );

        // Seed Students
        $student1 = Student::firstOrCreate(
            ['nim' => '202101001'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Ahmad Fauzi',
                'date_of_birth' => '2003-04-12',
                'address' => 'Jl. Kebon Jeruk No. 56, Surabaya',
            ]
        );

        $student2 = Student::firstOrCreate(
            ['nim' => '202101002'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Dewi Lestari',
                'date_of_birth' => '2003-07-19',
                'address' => 'Jl. Sudirman No. 78, Yogyakarta',
            ]
        );

        $student3 = Student::firstOrCreate(
            ['nim' => '202101003'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Panji Hanum',
                'date_of_birth' => '2001-07-19',
                'address' => 'Jl. Rawa Badung, Jakarta',
            ]
        );

        // Seed LessonClasses
        $lessonClass1 = LessonClass::firstOrCreate(
            [
                'lesson' => 'Matematika',
                'teacher_id' => $teacher->id
            ],
            [
                'id' => (string) Str::uuid(),
                'date_lesson' => '2024-06-01',
                'start_time_lesson' => '08:00:00',
                'end_time_lesson' => '10:00:00',
            ]
        );

        $lessonClass2 = LessonClass::firstOrCreate(
            [
                'lesson' => 'Bahasa Indonesia',
                'teacher_id' => $teacher->id
            ],
            [
                'id' => (string) Str::uuid(),
                'date_lesson' => '2024-06-01',
                'start_time_lesson' => '10:30:00',
                'end_time_lesson' => '12:30:00',
            ]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student1->id,
                'parent_profile_id' => $parentProfileBudi->id,
            ],
            ['id' => (string) Str::uuid()]
        );


        StudentParent::firstOrCreate(
            [
                'student_id' => $student2->id,
                'parent_profile_id' => $parentProfileHasanah->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student3->id,
                'parent_profile_id' => $parentProfileHasanah->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student3->id,
                'parent_profile_id' => $parentProfileBudi->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        // Seed StudentLessonClasses
        StudentLessonClass::firstOrCreate(
            ['student_id' => $student1->id, 'lesson_class_id' => $lessonClass1->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => true,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student2->id, 'lesson_class_id' => $lessonClass1->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => true,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student3->id, 'lesson_class_id' => $lessonClass1->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => true,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student1->id, 'lesson_class_id' => $lessonClass2->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => true,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student2->id, 'lesson_class_id' => $lessonClass2->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => true,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );
    }
}
