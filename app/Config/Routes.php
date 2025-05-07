<?php

use CodeIgniter\Router\RouteCollection;

/*Pagina principal*/
$routes->get('/', 'Home::index');

#IniciarSesion
$routes->get('/formularios/ingreso', 'Home::ingreso');
$routes->post('/home/login', 'Home::login');

#PerfilUsuario
$routes->get('/perfil','Home::perfil');
$routes->post('/perfil', 'Home::update'); 

#REGISTRO
$routes->get('/formularios/registro', 'Home::registro');
$routes->get('/home/create', 'Home::create');
$routes->post('/home/create', 'Home::create'); 

#Menu
$routes->get('/menu/panel', 'Home::panel');
$routes->get('/menu/panel_completo/(:num)/(:num)', 'Home::panelCompleto/$1/$2');
$routes->get('/menu/tareas', 'Home::tareas');
$routes->get('/menu/subtareas', 'Home::subtareas');
$routes->get('/menu/historial_tareas', 'Home::historial');
$routes->get('/menu/historial_subtareas', 'Home::historial_subtarea');

#Formulario - Tarea
$routes->get('/formularios-tarea/tarea', 'Home::tarea');
$routes->get('/tareas/create', 'Tareas::create');
$routes->post('/tareas/create', 'Tareas::create'); 

#Formulario - SubTarea
$routes->get('/formularios-tarea/subtarea', 'Home::subtarea');
$routes->get('/subtareas/create', 'Subtareas::create');
$routes->post('/subtareas/create', 'Subtareas::create'); 

#Eliminar - Tarea
$routes->get('/menu/tareas', 'Tareas::index');
$routes->get('/menu/tareas/(:num)','Tareas::eliminarTarea/$1');

#Modificar - Tarea
$routes->get('menu/tarea/(:num)', 'Tareas::tarea/$1');
$routes->post('menu/tareas/update/(:num)', 'Tareas::update/$1');

#Archivar - Tarea
$routes->get('/menu/panel_completo', 'Tareas::index'); // Ruta para panel completo
$routes->get('/menu/panel_completo/(:num)', 'Tareas::archivarTarea/$1'); // Ruta para archivar tarea

#Modificar - SubTarea
$routes->get('menu/subtarea/(:num)', 'Subtareas::subtarea/$1');
$routes->post('menu/subtareas/update/(:num)', 'Subtareas::update/$1');

#Actualizar - Subtarea y Tarea
$routes->get('/menu/subtareas', 'Subtareas::index');
$routes->get('/menu/subtareas/(:num)/(:num)','Subtareas::actualizarSubtarea/$1/$2');

#Salir
$routes->get('/salir', 'Home::salir');

#COMPARTIR
$routes->post('ShareController/share_task', 'ShareController::share_task', ['as' => 'share_task']);