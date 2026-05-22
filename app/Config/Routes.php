<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::loginForm');
$routes->get('/register', 'AuthController::registerForm');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/register', 'AuthController::register');

$routes->group('/employe', ['filter' => 'role:ADMIN,EMPLOYE,RH'], function($routes) {
    $routes->get('dashboard', 'EmployeController::home');
    $routes->get('new-demande', 'EmployeController::demandeForm');
    $routes->post('new-demande', 'EmployeController::submitDemande');
    $routes->get('demandes', 'EmployeController::getDemandes');
    $routes->get('profil', 'EmployeController::profile');
    $routes->get('calendar', 'EmployeController::renderCalendar');
});

$routes->group('/rh', ['filter' => 'role:RH'], function($routes) {
    $routes->get('dashboard', 'RhController::home'); // Maka ny demande rehetra miaraka amin'ny statut
    $routes->post('demande/accept/(:num)', 'RhController::accept/$1');
    $routes->post('demande/deny/(:num)', 'RhController::deny/$1');
    $routes->get('demande/filter', 'RhController::filter'); // Maka url de type /rh/demande/filter?statut=approuve dia manao filtre
});

$routes->group('/admin', ['filter' => 'role:ADMIN'], function($routes) {
    $routes->get('dashboard', 'AdminController::home'); // Obligatoire ny absence du mois en cours ;) //ok
    $routes->get('employe', 'AdminController::getEmployes'); //ok
    $routes->get('employe/(:num)', 'AdminController::getEmploye/$1'); 
    $routes->post('employe/add', 'AdminController::addEmploye');
    $routes->get('employe/update/(:num)', 'AdminController::updateEmployeForm/$1');
    $routes->post('employe/updated/(:num)', 'AdminController::updateEmploye/$1');
    $routes->get('employe/delete/(:num)', 'AdminController::deleteEmploye/$1');
    $routes->get('employe/reactivate/(:num)', 'AdminController::reactivateEmploye/$1');
    $routes->get('department', 'AdminController::getDepartments');
    $routes->post('department/add', 'AdminController::addDepartment');
    $routes->get('department/(:num)', 'AdminController::getDepartment/$1');
    $routes->post('department/update/(:num)', 'AdminController::updateDepartment/$1');
    $routes->get('department/delete/(:num)', 'AdminController::deleteDepartment/$1');
    $routes->get('typeconge', 'AdminController::getTypeconges');
    $routes->get('typeconge/(:num)', 'AdminController::getTypeconge/$1');
    $routes->post('typeconge/update/(:num)', 'AdminController::updateTypeconge/$1');
    $routes->post('typeconge/delete/(:num)', 'AdminController::deleteTypeconge/$1');
    $routes->get('demande', 'AdminController::getDemandes');
    $routes->get('tableau-bord', 'AdminChartController::CongeMois');
});
