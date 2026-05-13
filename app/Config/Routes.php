<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::loginForm');
$routes->post('/login', 'AuthController::login');

$routes->group('/employe', function($routes) {
    $routes->get('dashboard', 'EmployeController::home');
    $routes->get('new-demande', 'EmployeController::demandeForm');
    $routes->post('new-demande', 'EmployeController::submitDemande');
    $routes->get('demandes', 'EmployeController::getDemandes');
    $routes->get('profil', 'EmployeController::profile');
});

$routes->group('/rh', function($routes) {
    $routes->get('dashboard', 'RhController::home'); // Maka ny demande rehetra miaraka amin'ny statut
    $routes->post('demande/accept/(:num)', 'RhController::accept/$1');
    $routes->post('demande/deny/(:num)', 'RhController::deny/$1');
    $routes->get('demande/filter', 'RhController::filter'); // Maka url de type /rh/demande/filter?statut=approuve dia manao filtre
});

$routes->group('/admin', function($routes) {
    $routes->get('dashboard', 'AdminController::home'); // Obligatoire ny absence du mois en cours ;)
    $routes->get('employe', 'AdminController::getEmployes');
    $routes->get('employe/(:num)', 'AdminController::getEmploye/$1');
    $routes->post('employe/update/(:num)', 'AdminController::updateEmploye/$1');
    $routes->post('employe/delete/(:num)', 'AdminController::deleteEmploye/$1');
    $routes->get('deparment', 'AdminController::getDeparments');
    $routes->get('deparment/(:num)', 'AdminController::getDeparment/$1');
    $routes->post('deparment/update/(:num)', 'AdminController::updateDeparment/$1');
    $routes->post('deparment/delete/(:num)', 'AdminController::deleteDeparment/$1');
    $routes->get('typeconge', 'AdminController::getTypeconges');
    $routes->get('typeconge/(:num)', 'AdminController::getTypeconge/$1');
    $routes->post('typeconge/update/(:num)', 'AdminController::updateTypeconge/$1');
    $routes->post('typeconge/delete/(:num)', 'AdminController::deleteTypeconge/$1');
});