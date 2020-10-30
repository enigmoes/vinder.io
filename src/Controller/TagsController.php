<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tags Controller
 *
 * @property \App\Model\Table\TagsTable $Tags
 *
 * @method \App\Model\Entity\Tag[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
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
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tag = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $items = $this->Tags->Items->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tag id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tag = $this->Tags->get($id, [
            'contain' => ['Items'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tag = $this->Tags->patchEntity($tag, $this->request->getData());
            if ($this->Tags->save($tag)) {
                $this->Flash->success(__('The tag has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tag could not be saved. Please, try again.'));
        }
        $items = $this->Tags->Items->find('list', ['limit' => 200]);
        $this->set(compact('tag', 'items'));
    }

    /**
     * AJAX
     */

    // Función para buscar las etiquetas
    public function tags($search = null)
    {
        $tags = [];
        // Buscamos datos en db para sacar las tags
        $tags = $this->Tags->find('all')->toArray();
        $this->viewBuilder()->setLayout('ajax');
        $this->set([
            'tags' => $tags,
        ]);
    }
    
    // Función para buscar las listas por cada etiqueta
    public function items($id_tag = null)
    {
        if (!is_null($id_tag)) {
            // Buscamos todos los items de una tag
            $itemsTags = $this->ItemsTags->find('list', [
                'contain' => [
                    'fields' => ['ItemsTags.id_item'],
                    'tags',
                ],
                'conditions' => [
                    'ItemsTags.id_tag' => $id_tag,
                ],
            ])->toArray();
            $items = $this->Items->find('all', [
                'conditions' => [
                    'Items.id IN' => $itemsTags,
                ],
            ])->toArray();
        } else {
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
}
