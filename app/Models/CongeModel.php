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

    public function getCongeComplet()
    {
        return $this->select('
                        conges.*,
                        employes.nom,
                        employes.prenom,
                        types_conge.libelle
                    ')
                    ->join('employes', 'employes.id = conges.employe_id')
                    ->join('types_conge', 'types_conge.id = conges.types_conge_id')
                    ->findAll();
    }
    

}