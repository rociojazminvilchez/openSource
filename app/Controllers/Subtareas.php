<?php

namespace App\Controllers;
use App\Models\RegistroSubtareaModel;
use App\Models\RegistroTareaModel;


class Subtareas extends BaseController{

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
    
        // Cambiar el estado de la tarea principal a "En proceso"
        $registroTareaModel->update($tarea, [
            'estado' => 'En proceso',
            'estado_actualizado' => '',
        ]);
    
        // Marcar la subtarea como completada
        $registroSubtareaModel->update($subtarea, [
            'estado' => 'Completada',
        ]);
    
        return redirect()->to('/menu/subtareas')->with('mensaje', 'Subtarea actualizada correctamente');
    }
    
    #MODIFICAR SUBTAREA

    public function subtarea($id=null){
        $RegistroSubtareaModel = new RegistroSubtareaModel();
        if (session()->has('usuario')) {
            $correo= $_SESSION['usuario'];
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

}