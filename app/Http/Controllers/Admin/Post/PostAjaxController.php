<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\PostRepository;
use Illuminate\Http\Request;

class PostAjaxController extends Controller
{
    protected $PostRepository;

    public function __construct(PostRepository $PostRepository)
    {
        $this->PostRepository = $PostRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->PostRepository->getDatatableData($request);
    }
}
