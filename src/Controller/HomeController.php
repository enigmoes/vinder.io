<?php
namespace App\Controller;

class HomeController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Lists');
        $this->loadModel('Items');
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
        $items = [];
        // Recogemos identidad de la session
        $user_id = $this->request->getSession()->read('Auth.User.id');
        if ($user_id) {
            // Buscamos datos en db para las listas
            $lists = $this->Lists->find('all', [
                'conditions' => [
                    'Lists.id_user' => $user_id,
                ],
            ])->toArray();
            // Buscamos datos en db para los items
            $items = $this->Items->find('all')->toArray();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'lists' => $lists,
            'items' => $items,
        ]);
    }

}
