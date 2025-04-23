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


#Menu
$routes->get('/menu/panel', 'Home::panel');
$routes->get('/menu/tareas', 'Home::tareas');
$routes->get('/menu/subtareas', 'Home::tareas');
$routes->get('/menu/historial', 'Home::historial');

#Formulario - Tarea
$routes->get('/formularios-tarea/tarea', 'Home::tarea');
$routes->get('/tareas/create', 'Tareas::create');
$routes->post('/tareas/create', 'Tareas::create'); 

#Formulario - SubTarea
$routes->get('/formularios-tarea/subtarea', 'Home::subtarea');
$routes->get('/subtareas/create', 'Subtareas::create');
$routes->post('/subtareas/create', 'Subtareas::create'); 

#Salir
$routes->get('/salir', 'Home::salir');