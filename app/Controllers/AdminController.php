<?php 
namespace App\Controllers;

use App\Models\EmployesModel;
use App\Models\DepartmentModel; // Utilisation exacte de DepartmentModel (singulier)
use App\Models\TypeCongesModel;
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
        $employeModel = new EmployesModel();
        $employe = $this->request->getPost('id');
        // if(!$this->validate($employeModel->getValidationRules()['register'])){
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        if(!$employe){
            return redirect()->back()->withInput()->with('errors', "id Employe Manquant");
        }

        $input = $this->request->getPost();
        $input['id'] = $employe;
        $employeModel->update($input['id'], [
            'prenom' => $input['prenom'],
            'nom' => $input['nom'],
            'email' => $input['email'],
            'department_id' => $input['department_id'],
            'role' => $input['role'],
            'date_embauche' => $input['date_embauche'],
            'actif' => $input['actif'] ?? 0
        ]);

        return redirect()->back()->withInput()->with('success', 'Employe modifie avec succes');
    }

    public function updateEmployeForm($id = null){
        $employeModel = new EmployesModel();
        $deptModel = new DepartmentModel();

        $data['roles'] = $employeModel->getEmployeRole();
        $data['departments'] = $deptModel->findAll();
        $data['employe'] = $employeModel->find($id);

        // session()->set('employe', $data['employe']);
        return view('/pages/admin/edit-employe', $data);
    }

    public function deleteEmploye($id = null){
        $model = new EmployesModel();

        if(!$id){
            return redirect()->back()->withInput()->with('errors', 'id Employe introuvable');
        }
        $employe = $model->find($id);
        $model->update($employe['id'], [
            'actif' => 0
        ]);

        return redirect()->back()->withInput()->with('success', 'Employe desactive');
    }

    public function reactivateEmploye($id = null){
        $model = new EmployesModel();

        if(!$id){
            return redirect()->back()->withInput()->with('errors', 'id Employe introuvable');
        }
        $employe = $model->find($id);
        $model->update($employe['id'], [
            'actif' => 1
        ]);

        return redirect()->back()->withInput()->with('success', 'Employe reactivate');
    }

    public function getDemandes() {
        $conge = new CongeModel();
        $data = $conge->getCongeComplet(session()->get('user')['id']);
        return view('pages/admin/list-demande', ['activePage' => 'mes-demandes', 'data' => $data]);
    }

    public function getDepartments(){
        $deptModel = new DepartmentModel();
        $data['departments'] = $deptModel->findAll();

        return view('pages/admin/gestion-departments', $data);
    }

    public function getDepartment($id = null){
        $model = new DepartmentModel();
        $dept = $model->find($id);

        return view('pages/admin/edit-department', ['dept' => $dept]);
    }

    public function addDepartment(){
        $model = new DepartmentModel();
        $input = $this->request->getPost();

        if(!$this->validate($model->getValidationRules())){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->save($input);
        return redirect()->back()->withInput()->with('success', 'Department saved successfully !');
    }

    public function updateDepartment(){
        $model = new DepartmentModel();
        $input = $this->request->getPost();

        if(!$input['id']){
            return rediret()->back()->withInput()->with('errors', 'Departement introuvable');
        }

        $model->update($input['id'], [
            'nom' => $input['nom'],
            'description' => $input['description']
        ]);

        return redirect()->back()->withInput()->with('success', 'Department updated successfully !');
    }

    public function deleteDepartment($id = null){
        $model = new DepartmentModel();
        $model->delete($id);

        return redirect()->back()->withInput()->with('success', 'Department deleted');
    }

    public function getTypeConges(){
        $model = new TypeCongesModel();
        $data['types'] = $model->findAll();

        return view('pages/admin/typeConges', $data);
    }

    public function getTypeConge($id = null){
        $model = new TypeCongesModel();
        $type = $model->find($id);

        if(!$type['id']){
            return redirect()->back()->withInput()->with('errors', 'id introuvable');
        }

        return view('pages/admin/edit-typeConges', $type);
    }
}
