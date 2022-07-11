<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\DashboardRepository;

class DashboardController extends Controller
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index()
    {
        $transactionSums = $this->dashboardRepository->getSums("Transaction");
        $commentSums = $this->dashboardRepository->getSums("Comment");
        $courseSums = $this->dashboardRepository->getSums("Course");
        $postSums = $this->dashboardRepository->getSums("Post");

        $orderChart = $this->dashboardRepository->getChart("Transaction");
        $courseChart = $this->dashboardRepository->getChart("Course");
        $postChart = $this->dashboardRepository->getChart("Post");


        return view('admin.dashboard.index', [
            'orderViewCount' => array_values($orderChart),
            'orderCreatedAt' => array_keys($orderChart),
            'postViewCount' => array_values($postChart),
            'postCreatedAt' => array_keys($postChart),
            'courseViewCount' => array_values($courseChart),
            'courseCreatedAt' => array_keys($courseChart),
            'transactionSums' => $transactionSums,
            'commentSums' => $commentSums,
            'courseSums' => $courseSums,
            'postSums' => $postSums
        ]);
    }
}
