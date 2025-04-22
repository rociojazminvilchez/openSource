<?php

use CodeIgniter\Router\RouteCollection;

/*Pagina principal*/
$routes->get('/', 'Home::index');

#IniciarSesion
$routes->get('/formularios/ingreso', 'Home::ingreso');
$routes->post('/home/login', 'Home::login');

#REGISTRO
$routes->get('/formularios/registro', 'Home::registro');
$routes->get('/home/create', 'Home::create');
$routes->post('/home/create', 'Home::create'); 