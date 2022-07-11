<?php

namespace App\Http\Controllers\Admin\Course;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\CourseRepository;
use Illuminate\Http\Request;

class CourseAjaxController extends Controller
{
    protected $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function getDatatableData(Request $request)
    {
        return $this->courseRepository->getDatatableData($request);
    }

    public function getItemDatatableData(Request $request, $course)
    {
        return $this->courseRepository->getItemDatatableData($request, $course);
    }
}
