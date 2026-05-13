<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'description'
    ];

    protected $returnType = 'array';

    protected $validationRules = [

        'nom' =>[
            'label' => 'nom',
            'rules' => 'required|min_length[2]|max_length[255]'
        ],
        'description' => [
            'label' => 'description',
            'rules' => 'permit_empty|max_length[500]'
        ]
    ];
    

}