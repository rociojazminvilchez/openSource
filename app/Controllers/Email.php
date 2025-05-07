<?php
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $fromEmail = 'no-reply@tudominio.com';
    public $fromName = 'Tu Aplicación';
    public $SMTPHost = 'smtp.tuservidor.com';
    public $SMTPUser = 'tu_usuario';
    public $SMTPPass = 'tu_contraseña';
    public $SMTPPort = 587;
    public $mailType = 'html';
    public $charset = 'utf-8';
}