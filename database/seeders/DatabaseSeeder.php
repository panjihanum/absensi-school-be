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
use Carbon\Carbon;

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
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student2->id, 'lesson_class_id' => $lessonClass1->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student3->id, 'lesson_class_id' => $lessonClass1->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student1->id, 'lesson_class_id' => $lessonClass2->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student2->id, 'lesson_class_id' => $lessonClass2->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        $userJohn = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'John Doe',
                'password' => Hash::make('12345678'),
                'username' => 'johndoe',
                'is_active' => true,
            ]
        );

        $userJane = User::firstOrCreate(
            ['email' => 'jane@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Jane Smith',
                'password' => Hash::make('12345678'),
                'username' => 'janesmith',
                'is_active' => true,
            ]
        );

        $userMark = User::firstOrCreate(
            ['email' => 'mark@example.com'],
            [
                'id' => (string) Str::uuid(),
                'name' => 'Mark Johnson',
                'password' => Hash::make('12345678'),
                'username' => 'markjohnson',
                'is_active' => true,
            ]
        );

        $parentProfileJohn = ParentProfile::firstOrCreate(
            ['user_id' => $userJohn->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'John Doe',
                'date_of_birth' => '1975-08-20',
                'address' => '123 Main St, Anytown',
                'phone_number' => '555-1234',
            ]
        );

        $parentProfileJane = ParentProfile::firstOrCreate(
            ['user_id' => $userJane->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Jane Smith',
                'date_of_birth' => '1980-05-10',
                'address' => '456 Elm St, Othertown',
                'phone_number' => '555-5678',
            ]
        );

        // Additional Teachers
        $teacher2 = TeacherProfile::firstOrCreate(
            ['user_id' => $userJane->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Jane Smith',
                'nip' => '198005102020121002',
                'phone_number' => '081234567890',
                'address' => '789 Oak St, Anycity',
            ]
        );

        $teacher3 = TeacherProfile::firstOrCreate(
            ['user_id' => $userMark->id],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Mark Johnson',
                'nip' => '198504202020121003',
                'phone_number' => '081098765432',
                'address' => '321 Pine St, Somewhere',
            ]
        );

        // Additional Students
        $student4 = Student::firstOrCreate(
            ['nim' => '202101004'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Lisa Anderson',
                'date_of_birth' => '2004-03-15',
                'address' => '789 Maple St, Nowhere',
            ]
        );

        $student5 = Student::firstOrCreate(
            ['nim' => '202101005'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Michael Brown',
                'date_of_birth' => '2003-11-30',
                'address' => '1010 Oak St, Anyville',
            ]
        );

        $student6 = Student::firstOrCreate(
            ['nim' => '202101006'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'Emily Wilson',
                'date_of_birth' => '2004-07-05',
                'address' => '111 Cedar St, Nowheretown',
            ]
        );

        $student7 = Student::firstOrCreate(
            ['nim' => '202101007'],
            [
                'id' => (string) Str::uuid(),
                'full_name' => 'David Lee',
                'date_of_birth' => '2004-01-20',
                'address' => '1212 Elm St, Anyplace',
            ]
        );

        // Seed LessonClasses

        $lessonClass3 = LessonClass::firstOrCreate(
            [
                'lesson' => 'Physics',
                'teacher_id' => $teacher2->id
            ],
            [
                'id' => (string) Str::uuid(),
                'date_lesson' => '2024-06-01',
                'start_time_lesson' => '14:00:00',
                'end_time_lesson' => '16:00:00',
            ]
        );

        // Assign students to the new lesson
        StudentLessonClass::firstOrCreate(
            ['student_id' => $student4->id, 'lesson_class_id' => $lessonClass3->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student5->id, 'lesson_class_id' => $lessonClass3->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student6->id, 'lesson_class_id' => $lessonClass3->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentLessonClass::firstOrCreate(
            ['student_id' => $student7->id, 'lesson_class_id' => $lessonClass3->id],
            [
                'id' => (string) Str::uuid(),
                'is_presence' => false,
                'is_permission' => false,
                'permission_detail' => null,
            ]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student4->id,
                'parent_profile_id' => $parentProfileJohn->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student5->id,
                'parent_profile_id' => $parentProfileJane->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student6->id,
                'parent_profile_id' => $parentProfileHasanah->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        StudentParent::firstOrCreate(
            [
                'student_id' => $student7->id,
                'parent_profile_id' => $parentProfileBudi->id,
            ],
            ['id' => (string) Str::uuid()]
        );

        $yesterday = Carbon::yesterday();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $lessonClassYesterday = LessonClass::firstOrCreate(
            [
                'lesson' => 'Bahasa Inggris',
                'teacher_id' => $teacher->id
            ],
            [
                'id' => (string) Str::uuid(),
                'date_lesson' => $yesterday,
                'start_time_lesson' => '08:00:00',
                'end_time_lesson' => '10:00:00',
            ]
        );

        $lessonClassToday = LessonClass::firstOrCreate(
            [
                'lesson' => 'Bahasa Indonesia',
                'teacher_id' => $teacher->id
            ],
            [
                'id' => (string) Str::uuid(),
                'date_lesson' => $today,
                'start_time_lesson' => '10:30:00',
                'end_time_lesson' => '12:30:00',
            ]
        );

        $lessonClassTomorrow = LessonClass::firstOrCreate(
            [
                'lesson' => 'Physics',
                'teacher_id' => $teacher2->id
            ],
            [
                'id' => (string) Str::uuid(),
                'date_lesson' => $tomorrow,
                'start_time_lesson' => '14:00:00',
                'end_time_lesson' => '16:00:00',
            ]
        );

        // Mark all students as checked
        $students = Student::all();
        foreach ($students as $student) {
            StudentLessonClass::firstOrCreate(
                ['student_id' => $student->id, 'lesson_class_id' => $lessonClassYesterday->id],
                [
                    'id' => (string) Str::uuid(),
                    'is_presence' => false,
                    'is_permission' => false,
                    'permission_detail' => null,
                ]
            );

            StudentLessonClass::firstOrCreate(
                ['student_id' => $student->id, 'lesson_class_id' => $lessonClassToday->id],
                [
                    'id' => (string) Str::uuid(),
                    'is_presence' => false,
                    'is_permission' => false,
                    'permission_detail' => null,
                ]
            );

            StudentLessonClass::firstOrCreate(
                ['student_id' => $student->id, 'lesson_class_id' => $lessonClassTomorrow->id],
                [
                    'id' => (string) Str::uuid(),
                    'is_presence' => false,
                    'is_permission' => false,
                    'permission_detail' => null,
                ]
            );
        }
    }
}
