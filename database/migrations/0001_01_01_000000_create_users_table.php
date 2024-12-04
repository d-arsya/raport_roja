<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->enum('role',['super','admin','teacher','student']);
            $table->timestamps();
        });
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        Schema::create('class_courses', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->string("name_arabic",100);
            $table->enum("varian",['akademik','agama']);
            $table->integer("kkm");
            $table->char('class_code',13);
            $table->timestamps();
        });
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->char("room_id",13);
            $table->integer("year");
            $table->timestamps();
        });
        Schema::create('personality_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id");
            $table->foreignId("personality_id");
            $table->string("grade");
            $table->integer("semester");
            $table->timestamps();
        });
        Schema::create('personalities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_arabic");
            $table->timestamps();
        });
        Schema::create('abcent_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id");
            $table->foreignId("abcent_id");
            $table->integer("grade");
            $table->integer("semester");
            $table->timestamps();
        });
        Schema::create('abcents', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_arabic");
            $table->timestamps();
        });
        Schema::create('extra_course_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id");
            $table->foreignId("extra_course_id");
            $table->char("grade",1);
            $table->integer("semester");
            $table->timestamps();
        });
        Schema::create('extra_courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_arabic");
            $table->timestamps();
        });
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_arabic");
            $table->string("varian");
            $table->integer("kkm");
            $table->timestamps();
        });
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->integer("grade");
            $table->foreignId("course_id");
            $table->foreignId("student_id");
            $table->integer("semester");
            $table->timestamps();
        });
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("name_arabic")->nullable();
            $table->char("class_code",13)->unique();
            $table->string("teacher_id");
            $table->integer("semester");
            $table->boolean("course");
            $table->timestamps();
        });
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->string("name_arabic",100)->nullable();
            $table->string("nip")->unique();
            $table->string("email")->unique();
            $table->timestamps();
        });
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string("name",100);
            $table->string("name_arabic",100)->nullable();
            $table->integer("nis")->unique();
            $table->string("email")->unique();
            $table->foreignId('group_id');
            for ($i=1; $i <= 6; $i++) { 
                $table->char('semester '.$i,13)->nullable();
            }
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('abcents');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('extra_courses');
        Schema::dropIfExists('personalities');
        Schema::dropIfExists('grades');
        Schema::dropIfExists('personality_grades');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('users');
        Schema::dropIfExists('extra_course_grades');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('class_courses');
        Schema::dropIfExists('abcent_statuses');
    }
};
