<?php
namespace App\Controller;

class FavouritesController extends AppController
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

    /**
     * AJAX
     */

    // Función para buscar las listas
    public function results()
    {
        $title = __('MI LISTA');
        // Si hay query search cambiamos el título
        if (!empty($this->request->getQuery('search'))) {
            $title = __('BÚSQUEDA');
        }
        // Buscamos datos en db para los items
        $lists = $this->Lists->find('all', [
            'conditions' => [
                'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
            ],
        ])->toArray();
        foreach ($lists as $list) {
            $this->request->query['id_list'] = $list->id;
            $this->request->query['is_fav'] = 1;
            $list['items'] = $this->Items->find('all', [
                'conditions' => $this->Items->conditions($this->request->getQuery()),
                'order' => $this->Items->order($this->request->getQuery()),
                'limit' => $this->Items->limit($this->request->getQuery())
            ])->toArray();
            $count = $this->Items->find('all', [
                'conditions' => $this->Items->conditions($this->request->getQuery()),
                'order' => $this->Items->order($this->request->getQuery()),
            ])->count();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'count' => $count,
            'lists' => $lists,
            'title' => $title,
        ]);
    }
}
