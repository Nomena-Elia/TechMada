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
        $data['employes'] = $model->getEmployesWithDepartment();
        $data['departments'] = $deptModel->findAll();

        return view('pages/admin/gestion-employes', $data);
    }


    public function getEmploye($id = null) {
        $model = new EmployesModel();
        $deptModel = new DepartmentModel();

        $data['employe'] = $model->find($id);
        $data['departments'] = $deptModel->findAll(); // Requis pour l'édition (changement de département)
        
        if (!$data['employe']) {
            return redirect()->to('/admin/employe')->with('errors', 'Employé introuvable');
        }
        return view('admin/employes/edit', ['data' => $data]);
    }

    public function addEmploye(){
        $model = new EmployesModel();
        $input = $this->request->getPost();
        $input['passwd'] = password_hash($input['passwd'], PASSWORD_DEFAULT);

        if(!$this->validate($model->getValidationRules()['register'])){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $model->setValidationRules($model->getValidationRules()['register'])->save($input);

        return redirect()->back()->withInput()->with('success', 'Employe cree avec succes');
    }

    public function updateEmploye(){
        $employeModel = new EmployeModel();
        $employe = $employeModel->find($this->request()->getPost('id'));
        if(!$this->validate($employeModel->getValidationRules()['register'])){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $input = $this->request()->getPost();
        $input['id'] = $employe;
        $employeModel->update($input);

        return redirect()->to('/admin/employe')->with('success', 'Employe #'+ $input['id'] +' modifie avec succes');
    }

    public function updateForm($id = null){
        $employeModel = new EmployeModel();
        $employe = $employeModel->find($id);
        session()->set('employe', $employe);
        return view('/pages/admin/update', ['employe' => $employe]);
    }

    public function deleteEmploye($id = null){
        $model = new EmployeModel();
        
    }

    public function getDemandes() {
        $conge = new CongeModel();
        $data = $conge->getCongeComplet(session()->get('user')['id']);
        return view('pages/admin/list-demande', ['activePage' => 'mes-demandes', 'data' => $data]);
    }
}
