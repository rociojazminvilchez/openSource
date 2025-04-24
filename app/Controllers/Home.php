<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\IngresoModel;
use App\Models\RegistroUsuarioModel;
use App\Models\RegistroTareaModel;
use App\Models\RegistroSubtareaModel;
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
        $data = $ingresoModel->obtenerUsuario(['correo' => $usuario,'contra' => $contra]);
        
        if(count($data) > 0){
        // MANEJO DE SESION
            $data = [
                'usuario' => $usuario,
            ];
            $session = session();
            $session -> set($data);
                
            return redirect()->to('/')->with('mensaje', '¡Bienvenido nuevamente!');
        }else{
        ?> <?php
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Datos incorrectos. Ingrese nuevamente'); 
        }
    }

#PERFIL USUARIO
    public function perfil(){
        if (session()->has('usuario')) {
            $usuario= $_SESSION['usuario'];
        }
     $registrousuarioModel = new RegistroUsuarioModel();
     $data = [
        'usuario' => $registrousuarioModel->obtenerUsuario(['correo'=>$usuario]),
    ];
    return view ('/perfil', $data);
   }

   public function update(){
    $reglas = [
        'nombre' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El campo nombre es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 3 caracteres.'
           ]
        ],
        'apellido' => [
            'rules' => 'required|min_length[3]',
            'errors' => [
                'required' => 'El campo apellido es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 3 caracteres.'
           ]
        ],
        'contra'     => [
            'rules' => 'required|min_length[7]',
            'errors' => [
                'required' => 'La contraseña es obligatoria.',
                'min_length' => 'La contraseña debe tener al menos 7 caracteres.'
            ]
        ],
        'contra2' => [ 
            'rules' => 'required|matches[contra]',
            'errors' => [
                'required' => 'Debes confirmar la contraseña.',
                'matches' => 'Las contraseñas no coinciden.'
           ]
       ],
    ];
    
    // Si la validación falla, redirigir de vuelta con los datos ingresados
   
    if (!$this->validate($reglas)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    
    $post = $this->request->getPost(['nombre', 'apellido', 'email','contra','contra2']);    
    $correo=$post['email'];
    $registroUsuarioModel = new RegistroUsuarioModel();

    $registroUsuarioModel->update($correo,[
        'nombre' => ucfirst(trim($post['nombre'])),
        'apellido' => ucfirst(trim($post['apellido'])),
        'correo' => $post['email'],
        'contra' => $post['contra'],
        'contra2' => $post['contra2'],
    ]);
       
return redirect()->to('/')->with('mensaje', 'Perfil actualizado exitosamente.');
}
#REGISTRAR USUARIO
    public function registro(){
        return view('formularios/registro');
    }

    public function create(){
        $reglas = [
            'nombre' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo nombre es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.'
               ]
            ],
            'apellido' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo apellido es obligatorio.',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres.'
               ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[registro_usuario.correo]',
                'errors' => [
                    'required' => 'El campo email es obligatorio.',
                    'valid_email' => 'Debes proporcionar un correo electrónico válido.',
                     'is_unique' => 'Este correo electrónico ya está registrado.'
                ]
            ],
            'contra'     => [
                'rules' => 'required|min_length[7]',
                'errors' => [
                    'required' => 'La contraseña es obligatoria.',
                    'min_length' => 'La contraseña debe tener al menos 7 caracteres.'
                ]
            ],
            'contra2' => [ 
                'rules' => 'required|matches[contra]',
                'errors' => [
                    'required' => 'Debes confirmar la contraseña.',
                    'matches' => 'Las contraseñas no coinciden.'
               ]
           ],
        ];
        
        // Si la validación falla, redirigir de vuelta con los datos ingresados
       
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $post = $this->request->getPost(['nombre', 'apellido', 'email','contra','contra2']);    
        $registroUsuarioModel = new RegistroUsuarioModel();

        $registroUsuarioModel->insert([
            'nombre' => ucfirst(trim($post['nombre'])),
            'apellido' => ucfirst(trim($post['apellido'])),
            'correo' => $post['email'],
            'contra' => $post['contra'],
            'contra2' => $post['contra2'],
        ]);
           
    return redirect()->to('/')->with('mensaje', 'Usuario registrado exitosamente.');
   }

#Formularios - Tareas | Subtarea
    public function tarea() {
        return view('formularios-tarea/tarea');
    }   

    public function subtarea() {
        return view('formularios-tarea/subtarea');
    }  

#Menu
    public function panel() {
        $RegistroTareaModel = new RegistroTareaModel();
        if (session()->has('usuario')) {
            $correo= $_SESSION['usuario'];
          }
        $data = [
            'tareas' => $RegistroTareaModel->mostrarTarea(['correo'=>$correo])
        ];
        return view('menu/panel',$data);
    }   

    public function tareas() {
        $RegistroTareaModel = new RegistroTareaModel();
        if (session()->has('usuario')) {
            $correo= $_SESSION['usuario'];
          }
        
    $ordenarPor = $this->request->getGet('ordenar') ?? 'fecha_vencimiento';  

    $columnasPermitidas = ['fecha_vencimiento', 'prioridad', 'estado'];
    if (!in_array($ordenarPor, $columnasPermitidas)) {
        $ordenarPor = 'fecha_vencimiento'; 
    }

    $data = [
        'tareas' => $RegistroTareaModel->mostrarTarea(['correo' => $correo, 'ordenar' => $ordenarPor])
    ];

        return view('menu/tareas',$data);
    }   

    public function subtareas() {
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        if (session()->has('usuario')) {
            $correo= $_SESSION['usuario'];
          }
        $data = [
            'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable'=>$correo])
        ];
        return view('menu/subtareas',$data);
    } 

    public function historial() {
        $RegistroTareaModel = new RegistroTareaModel();
        if (session()->has('usuario')) {
            $correo= $_SESSION['usuario'];
        }

        $data1 = [
            'tareas' => $RegistroTareaModel->mostrarTarea(['correo'=>$correo])

        ];

        $RegistroSubtareaModel = new RegistroSubtareaModel();
        
        $data2 = [
            'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable'=>$correo])
        ];

        $data = array_merge($data1, $data2);
        return view('menu/historial',$data);
    }   

#SALIR
    public function salir() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }   
}
