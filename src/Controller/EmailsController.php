<?php
namespace App\Controller;

use Cake\Event\Event;

class EmailsController extends AppController
{
    public function preview($template)
    {
        $this->render('/Email/html/' . $template, 'Email/html/default');
    }
}
