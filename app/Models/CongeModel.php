<?php

namespace App\Models;

use CodeIgniter\Model;

class CongeModel extends Model
{
    protected $table = 'conges';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employe_id',
        'types_conge_id',
        'date_debut',
        'date_fin',
        'nb_jours',
        'motif',
        'statut',
        'commentaire_rh',
        'created_at',
        'traite_par'
    ];

    protected $returnType = 'array';

    protected $validationRules = [
        'employe_id' => [
            'label' => 'employé',
            'rules' => 'required|integer'
        ],
        'types_conge_id' => [
            'label' => 'type de congé',
            'rules' => 'required|integer'
        ],
        'date_debut' => [
            'label' => 'date de début',
            'rules' => 'required|valid_date'
        ],
        'date_fin' => [
            'label' => 'date de fin',
            'rules' => 'required|valid_date'
        ],
        'nb_jours' => [
            'label' => 'nombre de jours',
            'rules' => 'required|integer'
        ],
        'motif' => [
            'label' => 'motif',
            'rules' => 'permit_empty'
        ],
        'statut' => [
            'label' => 'statut',
            'rules' => 'required|max_length[255]'
        ],
        'commentaire_rh' => [
            'label' => 'commentaire RH',
            'rules' => 'permit_empty'
        ],
        'created_at' => [
            'label' => 'date de création',
            'rules' => 'permit_empty|valid_date'
        ],
        'traite_par' => [
            'label' => 'traité par',
            'rules' => 'permit_empty|integer'
        ],
    ];

    public function getCongeComplet($emp) {
        return $this->select('
                        conges.*,
                        employes.nom,
                        employes.prenom,
                        types_conge.libelle
                    ')
                    ->join('employes', 'employes.id = conges.employe_id')
                    ->join('types_conge', 'types_conge.id = conges.types_conge_id')
                    ->where('conges.employe_id', $emp)
                    ->findAll();
    }

    public function getCongeLast($idEmp) {
        return $this->select('
                        conges.*,
                        employes.nom,
                        employes.prenom,
                        types_conge.libelle
                    ')
                    ->join('employes', 'employes.id = conges.employe_id')
                    ->join('types_conge', 'types_conge.id = conges.types_conge_id')
                    ->where('conges.employe_id', $idEmp)
                    ->limit(3, 0)
                    ->findAll();
    }

    public function getCongeEnAttente()
    {
        return $this->select('
                        conges.*,
                        employes.nom,
                        employes.prenom,
                        types_conge.libelle,
                        (soldes.jours_attribues - soldes.jours_pris) as jours_reste
                    ')
                    ->join('employes', 'employes.id = conges.employe_id')
                    ->join('types_conge', 'types_conge.id = conges.types_conge_id')
                    ->join('soldes', 'soldes.employe_id = conges.employe_id AND soldes.types_conge_id=conges.types_conge_id')
                    ->where('conges.statut', 'En attente')
                    ->findAll();
    }

    public function getCongesByEmp($idEmp) {
        return $this->builder()
        ->select('statut')
        ->selectCount('conges.id', 'totalCount')
        ->groupBy('statut')
        ->where('conges.employe_id', $idEmp)
        ->get()
        ->getResultArray();
    }
    
    public function getAbsencesMoisEnCours() {
        return $this->selectSum('nb_jours')
                    ->where('statut', 'Valide')
                    ->where('strftime("%m", date_debut)', date('m'))
                    ->where('strftime("%Y", date_debut)', date('Y'))
                    ->first();
    }

    // Compte les demandes en attente de validation
    public function countEnAttente() {
        return $this->where('statut', 'en attente')->countAllResults();
    }

    // Compte les demandes approuvées pour le mois en cours
    public function countApprouveesMoisEnCours() {
        return $this->where('statut', 'approuvée')
                    ->where('strftime("%m", date_debut)', date('m'))
                    ->where('strftime("%Y", date_debut)', date('Y'))
                    ->countAllResults();
    }

    // Liste les congés validés en cours à la date d'aujourd'hui
    public function getAbsentsAujourdhui() {
        $aujourdhui = date('Y-m-d H:i:s');
        return $this->select('conges.*, employes.nom, employes.prenom, types_conge.libelle')
                    ->join('employes', 'employes.id = conges.employe_id')
                    ->join('types_conge', 'types_conge.id = conges.types_conge_id')
                    ->where('conges.statut', 'approuvée')
                    ->where('conges.date_debut <=', $aujourdhui)
                    ->where('conges.date_fin >=', $aujourdhui)
                    ->findAll();
    }

    // Récupère les 3 dernières demandes de congés (tous statuts confondus)
    public function getDemandesRecentes() {
        return $this->select('conges.*, employes.nom, employes.prenom, types_conge.libelle')
                    ->join('employes', 'employes.id = conges.employe_id')
                    ->join('types_conge', 'types_conge.id = conges.types_conge_id')
                    ->orderBy('conges.id', 'DESC')
                    ->findAll(3);
    }

}