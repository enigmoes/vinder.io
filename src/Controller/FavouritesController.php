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
        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $title = __('BÚSQUEDA');
            // Buscamos datos en db para los items
            $lists = $this->Lists->find('all', [
                'conditions' => [
                    'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
                ],
            ])->toArray();
            foreach ($lists as $list) {
                $list['items'] = $this->Items->find('all', [
                    'conditions' => [
                        'Items.id_list' => $list->id,
                        'Items.title LIKE' => '%' . $search . '%',
                    ],
                ])->toArray();
            }
        } else {
            $title = __('MI LISTA');
            // Buscamos datos en db para los items
            $lists = $this->Lists->find('all', [
                'conditions' => [
                    'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
                ],
            ])->toArray();
            foreach ($lists as $list) {
                $list['items'] = $this->Items->find('all', [
                    'conditions' => [
                        'Items.is_fav' => 1,
                        'Items.id_list' => $list->id,
                    ],
                ])->toArray();
            }
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'lists' => $lists,
            'title' => $title,
        ]);
    }
}
