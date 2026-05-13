<?php

namespace App\Controllers;
use App\Models\EmployesModel;

class EmployeController extends BaseController {
    public function home() {
        return view('pages/employes/dashboard-employe', ['activePage' => 'dashboard']);
    }

    public function demandeForm() {
        return view('pages/employes/demande', ['activePage' => 'nouvelle-demande']);
    }

}
