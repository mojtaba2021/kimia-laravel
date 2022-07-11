<?php

namespace App\Http\Controllers\Site\Search;

use App\Http\Controllers\Controller;
use App\Repositories\Site\SearchRepository;
use Illuminate\Http\Request;

class SearchAjaxController extends Controller
{

    protected $searchRepository;

    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function getData(Request $request)
    {
       return $this->searchRepository->search($request);
    }
}
