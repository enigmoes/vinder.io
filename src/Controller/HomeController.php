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

    // Función para borrar items
    public function delete($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            //$this->Flash->success(__('El artículo con id: {0} ha sido eliminado.', h($id)));
            //$this->viewBuilder()->setLayout('ajax');
        }
    }
    // Acción para favoritos
    public function favourites()
    {

    }
    // Acción para etiquetas
    public function tags()
    {

    }

}
