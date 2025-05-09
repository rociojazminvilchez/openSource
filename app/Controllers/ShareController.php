<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ShareController extends BaseController
{
    public function share_task()
    {
        // Verificar si la solicitud es AJAX
        if (!$this->request->isAJAX()) {
            log_message('error', 'Solicitud no AJAX recibida en share_task');
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Solicitud inválida.'
            ]);
        }

        // Recibir datos de la solicitud
        $task_id = $this->request->getPost('task_id');
        $tema = $this->request->getPost('tema');
        $descripcion = $this->request->getPost('descripcion');
        $recipients = explode(',', $this->request->getPost('recipients'));

        log_message('info', 'Datos de la tarea recibidos: ' . print_r([
            'task_id' => $task_id,
            'tema' => $tema,
            'descripcion' => $descripcion,
            'recipients' => $recipients
        ], true));

        $invalidEmails = [];
        $validEmails = [];

        // Validar los correos electrónicos
        foreach ($recipients as $email) {
            $email = trim($email);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $validEmails[] = $email;
            } else {
                $invalidEmails[] = $email;
            }
        }

        // Si hay correos inválidos, retornamos un error
        if (!empty($invalidEmails)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Correos inválidos: ' . implode(', ', $invalidEmails)
            ]);
        }

        // Simulación de envío de correos electrónicos
        foreach ($validEmails as $email) {
            log_message('info', "Tarea '$tema' compartida con $email");
        }

        // Retornar respuesta de éxito
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Tarea compartida exitosamente con: ' . implode(', ', $validEmails)
        ]);
    }
}
