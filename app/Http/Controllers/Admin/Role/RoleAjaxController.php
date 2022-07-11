<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\RoleRepository;
use Illuminate\Http\Request;

class RoleAjaxController extends Controller
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function getDatatableData(Request $request)
    {
        return $this->roleRepository->getDatatableData($request);
    }
}
