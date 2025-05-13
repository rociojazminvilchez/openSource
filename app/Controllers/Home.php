<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\IngresoModel;
use App\Models\RegistroUsuarioModel;
use App\Models\RegistroTareaModel;
use App\Models\RegistroSubtareaModel;

class Home extends Controller{
    public function index(): string{
        //Activacion de evento
        $registroTareaModel = new RegistroTareaModel();
        $registroTareaModel->marcarTareasVencidas();
        return view('inicio');
    }

#USUARIO
    public function ingreso(){
      return view('formularios/ingreso');
    }
    
    public function login(){
    $usuario = $this->request->getPost('usuario');    
    $contra = $this->request->getPost('contra');
       
    $registroUsuarioModel = new RegistroUsuarioModel();
    $data = $registroUsuarioModel->obtenerUsuario([
        'correo' => $usuario,
        'contra' => $contra
    ]);

    if (!empty($data) && is_array($data)) {
        // Iniciar sesión
        $session = session();
        $session->set([
            'usuario'  => $data[0]['correo'], 
            'logueado' => true
        ]);

        return redirect()->to('/')->with('mensaje', '¡Bienvenido!');
    } else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Datos incorrectos. Ingrese nuevamente.');
    }
    }

#PERFIL USUARIO
    public function perfil(){
    $session = session();
    if (session()->has('usuario')) {
        $usuario = $session->get('usuario');
        $registrousuarioModel = new RegistroUsuarioModel();
        $data = [
            'usuario' => $registrousuarioModel->obtenerUsuario(['correo'=>$usuario]),
        ];
      return view('perfil', $data);
    } else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para ver tu perfil.');
    }
   }

#ACTUALIZAR PERFIL USUARIO
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
           
    return redirect()->to('/formularios/ingreso')->with('mensaje', 'Usuario registrado exitosamente.');
}

#Formularios - Tareas | Subtarea
    public function tarea() {
        return view('formularios-tarea/tarea');
    }   

    public function subtarea() {
        $RegistroTareaModel = new RegistroTareaModel();
        $session = session();
        if (session()->has('usuario')) {
            $correo = $session->get('usuario');
        }else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder a las subtareas.');
        }

        $data = [
            'tareas' => $RegistroTareaModel->seleccionarTarea(['correo'=>$correo]),
            'estado_actualizado_vacio' => true
        ];
        return view('formularios-tarea/subtarea',$data);
    }  

#PANEL PRINCIPAL (color)
    public function panel() {
        $RegistroTareaModel = new RegistroTareaModel();
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        $session = session();
        if (session()->has('usuario')) {
           $correo = $session->get('usuario');
        }else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel.');
        }

        $data = [
            'tareas' => $RegistroTareaModel->mostrarTarea(['correo'=>$correo]),
            'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable'=>$correo])
        ];

        return view('menu/panel',$data);
    }   

#PANEL TAREA|SUBTAREA
    public function panelCompleto($tarea, $subtarea) {
        $RegistroTareaModel = new RegistroTareaModel();
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        $session = session();
        if (session()->has('usuario')) {
            $correo = $session->get('usuario');
        }else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel.');
        }

        $data = [
            'tareas' => $RegistroTareaModel->mostrarTareaID([
                'correo' => $correo,
                'id'       => $tarea
            ]),
            'subtareas' => $RegistroSubtareaModel->mostrarSubtareaID([
                'tarea'       => $subtarea
            ]),
        ];
        return view('menu/panel_completo',$data);
    }   

    public function tareas() {
        $RegistroTareaModel = new RegistroTareaModel();
        $RegistroSubtareaModel = new RegistroSubtareaModel();

        $session = session();
        if (session()->has('usuario')) {
            $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de tareas.');
        }
        
    $ordenarPor = $this->request->getGet('ordenar') ?? 'fecha_vencimiento';  

    $columnasPermitidas = ['fecha_vencimiento', 'prioridad', 'estado'];
    if (!in_array($ordenarPor, $columnasPermitidas)) {
        $ordenarPor = 'fecha_vencimiento'; 
    }

    $data = [
        'tareas' => $RegistroTareaModel->mostrarTarea(['correo' => $correo, 'ordenar' => $ordenarPor]),
        'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable'=>$correo]),
    ];

        return view('menu/tareas',$data);
    }   

    public function subtareas() {
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        $session = session();
        if (session()->has('usuario')) {
           $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de subtareas.');
        }

        $data = [
            'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable'=>$correo])
        ];
        return view('menu/subtareas',$data);
    } 

    public function historial() {
        $RegistroTareaModel = new RegistroTareaModel();
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        $session = session();
        if (session()->has('usuario')) {
              $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al historial.');
        }
        $ordenarPor = $this->request->getGet('ordenar') ?? 'fecha_vencimiento';  

        $columnasPermitidas = ['fecha_vencimiento', 'estado'];
        if (!in_array($ordenarPor, $columnasPermitidas)) {
            $ordenarPor = 'fecha_vencimiento'; 
        }
    
        $data = [
            'tareas' => $RegistroTareaModel->mostrarTarea(['correo' => $correo, 'ordenar' => $ordenarPor]),
            'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable' => $correo, 'ordenar' => $ordenarPor])
        ];

        return view('menu/historial_tareas',$data);
    }   

    public function historial_subtarea() {
        $session = session();
        if (session()->has('usuario')) {
             $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al historial.');
        }

        $RegistroSubtareaModel = new RegistroSubtareaModel();
        
        $ordenarPor = $this->request->getGet('ordenar') ?? 'fecha_vencimiento';  

        $columnasPermitidas = ['fecha_vencimiento', 'prioridad', 'estado'];
        if (!in_array($ordenarPor, $columnasPermitidas)) {
            $ordenarPor = 'fecha_vencimiento'; 
        }
    
        $data = [
            'subtareas' => $RegistroSubtareaModel->mostrarSubtarea(['responsable' => $correo, 'ordenar' => $ordenarPor])
        ];
    
        return view('menu/historial_subtareas',$data);
    }   

#SALIR
    public function salir() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }   
}
