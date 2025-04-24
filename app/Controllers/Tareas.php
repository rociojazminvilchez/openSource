<?php

namespace App\Controllers;
use App\Models\RegistroTareaModel;

class Tareas extends BaseController
{

    public function create(){
        $reglas = [
            'tema' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo tema es obligatorio.',
                    'min_length' => 'El tema debe tener al menos 3 caracteres.'
               ]
            ],
           'descripcion' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'El campo descripcion es obligatorio.',
                    'min_length' => 'La descripcion debe tener al menos 3 caracteres.'
               ]
            ],
            'vencimiento' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'El campo fecha es obligatorio.',
                    'valid_date' => 'Por favor ingresa una fecha válida.'
                ]
            ],
        ];
        
        // Si la validación falla, redirigir de vuelta con los datos ingresados
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $post = $this->request->getPost(['usuario', 'tema', 'descripcion','prioridad','estado','vencimiento','recordatorio','color']);    
        $registroTareaModel = new RegistroTareaModel();


        $registroTareaModel->insert([
            'id' => rand(1, 1000),
            'correo' => $post['usuario'],
            'tema' => ucfirst(trim($post['tema'])),
            'descripcion' =>  ucfirst(trim($post['descripcion'])),
            'prioridad' => $post['prioridad'],
            'estado' => $post['estado'],
            'estado_actualizado' => '',
            'fecha_vencimiento' => $post['vencimiento'],
            'fecha_recordatorio' => $post['recordatorio'],
            'color' => $post['color'],
        ]);
           
    return redirect()->to('/')->with('mensaje', 'Tarea creada exitosamente.');
   }
}
