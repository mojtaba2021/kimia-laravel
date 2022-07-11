<?php

namespace App\Http\Controllers\Admin\Sitemap;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\SitemapRepository;
use Illuminate\Http\Request;

class SitemapAjaxController extends Controller
{
    protected $userRepository;

    public function __construct(SitemapRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
