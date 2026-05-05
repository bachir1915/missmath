<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//routes publiques  ( sans authentification )
$routes->get('/', 'InscriptionController::index');
$routes->post('/register', 'InscriptionController::submit');
$routes->get('/ticket/(:segment)', 'InscriptionController::success/$1');
$routes->post('/ticket/(:segment)/send-email', 'InscriptionController::sendEmailAjax/$1');

// Authentification
$routes->get('/login', 'AuthentificationController::index');
$routes->post('/login', 'AuthentificationController::login');
$routes->get('/logout', 'AuthentificationController::logout');

/* Route de vérification hybride
match(['get', 'post']) : Elle accepte les deux méthodes.
GET : C'est ce qui arrive quand on scanne le QR Code avec un téléphone.
POST : C'est utile si on utilise une application de scan spécifique qui envoie des données
admin/verify-scan : C'est l'adresse (URL) qui est écrite à l'intérieur du QR Code de chaque invité
En somme :si ladmin scanne les Qr code ce dernier est valide si le user scann il doit juste voir ses infos 
 */
$routes->match(['get', 'post'], 'admin/verify-scan', 'VerificationController::checkTicket');

$routes->addRedirect('admin', 'admin/dashboard');

// Admin routes:les pages des admins sont protegees par l'authentification
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('invites/validate-all', 'InviteController::validateAll');
    $routes->get('invites/(:num)/validate', 'InviteController::confirmEntry/$1');
    $routes->get('invites/(:num)/cancel', 'InviteController::cancel/$1');
    $routes->get('invites/exportCSV', 'InviteController::exportCSV');
    $routes->resource('invites', ['controller' => 'InviteController']);
    $routes->resource('users', ['controller' => 'AdminController']);
    $routes->get('scanner', 'DashboardController::scanner');
    $routes->get('logs', 'DashboardController::logs');
});
