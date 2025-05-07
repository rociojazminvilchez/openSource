<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;
use App\Models\TaskModel;

class ShareController extends Controller
{
    protected $email;
    protected $taskModel;

    public function __construct()
    {
        $this->email = \Config\Services::email();
        $this->taskModel = new TaskModel();
    }

    public function share_task()
    {
        // Validar que es una solicitud AJAX
        if (!$this->request->isAJAX()) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Acceso no permitido');
        }

        // Obtener datos del POST
        $task_id = $this->request->getPost('task_id', FILTER_SANITIZE_STRING);
        $tema = $this->request->getPost('tema', FILTER_SANITIZE_STRING);
        $descripcion = $this->request->getPost('descripcion', FILTER_SANITIZE_STRING);
        $prioridad = $this->request->getPost('prioridad', FILTER_SANITIZE_STRING);
        $estado = $this->request->getPost('estado', FILTER_SANITIZE_STRING);
        $fecha_vencimiento = $this->request->getPost('fecha_vencimiento', FILTER_SANITIZE_STRING);
        $fecha_recordatorio = $this->request->getPost('fecha_recordatorio', FILTER_SANITIZE_STRING);
        $recipients = $this->request->getPost('recipients', FILTER_SANITIZE_STRING);

        // Validar datos
        if (empty($task_id) || empty($tema) || empty($recipients)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Faltan datos obligatorios.'
            ]);
        }

        // Validar correos electrónicos
        $recipient_list = array_map('trim', explode(',', $recipients));
        foreach ($recipient_list as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Uno o más correos electrónicos no son válidos.'
                ]);
            }
        }

        // Verificar si la tarea existe
        $task = $this->taskModel->find($task_id);
        if (!$task) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'La tarea no existe.'
            ]);
        }

        // Configurar correo
        $this->email->setFrom('no-reply@tudominio.com', 'Tu Aplicación');
        $this->email->setSubject('Tarea compartida: ' . $tema);
        $this->email->setMessage("
            <h3>Tarea Compartida</h3>
            <p><strong>Tema:</strong> {$tema}</p>
            <p><strong>Descripción:</strong> {$descripcion}</p>
            <p><strong>Prioridad:</strong> {$prioridad}</p>
            <p><strong>Estado:</strong> {$estado}</p>
            <p><strong>Fecha de Vencimiento:</strong> {$fecha_vencimiento}</p>
            <p><strong>Fecha de Recordatorio:</strong> {$fecha_recordatorio}</p>
        ");
        $this->email->setMailType('html');

        $email_success = true;
        foreach ($recipient_list as $email) {
            $this->email->setTo($email);
            if (!$this->email->send()) {
                $email_success = false;
                break;
            }
            $this->email->clear();
        }

        // Respuesta JSON
        if ($email_success) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Tarea compartida correctamente.'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error al enviar los correos electrónicos.'
            ]);
        }
    }
}