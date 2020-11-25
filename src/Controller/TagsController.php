<?php
namespace App\Controller;

class TagsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Lists');
        $this->loadModel('Items');
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

    // Función para buscar las etiquetas
    public function tags()
    {
        $tag = $this->request->getQuery('tag');
        if (!empty($tag)) {
            // Buscamos datos en db para sacar las tags del usuario y filtradas
            $tags = $this->Tags->find('all', [
                'conditions' => [
                    'Tags.name LIKE' => '%' . $tag . '%',
                    'Tags.id_user' => $this->request->getSession()->read('Auth.User.id')
                ],
            ])->order(['Tags.name' => 'ASC'])->toArray();
        } else {
            // Buscamos datos en db para sacar las tags del usuario
            $tags = $this->Tags->find('all', [
                'conditions' => [
                    'Tags.id_user' => $this->request->getSession()->read('Auth.User.id'),
                ],
            ])->order(['Tags.name' => 'ASC'])->toArray();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'tags' => $tags,
        ]);
    }

    // Función para buscar las listas por cada etiqueta
    public function items($id_tag = null)
    {
        $search = $this->request->getQuery('search');
        // Declaramos items
        $items = [];
        //Si se ha recogido una etiqueta
        if (!is_null($id_tag)) {
            // Buscamos el nombre de la tag
            $tagName = $this->Tags->find('all', ['conditions' => ['Tags.id' => $id_tag]])->toArray()[0]->name;
            //Si lo búsqueda no está vacía
            if (!empty($search)) {
                // Inicializamos tag name con el nombre de la etiqueta más "búsqueda"
                $tagName = __('BÚSQUEDA') . "-" . $tagName;
                // Buscamos todos los items de una etiqueta
                $itemsTags = $this->ItemsTags->find('list', [
                    'conditions' => [
                        'ItemsTags.id_tag' => $id_tag,
                    ],
                    'keyField' => 'id', 'valueField' => function ($e) {
                        return $e->id_item;
                    },
                ])->toArray();
                // Si hay items asignados a una etiqueta
                if (!empty($itemsTags)) {
                    $items = $this->Items->find('all', [
                        'conditions' => [
                            'Items.id IN' => $itemsTags,
                            'Items.title LIKE' => '%' . $search . '%',
                        ],
                    ])->order(['Items.created' => 'DESC'])->toArray();
                }
            } else {
                // Buscamos todos los items de una etiqueta
                $itemsTags = $this->ItemsTags->find('list', [
                    'conditions' => [
                        'ItemsTags.id_tag' => $id_tag,
                    ],
                    'keyField' => 'id', 'valueField' => function ($e) {
                        return $e->id_item;
                    },
                ])->toArray();
                // Si hay items asignados a una etiqueta
                if (!empty($itemsTags)) {
                    $items = $this->Items->find('all', [
                        'conditions' => [
                            'Items.id IN' => $itemsTags,
                        ],
                    ])->order(['Items.created' => 'DESC'])->toArray();
                }
            }
        } else {
            //Si lo búsqueda no está vacía
            if (!empty($search)) {
                // Inicializamos tag name con "búsqueda"
                $tagName = __('BÚSQUEDA');
                // Realizamos la búsqueda de items
                $items = $this->Items->find('all', [
                    'conditions' => [
                        'Items.id_user' => $this->request->getSession()->read('Auth.User.id'),
                        'Items.title LIKE' => '%' . $search . '%',
                    ],
                ])->order(['Items.created' => 'DESC'])->toArray();
            } else {
                // Inicializamos tag name con "mi lista"
                $tagName = __('MI LISTA');
                // Buscamos todos los items del usuario
                $items = $this->Items->find('all', [
                    'conditions' => [
                        'Items.id_user' => $this->request->getSession()->read('Auth.User.id'),
                    ],
                ])->order(['Items.created' => 'DESC'])->toArray();
            }
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'items' => $items,
            'tagName' => $tagName,
        ]);
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

    // Función para borrar tags
    public function delete($id)
    {
        // Buscamos si la tag está asignada a un item
        $tags = $this->ItemsTags->find('list', [
            'conditions' => [
                'ItemsTags.id_tag' => $id,
            ]
        ])->toArray();
        // Si la tag no está asignada, la eliminamos
        if(count($tags) == 0) {
            $tag = $this->Tags->get($id);
            if ($this->Tags->delete($tag)) {
                $deleted = true;
                $message = __('Etiqueta eliminada correctamente');
            } else {
                $deleted = false;
                $message = __('Se produjo un error al elminar la etiqueta');
            }
        } else {
            $deleted = false;
            $message = __('Error al eliminar: Esta etiqueta esta asociada a un item.');
        }
        $this->set([
            'deleted' => $deleted,
            'message' => $message,
            '_serialize' => ['deleted', 'message'],
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    // Función para editar tags
    public function edit($id)
    {
        $tag = $this->Tags->get($id);
        if ($this->request->is(['post', 'put'])) {
            $this->begin();
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->commit();
                $this->Flash->success(__('Etiqueta editada correctamente'));
            } else {
                $this->Flash->error(__('Se produjo un error al editar la etiqueta'));
            }
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
           'tag' => $tag,
        ]);
    }

    // Función para editar tags
    public function create()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $this->begin();
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->commit();
                $this->Flash->success(__('Etiqueta añadida correctamente'));
            } else {
                $this->Flash->error(__('Se produjo un error al añadir la etiqueta'));
            }
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
           'tag' => $tag,
        ]);
    }
}
