<?php

namespace App\Controllers;
use App\Models\RegistroSubtareaModel;
use App\Models\RegistroTareaModel;

class Subtareas extends BaseController{

#SUBTAREA - FORMULARIO
    public function create(){
        $reglas = [
           'descripcion' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo descripcion es obligatorio.',
                    'min_length' => 'La descripcion debe tener al menos 3 caracteres.'
               ]
            ],
            'comentario' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo comentario es obligatorio.',
                    'min_length' => 'La comentario debe tener al menos 3 caracteres.'
               ]
            ],
            'usuario' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El campo responsable es obligatorio.',
                    'valid_email' => 'Debes proporcionar un correo electrónico válido.'
                ]
            ],
            'vencimiento' => [
                'rules' => 'permit_empty|valid_date|fechaNoPasada',
                'errors' => [
                    'valid_date' => 'Por favor ingresa una fecha válida.',
                    'fechaNoPasada' => 'La fecha de vencimiento no puede ser anterior a hoy.'
                ]
            ],
        ];
        
        // Si la validación falla, redirigir de vuelta con los datos ingresados
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $post = $this->request->getPost(['tarea', 'descripcion','estado','prioridad','vencimiento','comentario','usuario']);    
        $registroSubtareaModel = new RegistroSubtareaModel();

        $registroSubtareaModel->insert([
            'id' => rand(1, 1000),
            'tarea' => $post['tarea'],
            'descripcion' =>  ucfirst(trim($post['descripcion'])),
            'estado' => $post['estado'],            
            'prioridad' => $post['prioridad'],
            'fecha_vencimiento' => $post['vencimiento'],
            'comentario' =>  ucfirst(trim($post['comentario'])),
            'responsable' => $post['usuario'],
        ]);
           
    return redirect()->to('/')->with('mensaje', 'Subtarea creada exitosamente.');
   }

#ACTUALIZAR SUBTAREA Y TAREA (Subtarea completada | Tarea en proceso)
    public function actualizarSubtarea($subtarea = null, $tarea = null) {
        if ($subtarea === null) {
            return redirect()->to('/menu/subtareas')->with('error', 'ID de subtarea no válido');
        }
    
        $registroTareaModel = new RegistroTareaModel();
        $registroSubtareaModel = new RegistroSubtareaModel();
    
        //Actualiza el estado de la tarea principal a "En proceso"
        $registroTareaModel->update($tarea, [
            'estado' => 'En proceso',
            'estado_actualizado' => '',
        ]);
    
        //Marcar la subtarea como "completada"
        $registroSubtareaModel->update($subtarea, [
            'estado' => 'Completada',
        ]);
    
        return redirect()->to('/menu/subtareas')->with('mensaje', 'Subtarea actualizada correctamente');
    }
    
#MODIFICAR SUBTAREA
    public function subtarea($id=null){
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        $session = session();
        if (session()->has('usuario')) {
            $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de subtareas.');
        }
        $data = [
            'subtareas' => $RegistroSubtareaModel->mostrarSubtareaID2(['id'=>$id])
        ];
        return view('formularios-tarea/modificar-subtarea',$data);
    }

    public function update($id = null){
        $reglas = [
           'descripcion' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo descripcion es obligatorio.',
                    'min_length' => 'La descripcion debe tener al menos 3 caracteres.'
               ]
            ],
            'comentario' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo comentario es obligatorio.',
                    'min_length' => 'La comentario debe tener al menos 3 caracteres.'
               ]
            ],
        ];
        
        // Si la validación falla, redirigir de vuelta con los datos ingresados
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $post = $this->request->getPost(['descripcion','estado','prioridad','vencimiento','comentario',]);    
        $registroSubtareaModel = new RegistroSubtareaModel();

        $registroSubtareaModel->update($id,[
            'descripcion' =>  ucfirst(trim($post['descripcion'])),
            'estado' => $post['estado'],            
            'prioridad' => $post['prioridad'],
            'fecha_vencimiento' => $post['vencimiento'],
            'comentario' =>  ucfirst(trim($post['comentario'])),
        ]);
           
    return redirect()->to('/menu/subtareas')->with('mensaje', 'Subtarea modificada exitosamente.');
   }

#COMPARTIR SUBTAREA
    public function subtareaEnviar($id=null){
    $RegistroSubtareaModel = new RegistroSubtareaModel();

        $session = session();
        if (session()->has('usuario')) {
            $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de subtareas.');
        }

        $data = [
            'subtareas' => $RegistroSubtareaModel->mostrarSubtareaID(['id'=>$id])
        ];
    return view('formularios-tarea/enviarsubtarea',$data);
   }

    public function enviar() {
    $registroSubtareaModel = new RegistroSubtareaModel();
    $session = session();
        if (session()->has('usuario')) {
             $correo = $session->get('usuario');
        }else {
            return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de subtareas.');
        }
    $id = $this->request->getPost('id');
    $emailList = $this->request->getPost('correos');
    $tarea = $this->request->getPost('tarea');
    $descripcion = $this->request->getPost('descripcion');
    $estado = $this->request->getPost('estado');
    $prioridad = $this->request->getPost('prioridad');
    $comentario = $this->request->getPost('comentario');
    $responsable = $this->request->getPost('responsable');
    $vencimiento = $this->request->getPost('fecha_vencimiento');

    $vencimiento = new \DateTime($vencimiento); 
    $vencimiento = $vencimiento->format('d-m-Y');
    
    // Agregar colaborador a la bd
    $registro = $registroSubtareaModel->find($id);
    $colaboradoresActuales = $registro['colaborador'] ?? '';

     // Convertir ambos en arrays, limpiar y normalizar a minúsculas
    $colaboradoresNuevos = array_filter(array_map('strtolower', array_map('trim', explode(',', $emailList))));
    $colaboradoresExistentes = array_filter(array_map('strtolower', array_map('trim', explode(',', $colaboradoresActuales))));

    // Unir y eliminar duplicados
    $todosLosColaboradores = array_unique(array_merge($colaboradoresExistentes, $colaboradoresNuevos));

    // Volver a string
    $colaboradoresFinal = implode(',', $todosLosColaboradores);

    $registroSubtareaModel->update($id, [
    'colaborador' => $colaboradoresFinal
    ]);

    // Convertir lista de correos en array
    $destinatarios = array_map('trim', explode(',', $emailList));

    $email = \Config\Services::email();

    $email->setFrom('openSource@gmail.com', 'Gestor de Subtareas');
    $email->setTo($destinatarios);

    $email->setSubject("Invitación a colaborar en la subtarea: $id");

    $mensaje = "
        <h3>📌 Información de la subtarea</h3>
        <ul>
            <li><strong>Codigo de la tarea:</strong> $tarea</li>
            <li><strong>Descripción:</strong> $descripcion</li>
            <li><strong>Estado:</strong> $estado</li>
            <li><strong>Prioridad:</strong> $prioridad</li>
            <li><strong>Comentario:</strong> $comentario</li>
            <li><strong>Rsponsable:</strong> $responsable</li>
            <li><strong>Fecha de vencimiento:</strong> $vencimiento</li> 
        </ul>
           <p><strong>Haz clic aquí para ver y gestionar la subtarea: </strong><a href='http://localhost/openSource/public/'>Acceder a la tarea</a></p>
    ";

    $email->setMessage($mensaje);

    if ($email->send()) {
        return redirect()->to('/menu/subtareas')->with('mensaje', '📧 Correo enviado con éxito.');
        
    } else {
       return redirect()->to('/menu/subtareas')->with('error', '❌ No se pudo enviar el correo.');
    }
    }
}