<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Topics Controller
 *
 * @property \App\Model\Table\TopicsTable $Topics
 *
 * @method \App\Model\Entity\Topic[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TopicsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'MesTypes']
        ];
        $topics = $this->paginate($this->Topics->find()->where(['OR' => ['Topics.user_id' => $this->Auth->user('id'), 'is_public_topic' => 1]]));
        foreach ($topics as $topic){
            $topic->belongsToUser = $topic->user_id == $this->Auth->user('id');
        }
        $this->set(compact('topics'));
    }

    /**
     * View method
     *
     * @param string|null $id Topic id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $topic = $this->Topics->get($id, [
            'contain' => ['Users', 'MesTypes', 'Robots']
        ]);

        $this->set('topic', $topic);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $topic = $this->Topics->newEntity();
        $this->loadModel("MesTypes");
        if ($this->request->is('post')) {
            $topic = $this->Topics->patchEntity($topic, $this->request->getData());
            $topic->user_id = $this->Auth->user("id");
            if(!$this->isAdmin($this->Auth->user('id')))
                $topic->is_public_topic = false;
            $mesType = $this->MesTypes->get($topic->mes_id);
            if($topic->is_public_topic){
                //Check whether also the message type is public
                if(!$mesType->is_public_message_type){
                    $this->Flash->error('In order to have a public topic, message type also should be public');
                }else{
                    //Message type and topic are public
                    if ($this->Topics->save($topic)) {
                        $this->Flash->success(__('The topic has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The topic could not be saved. Please, try again.'));
                }
            }else{
                //For private topics, either message type should be yours or public
                $eligible = $mesType->user_id == $this->Auth->user('id') || $mesType->is_public_message_type;
                if($eligible){
                    if ($this->Topics->save($topic)) {
                        $this->Flash->success(__('The topic has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The topic could not be saved. Please, try again.'));
                }else{
                    $this->Flash->error(__('You are not authorized to do that.'));
                }
            }
        }
        $mapper = function ($mesType, $key, $mapReduce) {
            $status  = $mesType->is_public_message_type  ? 'Public Message Types'  : 'Private Message Types';
            $mapReduce->emitIntermediate($mesType, $status);
        };

        $reducer = function ($mesTypes, $status, $mapReduce) {
            $arr = array();
            foreach ($mesTypes as $mesType)
                $arr[$mesType->id] = $mesType->name;
            $mapReduce->emit($arr, $status);
        };

        $mesTypes = $this->Topics
            ->MesTypes
            ->find()
            ->select(['name', 'id', 'is_public_message_type'])
            ->where(['or' => ['user_id' => $this->Auth->user("id"), 'is_public_message_type' => true] ])
            ->mapReduce($mapper, $reducer)
            ->toArray();

        $this->set(compact('topic', 'mesTypes'));
        $this->set('admin', $this->isAdmin($this->Auth->user('id')));
    }

    /**
     * Edit method
     *
     * @param string|null $id Topic id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $topic = $this->Topics->get($id, [
            'contain' => []
        ]);
        $this->loadModel("MesTypes");
        if ($this->request->is(['patch', 'post', 'put'])) {
            $topic = $this->Topics->patchEntity($topic, $this->request->getData());
            $topic->user_id = $this->Auth->user('id');
            if(!$this->isAdmin($this->Auth->user('id')))
                $topic->is_public_topic = false;
            $mesType = $this->MesTypes->get($topic->mes_id);
            if($topic->is_public_topic){
                //Check whether also the message type is public
                if(!$mesType->is_public_message_type){
                    $this->Flash->error('In order to have a public topic, message type also should be public');
                }else{
                    //Message type and topic are public
                    if ($this->Topics->save($topic)) {
                        $this->Flash->success(__('The topic has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The topic could not be saved. Please, try again.'));
                }
            }else{
                //For private topics, either message type should be yours or public
                $eligible = $mesType->user_id == $this->Auth->user('id') || $mesType->is_public_message_type;
                if($eligible){
                    if ($this->Topics->save($topic)) {
                        $this->Flash->success(__('The topic has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The topic could not be saved. Please, try again.'));
                }else{
                    $this->Flash->error(__('You are not authorized to do that.'));
                }
            }
        }
        $users = $this->Topics->Users->find('list', ['limit' => 200]);

        $mapper = function ($mesType, $key, $mapReduce) {
            $status  = $mesType->is_public_message_type  ? 'Public Message Types'  : 'Private Message Types';
            $mapReduce->emitIntermediate($mesType, $status);
        };

        $reducer = function ($mesTypes, $status, $mapReduce) {
            $arr = array();
            foreach ($mesTypes as $mesType)
                $arr[$mesType->id] = $mesType->name;
            $mapReduce->emit($arr, $status);
        };

        $mesTypes = $this->Topics
            ->MesTypes
            ->find()
            ->select(['name', 'id', 'is_public_message_type'])
            ->where(['or' => ['user_id' => $this->Auth->user("id"), 'is_public_message_type' => true] ])
            ->mapReduce($mapper, $reducer)
            ->toArray();


        $this->set(compact('topic', 'users', 'mesTypes'));
        $this->set('admin', $this->isAdmin($this->Auth->user('id')));
    }

    /**
     * Delete method
     *
     * @param string|null $id Topic id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $topic = $this->Topics->get($id);
        if ($this->Topics->delete($topic)) {
            $this->Flash->success(__('The topic has been deleted.'));
        } else {
            $this->Flash->error(__('The topic could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if ($this->request->action == 'view') {
            $topicId = (int)$this->request->getParam("pass")[0];
            return $this->Topics->find()->where(['id' => $topicId, 'OR' => ['user_id' => $user['id'], 'is_public_topic' => 1]])->count() == 1;
        }

        if (in_array($this->request->action, ['edit', 'delete'])) {
            $topicId = (int)$this->request->getParam("pass")[0];
            return $this->Topics->find()->where(['user_id' => $user['id'], 'id' => $topicId])->count() == 1;
        }

        if (in_array($this->request->action, ['index', 'add'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
