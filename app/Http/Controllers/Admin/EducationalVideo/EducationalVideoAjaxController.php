<?php

namespace App\Http\Controllers\Admin\EducationalVideo;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\EducationalVideoRepository;
use Illuminate\Http\Request;

class EducationalVideoAjaxController extends Controller
{
    protected $EducationalVideoRepository;

    public function __construct(EducationalVideoRepository $EducationalVideoRepository)
    {
        $this->EducationalVideoRepository = $EducationalVideoRepository;
    }

    public function getDatatableData(Request $request)
    {
        return $this->EducationalVideoRepository->getDatatableData($request);
    }
}
