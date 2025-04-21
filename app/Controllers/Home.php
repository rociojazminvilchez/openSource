<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index(): string
    {
        return view('inicio');
    }
   
        #USUARIO
        public function ingreso(){
            return view('formularios/ingreso');
        }
    
        public function login(){
            $usuario = $this->request->getPost('usuario');    
            $contra = $this->request->getPost('contra');
           
            $ingresoModel = new IngresoModel();
    
            $data = $ingresoModel->obtenerUsuario(['correo' => $usuario,'contraseña' => $contra]);
        
            if(count($data) > 0){
               // MANEJO DE SESION
               $data = [
                    'usuario' => $usuario,
                    'tipo' => 'Usuario',
               ];
                $session = session();
                $session -> set($data);
                
                return redirect()->to('inguz/index')->with('mensaje', '¡Bienvenido nuevamente!');
            }else{
                ?>
                
                <?php
               return redirect()->to('formularios/ingreso')->with('mensajeError', 'Datos incorrectos. Ingrese nuevamente'); 
            }
        }
    
        public function registro(){
            return view('formularios/registro');
        }

}
