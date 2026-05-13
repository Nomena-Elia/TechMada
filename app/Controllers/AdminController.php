<?php 
namespace App\Controllers;

use App\Models\EmployesModel;
use App\Models\DepartmentModel; // Utilisation exacte de DepartmentModel (singulier)
use App\Models\TypeCongeModel;
use App\Models\CongeModel;

class AdminController extends BaseController {
    
    public function home() {
        $employeModel = new EmployesModel();
        $departmentModel = new DepartmentModel();
        $congeModel = new CongeModel();

        $absentsAujourdhui = $congeModel->getAbsentsAujourdhui();

        $data = [
            'total_actifs'         => $employeModel->countActifs(),
            'nouveaux_ce_mois'     => $employeModel->getNouveauxCeMois(),
            'en_attente'           => $congeModel->countEnAttente(),
            'approuvees_ce_mois'   => $congeModel->countApprouveesMoisEnCours(),
            'total_departments'    => $departmentModel->countAllResults(),
            'total_absents'        => count($absentsAujourdhui),
            'demandes_recentes'    => $congeModel->getDemandesRecentes(),
            'absents_aujourdhui'   => $absentsAujourdhui,
            'soldes_critiques'     => $employeModel->getSoldesCritiques()
        ];
        
        return view('pages/admin/dashboard-admin', $data);
    }

    public function getEmployes() {
        $model = new EmployesModel();
        $deptModel = new DepartmentModel();

        $data['roles'] = $model->getEmployeRole();
        // Utilise la jointure dynamique écrite dans votre modèle pour charger le département de chaque employé
        $data['employes'] = $model->getEmployesWithDepartment();
        
        // Transmet obligatoirement la liste des départements pour remplir le select de votre vue gestion-employes
        $data['departments'] = $deptModel->findAll();


        return view('pages/admin/gestion-employes', $data);
    }


    public function getEmploye($id = null) {
        $model = new EmployesModel();
        $deptModel = new DepartmentModel();

        $data['employe'] = $model->find($id);
        $data['departments'] = $deptModel->findAll(); // Requis pour l'édition (changement de département)
        
        if (!$data['employe']) {
            return redirect()->to('/admin/employe')->with('error', 'Employé introuvable');
        }
        return view('admin/employes/edit', $data);
    }

    public function storeEmploye() {
        $model = new EmployesModel();
        $input = $this->request->getPost();

        // Traitement sécurisé du mot de passe
        if (!empty($input['passwd'])) {
            $input['passwd'] = password_hash($input['passwd'], PASSWORD_DEFAULT);
        }
        
        // Initialisations obligatoires vis-à-vis de la structure SQL (actif = 1)
        $input['actif'] = 1;

        // Force l'application du sous-groupe de règles "register" défini dans votre EmployesModel
        $model->setValidationGroup('register');

        if ($model->insert($input)) {
            return redirect()->to('/admin/employe')->with('success', 'Employé créé avec succès');
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }

    public function updateEmploye($id = null) {
        $model = new EmployesModel();
        $input = $this->request->getPost();
        
        // Extrait le tableau de règles du groupe 'register' pour nettoyer dynamiquement la validation
        $rules = $model->getValidationRules()['register'];

        if (!empty($input['passwd'])) {
            $input['passwd'] = password_hash($input['passwd'], PASSWORD_DEFAULT);
        } else {
            unset($input['passwd']);
            unset($rules['passwd']); // Permet de soumettre sans être bloqué par la règle 'required' du mot de passe
        }

        // Valide les données nettoyées manuellement avant mise à jour en base
        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if ($model->update($id, $input)) {
            return redirect()->to('/admin/employe')->with('success', 'Employé mis à jour avec succès');
        }
        return redirect()->back()->withInput()->with('errors', $model->errors());
    }

    public function deleteEmploye($id = null) {
        $model = new EmployesModel();
        
        // Optionnel : Si vous préférez une désactivation logique à une suppression physique :
        // $model->update($id, ['actif' => 0]);

        if ($model->delete($id)) {
            return redirect()->to('/admin/employe')->with('success', 'Employé supprimé avec succès');
        }
        return redirect()->to('/admin/employe')->with('error', 'Erreur lors de la suppression');
    }

    // GET /admin/deparment
    // public function getDeparments() {
    //     $model = new DepartmentModel();
    //     $data['departments'] = $model->findAll();
    //     return view('admin/departments/index', $data);
    // }

    // // GET /admin/deparment/(:num)
    // public function getDeparment($id = null) {
    //     $model = new DepartmentModel();
    //     $data['department'] = $model->find($id);
        
    //     if (!$data['department']) {
    //         return redirect()->to('/admin/deparment')->with('error', 'Département introuvable');
    //     }
    //     return view('admin/departments/edit', $data);
    // }

    // // POST /admin/deparment/update/(:num)
    // public function updateDeparment($id = null) {
    //     $model = new DepartmentModel();
    //     if ($model->update($id, $this->request->getPost())) {
    //         return redirect()->to('/admin/deparment')->with('success', 'Département mis à jour avec succès');
    //     }
    //     return redirect()->back()->withInput()->with('errors', $model->errors());
    // }

    // // POST /admin/deparment/delete/(:num)
    // public function deleteDeparment($id = null) {
    //     $model = new DepartmentModel();
    //     if ($model->delete($id)) {
    //         return redirect()->to('/admin/deparment')->with('success', 'Département supprimé avec succès');
    //     }
    //     return redirect()->to('/admin/deparment')->with('error', 'Erreur lors de la suppression');
    // }

    // // GET /admin/typeconge
    // public function getTypeconges() {
    //     $model = new TypeCongeModel();
    //     $data['types_conge'] = $model->findAll();
    //     return view('admin/typeconge/index', $data);
    // }

    // // GET /admin/typeconge/(:num)
    // public function getTypeconge($id = null) {
    //     $model = new TypeCongeModel();
    //     $data['type_conge'] = $model->find($id);
        
    //     if (!$data['type_conge']) {
    //         return redirect()->to('/admin/typeconge')->with('error', 'Type de congé introuvable');
    //     }
    //     return view('admin/typeconge/edit', $data);
    // }

    // // POST /admin/typeconge/update/(:num)
    // public function updateTypeconge($id = null) {
    //     $model = new TypeCongeModel();
    //     if ($model->update($id, $this->request->getPost())) {
    //         return redirect()->to('/admin/typeconge')->with('success', 'Type de congé mis à jour avec succès');
    //     }
    //     return redirect()->back()->withInput()->with('errors', $model->errors());
    // }

    // // POST /admin/typeconge/delete/(:num)
    // public function deleteTypeconge($id = null) {
    //     $model = new TypeCongeModel();
    //     if ($model->delete($id)) {
    //         return redirect()->to('/admin/typeconge')->with('success', 'Type de congé supprimé avec succès');
    //     }
    //     return redirect()->to('/admin/typeconge')->with('error', 'Erreur lors de la suppression');
    // }
}
