<?php
namespace App\Controller;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;

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

    // Función para añadir items
    public function add()
    {
        $url = $this->request->getQuery('url');
        if (!empty($url)) {
            // Eliminamos comillas de la url
            $url = str_replace('"', '', $url);
            // Crear DOM de la URL
            $client = new Client();
            $crawler = $client->request('GET', $url);
            $title = $crawler->filter('title')->text();
            $description = $crawler->filter('meta[name="description"]')->attr('content');
            $image = '';
            $crawler->filter('img')->each(function ($node, $i) use (&$image) {
                $src = $node->attr('src');
                if (empty($image) && preg_match('/.jpg+$|.png+$|.svg+$|.gif+$/', $src)) {
                    $image = \Functions::imageToBase64($src);
                }
            });
            // Buscar título, descripción e imagen de la url
            $item = $this->Items->newEntity();
            $item->id_list = 1;
            $item->id_user = $this->request->getSession()->read('Auth.User.id');
            $item->title = $title;
            $item->description = $description;
            $item->link = $url;
            $item->image = $image;
            if ($this->Items->save($item)) {
                $saved = true;
                $message = __('Item guardado correctamente');
            } else {
                $saved = false;
                $message = __('Error al guardar el item');
            }
        } else {
            $saved = false;
            $message = __('Error al guardar el item');
        }
        $this->set([
            'saved' => $saved,
            'message' => $message,
            '_serialize' => ['saved', 'message'],
        ]);
        $this->RequestHandler->renderAs($this, 'json');
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
    public function searchItems($valor = null)
    {
        // Buscamos datos en db para las listas
        $lists = $this->Lists->find('all', [
            'contain' => ['Items'],
            'conditions' => [
                'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
                'Items.title LIKE' => '%' . $valor . '%',
            ],
        ])->toArray();
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'lists' => $lists,
        ]);
    }
}
