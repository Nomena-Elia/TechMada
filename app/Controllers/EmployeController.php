<?php

namespace App\Controllers;
use App\Models\EmployesModel;
use App\Models\SoldeModel;
use App\Models\CongeModel;
use DateTime;

class EmployeController extends BaseController {
    public function home() {
        $solde = new SoldeModel();
        $conge = new CongeModel();
        $data = $solde->getSoldesCompletsByEmp(session()->get('user')['id']);
        $conges = $conge->getCongesByEmp(session()->get('user')['id']);
        $last = $conge->getCongeLast(session()->get('user')['id']);
        return view('pages/employes/dashboard-employe', ['activePage' => 'dashboard', 'data' => $data, 'conges' => $conges, 'last' => $last]);
    }

    public function demandeForm() {
        $solde = new SoldeModel();
        $userData = $solde->getSoldesCompletsByEmp(session('user')['id']);
        return view('pages/employes/demande', ['activePage' => 'nouvelle-demande', 'data' => $userData]);
    }

    public function getDemandes() {
        $conge = new CongeModel();
        $data = $conge->getCongeComplet(session()->get('user')['id']);
        return view('pages/employes/list-demande', ['activePage' => 'mes-demandes', 'data' => $data]);
    }

    public function submitDemande() {
        $postData = $this->request->getPost();
        $postData['employe_id'] = session()->get('user')['id'];
        $date1 = new DateTime($postData['date_debut']);
        $date2 = new DateTime($postData['date_fin']);
        $interval = $date1->diff($date2);
        $nbdays = (int) $interval->format('%R%a') + 1;
        $errors = [];
        if($nbdays < 0) {
            $errors['date_debut'] = "La date debut doit etre anterieure a date fin";
            $errors['date_fin'] = "La date fin doit etre superieure a date debut";
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        $postData['nb_jours'] = $nbdays;
        $postData['statut'] = 'En attente';
        $conge = new CongeModel();
        if(!$conge->save($postData)) {
            return redirect()->back()->withInput()->with('errors', $conge->errors());
        }
        return redirect()->to('/employe/dashboard')->with('success', 'Votre demande de congé a bien été soumise. Elle est en attente de validation.');
    }

    public function renderCalendar() {
        $conge = new CongeModel();
        $data = $conge->where('employe_id', session()->get('user')['id'])->findAll();
        return view('pages/employes/calendar', ['activePage' => 'calendar', 'data' => $data]);
    }

}
