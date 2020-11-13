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
            ])->toArray();
        } else {
            // Buscamos datos en db para sacar las tags del usuario
            $tags = $this->Tags->find('all', [
                'conditions' => [
                    'Tags.id_user' => $this->request->getSession()->read('Auth.User.id'),
                ],
            ])->toArray();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'tags' => $tags,
        ]);
    }

    // Función para buscar las listas por cada etiqueta
    public function items($id_tag = null)
    {
        if (!is_null($id_tag)) {
            // Buscamos el nombre de la tag
            $tagName = $this->Tags->find('all', [
                'conditions' => [
                    'Tags.id' => $id_tag,
                ],
            ])->toArray()[0]->name;
            // Buscamos todos los items de una tag
            $items = $this->Items->find('all', [
                'conditions' => [
                    'Items.id IN' => $this->ItemsTags->find('list', [
                        'conditions' => [
                            'ItemsTags.id_tag' => $id_tag,
                        ],
                        'keyField' => 'id', 'valueField' => function ($e) {
                            return $e->id_item;
                        },
                    ])->toArray(),
                ],
            ])->toArray();
        } else {
            // Inicializamos tag name con mi lista
            $tagName = __('MI LISTA');
            // Buscamos todos los items del usuario
            $items = $this->Items->find('all', [
                'conditions' => [
                    'Items.id_user' => $this->request->getSession()->read('Auth.User.id'),
                ],
            ])->toArray();
        }
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'items' => $items,
            'tagName' => $tagName,
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

    // Función para borrar tags
    public function deleteTags($id)
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
            debug($this->request->getData());exit;
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->commit();
                $saved = true;
                $message = __('Etiqueta editada correctamente');
            } else {
                $saved = false;
                $message = __('Se produjo un error al editar la etiqueta');
            }
        } else {
            $saved = false;
            $message = '';
        }
        $this->set([
            'saved' => $saved,
            'message' => $message,
            '_serialize' => ['saved', 'message'],
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }
}
