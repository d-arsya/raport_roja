<?php

namespace Database\Seeders;

use App\Models\Abcent;
use App\Models\AbcentStatus;
use App\Models\Course;
use App\Models\Grade;
use App\Models\ExtraCourse;
use App\Models\ExtraCourseGrade;
use App\Models\Room;
use App\Models\User;
use App\Models\Group;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Personality;
use App\Models\PersonalityGrade;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\GradeFactory;
use Faker;

class DatabaseSeeder extends Seeder
{
    private $courseData = [
        ["name" => "Aqidah", "name_arabic" => "التوحيد", "varian" => "agama", "kkm" => 75],
        ["name" => "Tafsir", "name_arabic" => "ترجمة القرآن", "varian" => "agama", "kkm" => 75],
        ["name" => "Tajwid", "name_arabic" => "التجويد", "varian" => "agama", "kkm" => 75],
        ["name" => "Riyadush Sholihin", "name_arabic" => "الحديث النبوي", "varian" => "agama", "kkm" => 75],
        ["name" => "Akhlaq", "name_arabic" => "الأخلاق", "varian" => "agama", "kkm" => 75],
        ["name" => "Nahwu", "name_arabic" => "النّحو", "varian" => "agama", "kkm" => 75],
        ["name" => "Shorof", "name_arabic" => "الصّرف", "varian" => "agama", "kkm" => 75],
        ["name" => "Fiqh", "name_arabic" => "الفقه", "varian" => "agama", "kkm" => 75],
        ["name" => "Sejarah Kebudayaan Islam", "name_arabic" => "التاريخ الاسلامى", "varian" => "agama", "kkm" => 75],
        ["name" => "Imla'", "name_arabic" => "الإملاء", "varian" => "agama", "kkm" => 75],
        ["name" => "Ulumul Qur'an", "name_arabic" => "علوم القرآن", "varian" => "agama", "kkm" => 75],
        ["name" => "Mushtholahul Hadits", "name_arabic" => "مصطلح الحديث", "varian" => "agama", "kkm" => 75],
        ["name" => "Ushul Fiqh", "name_arabic" => "أصول الفقه", "varian" => "agama", "kkm" => 75],
        ["name" => "Micro Teaching", "name_arabic" => "عمالية التدريس", "varian" => "agama", "kkm" => 75],
        ["name" => "Mahfudhat", "name_arabic" => "المحفوظات", "varian" => "agama", "kkm" => 75],
        ["name" => "Tamrinul Lughah", "name_arabic" => "تمرين اللغة", "varian" => "agama", "kkm" => 75],
        ["name" => "Insya'", "name_arabic" => "الإنشاء", "varian" => "agama", "kkm" => 75],
        ["name" => "Bahasa Indonesia", "name_arabic" => "اللغة الاندونيسية", "varian" => "akademik", "kkm" => 75],
        ["name" => "Matematika", "name_arabic" => "الرياضيات", "varian" => "akademik", "kkm" => 75],
        ["name" => "Kimia", "name_arabic" => "الكيمياء", "varian" => "akademik", "kkm" => 75],
        ["name" => "Fisika", "name_arabic" => "الفيزياء", "varian" => "akademik", "kkm" => 75],
        ["name" => "Biologi", "name_arabic" => "بيولوجيا", "varian" => "akademik", "kkm" => 75],
        ["name" => "Bahasa Inggris", "name_arabic" => "اللغة الانجليزية", "varian" => "akademik", "kkm" => 75]
    ];
    private $roomsData = [
        ["name" => "ALUMNI","name_arabic"=>"ALUMNI","class_code"=>"000", "teacher_id"=>"000","semester"=>0],
    ];
    private $teachersData = [
        ["name" => "ALUMNI", "name_arabic" => "ALUMNI", "nip" => "000"],
        // ["name" => "Kamal", "name_arabic" => "كمل", "nip" => "13278137"],
        // ["name" => "Ahmad", "name_arabic" => "أحمد", "nip" => "13278138"],
        // ["name" => "Fatimah", "name_arabic" => "فاطمة", "nip" => "13278139"]
    ];
    private $groupsData = [
        ["name" => "2015","year"=>"2015","room_id"=>"000"]
    ];
    private $absencesData = [
        ["name" => "Sakit", "name_arabic" => "بسبب المرض"],
        ["name" => "Izin", "name_arabic" => "بالإستئذان"],
        ["name" => "Alfa", "name_arabic" => "بدون بيانات"],
    ];
    private $extraCoursesData = [
        ["name" => "Pandu", "name_arabic" => "الكشافة هداية الله"],
        ["name" => "Club", "name_arabic" => "النادي"],
        ["name" => "Tapak Suci", "name_arabic" => "دفاع النفس"],
    ];

    private $personalitiesData = [
        ["name" => "Adab", "name_arabic" => "الأدب"],
        ["name" => "Kepribadian", "name_arabic" => "الشخصية"],
    ];
    private $studentsData = [
        // Room 1
        ["name" => "Muhammad Ali Rahman", "name_arabic" => "محمد علي رحمان", "group_id" => 1, "nis" => "2024001"],
        ["name" => "Alya Nurul Huda", "name_arabic" => "عليا نور الهدى", "group_id" => 1, "nis" => "2024002"],
        ["name" => "Ahmad Faisal Pratama", "name_arabic" => "أحمد فيصل براتاما", "group_id" => 1, "nis" => "2024003"],
        ["name" => "Siti Aisyah Rizqi", "name_arabic" => "سيتي عائشة رزقي", "group_id" => 1, "nis" => "2024004"],
        ["name" => "Rizky Maulana", "name_arabic" => "رزقي مولانا", "group_id" => 1, "nis" => "2024005"],
    ];

    
        
    public function run(): void
    {
        $faker = Faker\Factory::create();
        // foreach ($this->teachersData as $teacher) {
        //     Teacher::create($teacher);
        //     User::create([
        //         "username"=>$teacher["nip"],
        //         "password"=>bcrypt("000000"),
        //         "role"=>'teacher'
        //     ]);
        // }
        // foreach ($this->groupsData as $group) {
        //     Group::create($group);
        // }
        // foreach ($this->studentsData as $student) {
        //     Student::create($student);
        // }
        // for($stud=1;$stud<=count($this->studentsData);$stud++){
        //     for($i=1;$i<=count($this->courseData);$i++){
        //         Grade::create([
        //             "grade"=>$faker->numberBetween(60,100),
        //             "course_id"=>$i,
        //             "student_id"=>$stud
        //         ]);
        //     }
        //     for($i=1;$i<=count($this->extraCoursesData);$i++){
        //         ExtraCourseGrade::create([
        //             "grade" => $faker->randomElement(['A','B','C']),
        //             "extra_course_id" => $i,
        //             "student_id" => $stud
        //         ]);
        //     }
        //     for($i=1;$i<=count($this->absencesData);$i++){
        //         AbcentStatus::create([
        //             "abcent_id" => $i,
        //             "student_id" => $stud,
        //             "grade" => $faker->numberBetween(0,5)
        //         ]);
        //     }
        //     for($i=1;$i<=count($this->personalitiesData);$i++){
        //         PersonalityGrade::create([
        //             "personality_id" => $i,
        //             "student_id" => $stud,
        //             "grade" => $faker->randomElement(['A','B','C']),
        //         ]);
        //     }

    
        // }
        foreach ($this->roomsData as $room) {
            Room::create($room);
        }
        User::create([
            "email"=>env('ADMIN_EMAIL'),
            "password"=>bcrypt(env('ADMIN_PASSWORD')),
            "role"=>'admin'
        ]);
        // User::create([
        //     "username"=>"super",
        //     "password"=>bcrypt("super"),
        //     "role"=>'super'
        // ]);
        
        
        foreach ($this->courseData as $course) {
            Course::create($course);
        }
        foreach ($this->extraCoursesData as $extraCourse) {
            ExtraCourse::create($extraCourse);
        }
        foreach ($this->absencesData as $absence) {
            Abcent::create($absence);
        }
        foreach ($this->personalitiesData as $personality) {
            Personality::create($personality);
        }
        
    }
}
