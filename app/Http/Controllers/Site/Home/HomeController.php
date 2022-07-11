<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Repositories\Site\HomeRepository;

class HomeController extends Controller
{
    protected $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        $courses = $this->homeRepository->getCourses();
        $educationalvideos = $this->homeRepository->getEducatinalVideo();
        $pharmacologyPost = $this->homeRepository->getPharmacologyPost();
        $medicinalPost = $this->homeRepository->getMedicinalPost();
        return view('site.home.index', compact('courses', 'educationalvideos', 'pharmacologyPost', 'medicinalPost'));
    }
}
