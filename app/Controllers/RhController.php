<?php

namespace App\Controllers;
use App\Models\EmployesModel;
use App\Models\SoldeModel;
use App\Models\CongeModel;
use DateTime;

class RhController extends BaseController {
    public function home() {
        $conge = new CongeModel();
        $data = $conge->getCongeEnAttente();
        return view('pages/rh/list-demande', ['data' => $data]);
    }

    public function accept($id) {
        $conge = new CongeModel();
        $solde = new SoldeModel();
        $conge->update($id, ['statut' => 'Approuve', ['traite_par' => session()->get('user')['id']]]);
        $found = $conge->find($id);
        var_dump($found);
        $currentSolde = $solde
            ->where('employe_id', $found['employe_id'])
            ->where('types_conge_id', $found['types_conge_id'])
            ->first();

        $nouveauTotal = $currentSolde['jours_pris'] + $found['nb_jours'];

        $solde
        ->update($currentSolde['id'], ['jours_pris' => $nouveauTotal]);
        return redirect()->to('/rh/dashboard')->with('success', 'Demande Approuvee');
    }

    public function deny($id) {
        $conge = new CongeModel();
        $solde = new SoldeModel();
        $conge->update($id, ['statut' => 'Refuse', ['traite_par' => session()->get('user')['id']]]);
        $found = $conge->find($id);
        var_dump($found);
        return redirect()->to('/rh/dashboard')->with('success', 'Demande Approuvee');
    }


}
