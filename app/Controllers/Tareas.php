<?php

namespace App\Controllers;

class Tareas extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
}
