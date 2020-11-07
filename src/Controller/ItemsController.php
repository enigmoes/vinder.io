<?php
namespace App\Controller;

class ItemsController extends AppController
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

    /**
     * AJAX
     */

    // Función para buscar las listas
    public function results()
    {
        // Buscamos datos en db para las listas
        $lists = $this->Lists->find('all', [
            'contain' => ['Items'],
            'conditions' => [
                'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
            ],
        ])->toArray();
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'lists' => $lists,
        ]);
    }

    // Función para borrar items
    public function delete($id)
    {
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $deleted = true;
            $message = __('Item eliminado correctamente');
        } else {
            $deleted = false;
            $message = __('Se produjo un error al elminar el item');
        }
        $this->set([
            'deleted' => $deleted,
            'message' => $message,
            '_serialize' => ['deleted', 'message'],
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    // Función para cambiar el is_fav
    public function isFav($id)
    {
        $item = $this->Items->get($id);
        ($item->is_fav) ? $item->is_fav = 0 : $item->is_fav = 1;
        if ($this->Items->save($item)) {
            if ($item->is_fav) {
                $success = true;
                $message = __('Item añadido a favoritos');
            } else {
                $success = true;
                $message = __('Item eliminado de favoritos');
            }
        } else {
            $success = false;
            $message = __('Error al actualizar item');
        }
        $this->set([
            'success' => $success,
            'message' => $message,
            '_serialize' => ['success', 'message'],
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    // Función para hacer la búsqueda de items
    public function searchItems($id)
    {
        $value = $this->request->data('key');
        /*if (isset($_POST['txtbusca'])) {
            include "conexion.php";
            $user = new ApptivaDB();
            $u = $user->buscar("usuarios", " nombre like '%" . $_POST['txtbusca'] . "%'");
            $html = "";
            foreach ($u as $v) {
                $html .= "<p>" . $v['nombre'] . "</p>";
            }
            echo $html;
        } else {
            echo "Error";
        };*/
    }
}
