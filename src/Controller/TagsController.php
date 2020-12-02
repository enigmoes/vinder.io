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
        $tagName = __('MI LISTA');
        //Si se ha recogido una etiqueta
        if (!is_null($id_tag)) {
            // Buscamos el nombre de la tag
            $tagName = $this->Tags->find('all', ['conditions' => ['Tags.id' => $id_tag]])->toArray()[0]->name;
            // Si hay query search cambiamos el título
            if (!empty($this->request->getQuery('search'))) {
                // Inicializamos tag name con el nombre de la etiqueta más "búsqueda"
                $tagName = __('BÚSQUEDA') . "-" . $tagName;
            }
            // Buscamos todos los items de una etiqueta
            $itemsTags = $this->ItemsTags->find('list', [
                'conditions' => [
                    'ItemsTags.id_tag' => $id_tag,
                ],
                'keyField' => 'id', 'valueField' => function ($e) {
                    return $e->id_item;
                },
            ])->toArray();
            $this->request->query['items_tags'] = $itemsTags;
        } else {
            // Si hay query search cambiamos el título
            if (!empty($this->request->getQuery('search'))) {
                $tagName = __('BÚSQUEDA');
            }
            // Realizamos las queries
            $this->request->query['id_user'] = $this->request->getSession()->read('Auth.User.id');
        }
        // Realizamos la búsqueda de items
        $items = $this->Items->find('all', [
            'conditions' => $this->Items->conditions($this->request->getQuery()),
            'order' => $this->Items->order($this->request->getQuery())
        ])->toArray();
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
        $tag = $this->Tags->get($id);
        if ($this->Tags->delete($tag)) {
            $deleted = true;
            $message = __('Etiqueta eliminada correctamente');
        } else {
            $deleted = false;
            $message = __('Se produjo un error al eliminar la etiqueta');
        }
        $this->set([
            'deleted' => $deleted,
            'message' => $message,
            '_serialize' => ['deleted', 'message'],
        ]);
        $this->RequestHandler->renderAs($this, 'json');
    }

    // Función para comprobar si una tag tiene items asignados
    public function hasItems($id){
        // Buscamos si la tag está asignada a un item
        $tags = $this->ItemsTags->find('list', [
            'conditions' => [
                'ItemsTags.id_tag' => $id,
            ]
        ])->toArray();
        if(count($tags) == 0) {
            $hasItems = false;
        } else {
            $hasItems = true;
        }
        $this->set([
            'hasItems' => $hasItems,
            '_serialize' => ['hasItems'],
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
