<?php

    namespace App\Models;
    use CodeIgniter\Model;

    class EmployesModel extends Model{
        protected $table = "employes";
        protected $id = "id";
        protected $allowedFields = "nom, prenom, email, passwd, role, departement_id, date_embauche, actif";
        
        protected $returnType = 'array';

        protected $validationRules = [
            'register' => [
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
                ],
            ],
            'login' => [
                'email' => [
                    'label' => 'email',
                    'rules' => 'required|valid_email'
                ],
                'passwd' => [
                    'label' => 'mot de passe',
                    'rules' => 'required|min_length[6]'
                ],
            ]
        ];

        public function getEmployesWithDepartment()
        {
            return $this->select('employes.*, departments.nom as department_nom')
                        ->join('departments', 'departments.id = employes.department_id', 'left')
                        ->findAll();
        }

        // Compte le nombre total d'employés actifs
        public function countActifs() {
            return $this->where('actif', 1)->countAllResults();
        }

        // Récupère le nombre d'employés ajoutés durant le mois en cours
        public function getNouveauxCeMois() {
            return $this->where('actif', 1)
                        ->where('strftime("%m", date_embauche)', date('m'))
                        ->where('strftime("%Y", date_embauche)', date('Y'))
                        ->countAllResults();
        }

        // Récupère les employés ayant un solde global critique de congés (ex: cumul jours_attribues - jours_pris <= 2)
        public function getSoldesCritiques() {
            $db = \Config\Database::connect();
            return $db->table('soldes')
                    ->select('employe_id')
                    ->groupBy('employe_id')
                    ->having('SUM(jours_attribues) - SUM(jours_pris) <=', 2)
                    ->countAllResults();
        }

        public function getEmployeRole(){
            $db = \Config\Database::connect();
            $resultats = $this->distinct()
                                ->select('role')
                                ->where('role IS NOT NULL')
                                ->where('role !=', '')
                                ->findAll();

                return array_column($resultats, 'role');
        }

    }
    

?>