<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Maps Controller
 *
 * @property \App\Model\Table\MapsTable $Maps
 *
 * @method \App\Model\Entity\Map[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MapsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $maps = $this->paginate($this->Maps->find()->where(['Maps.user_id' => $this->Auth->user('id')]));

        $this->set(compact('maps'));
    }

    /**
     * View method
     *
     * @param string|null $id Map id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $map = $this->Maps->get($id, [
            'contain' => ['Users', 'Robots']
        ]);

        $this->set('map', $map);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $map = $this->Maps->newEntity();
        if ($this->request->is('post')) {
            $map = $this->Maps->patchEntity($map, $this->request->getData());
            $map->user_id = $this->Auth->user("id");
            if ($this->Maps->save($map)) {
                $this->Flash->success(__('The map has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The map could not be saved. Please, try again.'));
        }
        $users = $this->Maps->Users->find('list', ['limit' => 200]);
        $this->set(compact('map', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Map id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $map = $this->Maps->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $map = $this->Maps->patchEntity($map, $this->request->getData());
            if ($this->Maps->save($map)) {
                $this->Flash->success(__('The map has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The map could not be saved. Please, try again.'));
        }
        $users = $this->Maps->Users->find('list', ['limit' => 200]);
        $this->set(compact('map', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Map id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $map = $this->Maps->get($id);
        if ($this->Maps->delete($map)) {
            $this->Flash->success(__('The map has been deleted.'));
        } else {
            $this->Flash->error(__('The map could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        return true;
    }
}
