<?php
namespace App\Controller;

class HomeController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Lists');
    }

    public function index()
    {
        $login = false;
        if ($this->isLogin()) {
            $login = true;
        }

        $this->set([
            'login' => $login,
        ]);
    }

    // Función para buscar las listas
    public function results()
    {
        $lists = [];
        // Recogemos identidad de la session
        $user_id = $this->request->getSession()->read('Auth.User.id');
        if ($user_id) {
            // Buscamos datos en db
            $lists = $this->Lists->find('all', [
                'conditions' => [
                    'Lists.id_user' => $user_id,
                ],
            ])->toArray();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'lists' => $lists,
        ]);
    }

}
