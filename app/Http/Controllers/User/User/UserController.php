<?php

namespace App\Http\Controllers\User\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('user.users.index');
    }
}
