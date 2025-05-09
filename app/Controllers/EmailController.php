<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class EmailController extends Controller
{
    public function enviarCorreo()
    {
        $email = \Config\Services::email();

        // Configurar el correo
        $email->setTo('destinatario@gmail.com');
        $email->setFrom('tucorreo@gmail.com', 'Tu Nombre o Nombre de App');
        $email->setSubject('Asunto del correo');
        $email->setMessage('<h1>¡Hola!</h1><p>Este es un mensaje de prueba.</p>');

        // Enviar correo y verificar el resultado
        if ($email->send()) {
            echo 'Correo enviado exitosamente.';
        } else {
            echo 'Error al enviar correo.';
            print_r($email->printDebugger(['headers'])); // Imprime el error
        }
    }
}
