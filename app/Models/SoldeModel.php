<?php

namespace App\Models;

use CodeIgniter\Model;

class SoldeModel extends Model
{
    protected $table = 'soldes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'employe_id',
        'types_conge_id',
        'annee',
        'jours_attribues',
        'jours_pris'
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
        'annee' => [
            'label' => 'année',
            'rules' => 'required|integer'
        ],
        'jours_attribues' => [
            'label' => 'jours attribués',
            'rules' => 'required|integer'
        ],
        'jours_pris' => [
            'label' => 'jours pris',
            'rules' => 'required|integer'
        ]
    ];

    public function getSoldesComplets()
    {
        return $this->select('
                        soldes.*,
                        employes.nom,
                        employes.prenom,
                        types_conge.libelle
                    ')
                    ->join('employes', 'employes.id = soldes.employe_id')
                    ->join('types_conge', 'types_conge.id = soldes.types_conge_id')
                    ->findAll();
    }

    
}