<?php
namespace App\Controller;

use Cake\Collection\Collection;
use Cake\I18n\I18n;

class HomeController extends AppController
{

    public function initialize() {
        parent::initialize();

    }

    public function index() {
        $login = false;
        if ($this->isLogin()) {
            $login = true;
        }

        $this->set([
            'login' => $login
        ]);
    }

    public function mostrar(){
        $lists = $this->Lists->find()->all();
    }

}
