<?php
namespace App\Controller;

class EmailsController extends AppController
{
    public function preview($template)
    {
        $this->render('/Email/html/' . $template, 'Email/html/default');
    }
}
