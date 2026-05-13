<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeCongeModel extends Model
{
    protected $table = 'types_conge';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'libelle',
        'jours_annuels',
        'deductible'
    ];

    protected $returnType = 'array';

    protected $validationRules = [
        'libelle' => [
            'label' => 'libellé',
            'rules' => 'required|max_length[255]'
        ],
        'jours_annuels' => [
            'label' => 'jours annuels',
            'rules' => 'required|integer'
        ],
        'deductible' => [
            'label' => 'deductible',
            'rules' => 'required|integer'
        ]
    ];
    
}