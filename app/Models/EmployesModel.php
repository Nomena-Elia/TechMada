<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class EmployesModel extends Model{
        protected $table = "employes";
        protected $id = "id";
        protected $allowedFields = "nom, prenom, email, passwd, role, departement_id, date_embauche, actif";
        
        protected $returnType = 'array';

        protected $validationRules = [
            'nom' =>[
                'label' => 'nom',
                'rules' => 'required|min_length[2]|max_length[255]'
            ] ,
            'prenom' => [
                'label' => 'prenom',
                'rules' => 'required|min_length[2]|max_length[255]'
            ],
            'email' => [
                'label' => 'email',
                'rules' => 'required|valid_email|is_unique[employes.email,id,{id}]'
            ],
            'passwd' => [
                'label' => 'mot de passe',
                'rules' => 'required|min_length[6]'
            ],
            'role' => [
                'label' => 'role',
                'rules' => 'required|max_length[255]'
            ],
            'department_id' => [
                'label' => 'departement',
                'rules' => 'required|integer'
            ],
            'date_embauche' => [
                'label' => 'date d\'embauche',
                'rules' => 'required|valid_date'
            ],
            'actif' => [
                'label' => 'actif',
                'rules' => 'required|integer'
            ]
        ];

        public function getEmployesWithDepartment()
        {
            return $this->select('employes.*, departments.nom as department_nom')
                        ->join('departments', 'departments.id = employes.department_id', 'left')
                        ->findAll();
        }

    }
    

?>