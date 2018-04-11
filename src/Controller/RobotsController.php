<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Robots Controller
 *
 * @property \App\Model\Table\RobotsTable $Robots
 *
 * @method \App\Model\Entity\Robot[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RobotsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Topics', 'Maps']
        ];

        $robots = $this->paginate($this->Robots->find()->where(['Robots.user_id' => $this->Auth->user('id')]));

        $this->set(compact('robots'));
    }

    /**
     * View method
     *
     * @param string|null $id Robot id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $robot = $this->Robots->get($id, [
            'contain' => ['Users', 'Topics', 'Maps']
        ]);

        $this->set('robot', $robot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $robot = $this->Robots->newEntity();
        if ($this->request->is('post')) {
            $robot = $this->Robots->patchEntity($robot, $this->request->getData());
            $robot->user_id = $this->Auth->user("id");
            if ($this->Robots->save($robot)) {
                $this->Flash->success(__('The robot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The robot could not be saved. Please, try again.'));
        }
        $users = $this->Robots->Users->find('list', ['limit' => 200]);
        $topics = $this->Robots->Topics->find('list', ['limit' => 200]);
        $maps = $this->Robots->Maps->find('list', ['limit' => 200]);
        $this->set(compact('robot', 'users', 'topics', 'maps'));
    }

    public function connect($id = null)
    {
        $robot = $this->Robots->get($id, [
            'contain' => ['Topics', 'Topics.MesTypes']
        ]);

        $this->set(compact("robot"));

    }

    /**
     * Edit method
     *
     * @param string|null $id Robot id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $robot = $this->Robots->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $robot = $this->Robots->patchEntity($robot, $this->request->getData());
            if ($this->Robots->save($robot)) {
                $this->Flash->success(__('The robot has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The robot could not be saved. Please, try again.'));
        }
        $users = $this->Robots->Users->find('list', ['limit' => 200]);
        $topics = $this->Robots->Topics->find('list', ['limit' => 200]);
        $maps = $this->Robots->Maps->find('list', ['limit' => 200]);
        $this->set(compact('robot', 'users', 'topics', 'maps'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Robot id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $robot = $this->Robots->get($id);
        if ($this->Robots->delete($robot)) {
            $this->Flash->success(__('The robot has been deleted.'));
        } else {
            $this->Flash->error(__('The robot could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if(in_array($this->request->action, ['view', 'edit', 'delete', 'connect'])){
            $robotId = (int)$this->request->getParam("pass")[0];
            return $this->Robots->find()->where(['user_id' => $user['id'], 'id' => $robotId])->count() == 1;
        }

        if (in_array($this->request->action, ['index', 'add'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
