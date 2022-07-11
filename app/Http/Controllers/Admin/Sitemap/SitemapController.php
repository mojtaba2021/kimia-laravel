<?php

namespace App\Http\Controllers\Admin\Sitemap;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\SitemapRepository;

class SitemapController extends Controller
{
    protected $sitemapRepository;

    public function __construct(SitemapRepository $sitemapRepository)
    {
        $this->sitemapRepository = $sitemapRepository;
    }

    public function index()
    {
        return view('admin.sitemaps.index');
    }

    public function generate()
    {
        $this->sitemapRepository->generate();
        alert('با تشکر', 'نقشه ی سایت با موفقیت به روز شد');
        return view('admin.sitemaps.index');
    }

}
