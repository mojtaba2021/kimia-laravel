<?php

namespace App\Http\Controllers\Site\Course;

use App\Http\Controllers\Controller;
use App\Repositories\Site\CourseRepository;

class CourseController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $courses = $this->courseRepository->getAll();
        return view('site.courses.index', compact('courses'));
    }

    public function show($course)
    {
        $course = $this->courseRepository->getCourse($course);
        $checkOrder = $this->courseRepository->checkOrder($course);
        $courseSeason = $this->courseRepository->getCourseSeason($course);
        statistics("course", $course->id);
        return view('site.courses.show', compact('course', 'courseSeason', 'checkOrder'));
    }
}
