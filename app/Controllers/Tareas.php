<?php

namespace App\Controllers;
use App\Models\RegistroTareaModel;

class Tareas extends BaseController{

    public function index(){ 
        $registroTareaModel = new RegistroTareaModel();
        $tareas = $registroTareaModel->findAll();

        return view('tareas_view', ['tareas' => $tareas]);
    }

#CREAR TAREA
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
                'rules' => 'required|valid_date|fechaNoPasada',
                'errors' => [
                    'required' => 'El campo fecha es obligatorio.',
                    'valid_date' => 'Por favor ingresa una fecha válida.',
                    'fechaNoPasada' => 'La fecha de vencimiento no puede ser anterior a hoy.'
                ]
            ],
            'recordatorio' => [
                'rules' => 'permit_empty|valid_date|validarRecordatorioVsVencimiento[vencimiento]',
                 'errors' => [
                    'valid_date' => 'Por favor ingresa una fecha válida.',
                    'validarRecordatorioVsVencimiento' => 'La fecha de recordatorio no puede ser posterior al vencimiento.'
                ]
           ],
        ];
        
        // Si la validación falla, redirigir de vuelta con los datos ingresados
        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $post = $this->request->getPost(['usuario', 'tema', 'descripcion','prioridad','estado','vencimiento','recordatorio']);    
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
        ]);
           
    return redirect()->to('/')->with('mensaje', 'Tarea creada exitosamente.');
   }


#ELIMINAR TAREA
   public function eliminarTarea($id = null) {
    if (!$id) {
        return redirect()->to('/menu/tareas')->with('error', 'ID de tarea no válido');
    }

    $registroTareaModel= new RegistroTareaModel();

    $registroTareaModel->update($id, [
           'estado_actualizado'=> 'Eliminada',
       ]);

       return redirect()->to('/menu/tareas');
   }

#ARCHIVAR TAREA
    public function archivarTarea($id = null) {
    if (!$id) {
        return redirect()->to('/menu/tareas')->with('error', 'ID de tarea no válido');
    }

    $registroTareaModel= new RegistroTareaModel();
 
    $actualizada = $registroTareaModel->update($id, [
        'estado' => 'Completada',
        'estado_actualizado' => 'Archivada',
    ]);
    
    if ($actualizada) {
        return redirect()->to('/menu/panel_completo/' . $id)->with('mensaje', 'Tarea archivada exitosamente');
    } else {
        return redirect()->to('/menu/panel_completo/' .$id)->with('mensaje', 'Error al archivar la tarea');
    }
    }

#MODIFICAR TAREA
   public function tarea($id=null){
    $RegistroTareaModel = new RegistroTareaModel();
    $session = session();
    if (session()->has('usuario')) {
        $correo = $session->get('usuario');
    }else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de tareas.');
    }
    $data = [
        'tareas' => $RegistroTareaModel->mostrarTareaID(['id'=>$id])
    ];
    return view('formularios-tarea/modificar-tarea',$data);
   }

   public function update($id = null){
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
            'rules' => 'required|valid_date|fechaNoPasada',
            'errors' => [
                'required' => 'El campo fecha es obligatorio.',
                'valid_date' => 'Por favor ingresa una fecha válida.',
                'fechaNoPasada' => 'La fecha de vencimiento no puede ser anterior a hoy.'
            ]
        ], 
        'recordatorio' => [
            'rules' => 'permit_empty|valid_date|validarRecordatorioVsVencimiento[vencimiento]',
            'errors' => [
                'valid_date' => 'Por favor ingresa una fecha válida.',
                'validarRecordatorioVsVencimiento' => 'La fecha de recordatorio no puede ser posterior al vencimiento.'
            ]
     ],
     ];
    // Si la validación falla, redirigir de vuelta con los datos ingresados
    if (!$this->validate($reglas)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }
    
    $post = $this->request->getPost(['tema', 'descripcion','prioridad','estado','estado_actualizado','vencimiento','recordatorio']);    
    $registroTareaModel = new RegistroTareaModel();

    $registroTareaModel->update($id,[
    'tema' => ucfirst(trim($post['tema'])),
    'descripcion' =>  ucfirst(trim($post['descripcion'])),
    'prioridad' => $post['prioridad'],
    'estado' => $post['estado'],
    'estado_actualizado' => $post['estado_actualizado'],
    'fecha_vencimiento' => $post['vencimiento'],
    'fecha_recordatorio' => $post['recordatorio'],
    ]);

    return redirect()->to('/menu/tareas')->with('mensaje', 'Tarea modificada exitosamente.');
   }

#COMPARTIR TAREA
    public function tareaEnviar($id=null){
    $RegistroTareaModel = new RegistroTareaModel();
    $session = session();
    if (session()->has('usuario')) {
         $correo = $session->get('usuario');
    }else {
        return redirect()->to('formularios/ingreso')->with('mensajeError', 'Debes iniciar sesión para acceder al panel de tareas.');
    }
    $data = [
        'tareas' => $RegistroTareaModel->mostrarTareaID(['id'=>$id])
    ];
    return view('formularios-tarea/enviartarea',$data);
   }

    public function enviar() {
    $registroTareaModel = new RegistroTareaModel();

    $id = $this->request->getPost('id');
    $emailList = $this->request->getPost('correos');
    $tema = $this->request->getPost('tema');
    $descripcion = $this->request->getPost('descripcion');
    $prioridad = $this->request->getPost('prioridad');
    $estado = $this->request->getPost('estado');
    $vencimiento = $this->request->getPost('fecha_vencimiento');
    $recordatorio = $this->request->getPost('fecha_recordatorio');

    $vencimiento = new \DateTime($vencimiento); 
 
    $vencimiento = $vencimiento->format('d-m-Y');

    $recordatorio = new \DateTime($recordatorio); 
    $recordatorio = $recordatorio->format('d-m-Y');

    // Agregar colaborador a la bd
    $registro = $registroTareaModel->find($id);
    $colaboradoresActuales = $registro['colaborador'] ?? '';

     // Convertir ambos en arrays, limpiar y normalizar a minúsculas
    $colaboradoresNuevos = array_filter(array_map('strtolower', array_map('trim', explode(',', $emailList))));
    $colaboradoresExistentes = array_filter(array_map('strtolower', array_map('trim', explode(',', $colaboradoresActuales))));

    // Unir y eliminar duplicados
    $todosLosColaboradores = array_unique(array_merge($colaboradoresExistentes, $colaboradoresNuevos));

    // Volver a string
    $colaboradoresFinal = implode(',', $todosLosColaboradores);

    $registroTareaModel->update($id, [
    'colaborador' => $colaboradoresFinal
    ]);


    // Convertir lista de correos en array
    $destinatarios = array_map('trim', explode(',', $emailList));

    $email = \Config\Services::email();

    $email->setFrom('openSource@gmail.com', 'Gestor de Tareas');
    $email->setTo($destinatarios);

    $email->setSubject("Invitación a colaborar en la tarea: $tema");

    $mensaje = "
        <h3>📌 Información de la tarea</h3>
        <ul>
            <li><strong>Tema:</strong> $tema</li>
            <li><strong>Descripción:</strong> $descripcion</li>
            <li><strong>Prioridad:</strong> $prioridad</li>
            <li><strong>Estado:</strong> $estado</li>
            <li><strong>Fecha de vencimiento:</strong> $vencimiento</li>
            <li><strong>Recordatorio:</strong> $recordatorio</li>
            
        </ul>
           <p><strong>Haz clic aquí para ver y gestionar la tarea: </strong><a href='http://localhost/openSource/public/'>Acceder a la tarea</a></p>";

    $email->setMessage($mensaje);

    if ($email->send()) {
        return redirect()->to('/menu/tareas')->with('mensaje', '📧 Correo enviado con éxito.');
        
    } else {
       return redirect()->to('/menu/tareas')->with('error', '❌ No se pudo enviar el correo.');
    }
    }

}
