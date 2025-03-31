<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\Publication;


class UserController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function login()
    {
        return view('login.php');
    }

    public function validate_login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $this->userModel->validLogin($email, $password);
        if ($user) {
            return redirect()->to('/home');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }
    public function home()
    {
        $publicationModel = new Publication();
        $totalPublications = $publicationModel->countAll();
        return view('home', [
            'totalPublications' => $totalPublications,
        ]);
    }
}
