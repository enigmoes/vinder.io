<?php
namespace App\Controller;

use Goutte\Client;

class ItemsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Lists');
        $this->loadModel('Tags');
        $this->loadModel('ItemsTags');
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
        $count = 0;
        // Buscamos datos en db para los items
        $lists = $this->Lists->find('all', [
            'conditions' => [
                'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
            ],
        ])->toArray();
        foreach ($lists as $list) {
            $this->request->query['id_list'] = $list->id;
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
            $title = trim($crawler->filter('title')->text());
            // Eliminamos todas las comillas
            $title = preg_replace('/[\'"]/', '', $title);
            $description = trim($crawler->filter('meta[name="description"]')->attr('content'));
            // Buscamos ultimos caracter y añadimos '.' en caso de no tener
            $lastChar = ord(substr($description, -1));
            if ($lastChar != 46) {
                $description = $description . '.';
            }
            $image = '';
            $crawler->filter('img')->each(function ($node, $i) use (&$image) {
                $src = $node->attr('src');
                // Limpiar query de URL
                $src = preg_replace('/\?.*/', '', $src);
                // Comprobamos vacio y e imagen valida
                if (empty($image) && preg_match('/.jpg+$|.jpeg+$|.png+$|.gif+$/', $src)) {
                    $tmp = \Functions::imageToBase64($src);
                    if (!is_null($tmp)) {
                        $image = $tmp;
                    }
                }
            });
            // Buscamos la lista del usuario
            $lists = $this->Lists->find('all', [
                'conditions' => [
                    'Lists.id_user' => $this->request->getSession()->read('Auth.User.id'),
                ],
            ])->toArray();
            foreach ($lists as $list) {
                $idList = $list['id'];
            }
            // Buscar título, descripción e imagen de la url
            $item = $this->Items->newEntity();
            $item->id_list = $idList;
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

    // Función para añadir etiquetas a un item
    public function addTag($id_item)
    {
        // Al enviar el formulario
        if ($this->request->is(['post', 'put'])) {
            // Borra todos los items
            $tagList = $this->ItemsTags->find('list', [
                'conditions' => [
                    'ItemsTags.id_item' => $id_item,
                ],
                'keyField' => 'id', 'valueField' => function ($e) {
                    return $e->id;
                },
            ])->toArray();
            if (!empty($tagList)) {
                $this->ItemsTags->deleteAll(['ItemsTags.id IN' => $tagList]);
            }
            // Construir array con tags
            $data = [];
            foreach ($this->request->getData('tags') as $item) {
                if (is_array($item)) {
                    $data[] = [
                        'id_item' => $id_item,
                        'id_tag' => $item[0],
                    ];
                }
            }
            $itemsTags = $this->ItemsTags->newEntities($data);
            $this->begin();
            if ($this->ItemsTags->saveMany($itemsTags)) {
                $this->commit();
                $this->Flash->success(__('Etiqueta añadida correctamente'));
            } else {
                if(empty($this->ItemsTags->saveMany($itemsTags))){
                    $this->Flash->success(__('Etiquetas retiradas del ítem'));
                } else {
                    $this->Flash->error(__('Se produjo un error al añadir la etiqueta'));
                }
            }
        }
        // Buscamos datos en db para sacar las tags del usuario
        $tags = $this->Tags->find('list', [
            'conditions' => [
                'Tags.id_user' => $this->request->getSession()->read('Auth.User.id'),
            ],
            'keyField' => 'id', 'valueField' => function ($e) {
                return $e->name;
            },
        ])->toArray();
        $tagsItem = $this->ItemsTags->find('list', [
            'conditions' => [
                'ItemsTags.id_item' => $id_item,
            ],
            'keyField' => 'id', 'valueField' => function ($e) {
                return $e->id_tag;
            },
        ])->toArray();
        if (!empty($tagsItem)) {
            $tagsItem = $this->Tags->find('list', [
                'conditions' => [
                    'Tags.id IN' => $tagsItem,
                ],
                'keyField' => 'id', 'valueField' => function ($e) {
                    return $e->id;
                },
            ])->toArray();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'tags' => $tags,
            'tagsItem' => $tagsItem,
            'id_item' => $id_item,
        ]);
    }
}
