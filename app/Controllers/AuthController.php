<?php

namespace App\Controllers;
use App\Models\EmployesModel;

class AuthController extends BaseController
{
    public function loginForm(): string
    {
        return view('pages/index');
    }

    public function login() {
        $input = $this->request->getPost();
        $user = new EmployesModel();
        $errors = [];
        if(!$this->validate($user->getValidationRules()['login'])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $emailMatch = $user->where('email', $input['email'])->first();
        if($emailMatch === NULL) {
            $errors['email'] = 'Aucun email correspondant';
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        if($input['passwd'] !== $emailMatch['passwd']) {
            $errors['passwd'] = 'Mot de passe incorrect';
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        session()->set('user', $emailMatch);
        $redirectUrl = "";
        if($emailMatch['role'] == 'ADMIN') {
            $redirectUrl = "/admin/dashboard";
        } elseif ($emailMatch['role'] == "RH") {
            $redirectUrl = "/rh/dashboard";
        } elseif ($emailMatch['role'] == 'EMPLOYE') {
            $redirectUrl = "/employe/dashboard";
        }
        return redirect()->to($redirectUrl);
    }

}
