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
            'contain' => ['Users', 'Topics']
        ];

        $robots = $this->paginate($this->Robots->find()->where(['OR' => ['Robots.user_id' => $this->Auth->user('id'), 'is_public_robot' =>1]]));
        foreach ($robots as $robot){
            $robot->belongsToUser = $robot->user_id == $this->Auth->user('id');
        }
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
            'contain' => ['Users', 'Topics']
        ]);
        $robot->belongsToUser = $robot->user_id == $this->Auth->user('id');
        $this->set('robot', $robot);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Topics');
        $robot = $this->Robots->newEntity();
        if ($this->request->is('post')) {
            $robot = $this->Robots->patchEntity($robot, $this->request->getData());
            $robot->user_id = $this->Auth->user("id");
            if(!$this->isAdmin($this->Auth->user('id')))
                $robot->is_public_robot = false;

            $topic = $this->Topics->get($robot->topic_id);
            if($robot->is_public_robot){
                $robot->ip_address = "--";
                $robot->port = "--";
                //Check whether also the topic is public
                if(!$topic->is_public_topic){
                    $this->Flash->error('In order to have a public robot, topic also should be public');
                }else{
                    //Robot and topic are public
                    if ($this->Robots->save($robot)) {
                        $this->Flash->success(__('The robot has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The robot could not be saved. Please, try again.'));
                }
            }else{
                //For private robots, either topic should be yours or public
                $eligible = $topic->user_id == $this->Auth->user('id') || $topic->is_public_topic;
                if($eligible){
                    if ($this->Robots->save($robot)) {
                        $this->Flash->success(__('The robot has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The robot could not be saved. Please, try again.'));
                }else{
                    $this->Flash->error(__('You are not authorized to do that.'));
                }
            }
        }

        $mapper = function ($topic, $key, $mapReduce) {
            $status  = $topic->is_public_topic  ? 'Public Topics'  : 'Private Topics';
            $mapReduce->emitIntermediate($topic, $status);
        };

        $reducer = function ($topics, $status, $mapReduce) {
            $arr = array();
            foreach ($topics as $topic)
                $arr[$topic->id] = $topic->name;
            $mapReduce->emit($arr, $status);
        };

        $topics = $this->Robots
            ->Topics
            ->find()
            ->select(['name', 'id', 'is_public_topic'])
            ->where(['or' => ['user_id' => $this->Auth->user("id"), 'is_public_topic' => true] ])
            ->mapReduce($mapper, $reducer)
            ->toArray();

        $this->set('admin', $this->isAdmin($this->Auth->user('id')));
        $this->set(compact('robot', 'topics'));
    }

    public function connect($id = null)
    {
        $robot = $this->Robots->get($id, [
            'contain' => ['Topics', 'Topics.MesTypes']
        ]);


        $port = $this->request->getQuery("port");
        $ip = $this->request->getQuery("ip");


        $this->set(compact("robot"));
        $this->set(compact('port'));
        $this->set(compact('ip'));
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
        $this->loadModel("Topics");
        $robot = $this->Robots->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $robot = $this->Robots->patchEntity($robot, $this->request->getData());
            if(!$this->isAdmin($this->Auth->user('id')))
                $robot->is_public_robot = false;

            $topic = $this->Topics->get($robot->topic_id);
            if($robot->is_public_robot){
                $robot->ip_address = "--";
                $robot->port = "--";
                //Check whether also the topic is public
                if(!$topic->is_public_topic){
                    $this->Flash->error('In order to have a public robot, topic also should be public');
                }else{
                    //Robot and topic are public
                    if ($this->Robots->save($robot)) {
                        $this->Flash->success(__('The robot has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The robot could not be saved. Please, try again.'));
                }
            }else{
                //For private robots, either topic should be yours or public
                $eligible = $topic->user_id == $this->Auth->user('id') || $topic->is_public_topic;
                if($eligible){
                    if ($this->Robots->save($robot)) {
                        $this->Flash->success(__('The robot has been saved.'));
                        return $this->redirect(['action' => 'index']);
                    }
                    $this->Flash->error(__('The robot could not be saved. Please, try again.'));
                }else{
                    $this->Flash->error(__('You are not authorized to do that.'));
                }
            }
        }

        $mapper = function ($topic, $key, $mapReduce) {
            $status  = $topic->is_public_topic  ? 'Public Topics'  : 'Private Topics';
            $mapReduce->emitIntermediate($topic, $status);
        };

        $reducer = function ($topics, $status, $mapReduce) {
            $arr = array();
            foreach ($topics as $topic)
                $arr[$topic->id] = $topic->name;
            $mapReduce->emit($arr, $status);
        };

        $topics = $this->Robots
            ->Topics
            ->find()
            ->select(['name', 'id', 'is_public_topic'])
            ->where(['or' => ['user_id' => $this->Auth->user("id"), 'is_public_topic' => true] ])
            ->mapReduce($mapper, $reducer)
            ->toArray();
        $this->set('admin', $this->isAdmin($this->Auth->user('id')));
        $this->set(compact('robot', 'topics'));
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
        if(in_array($this->request->action, ['view', 'connect'])){
            $robotId = (int)$this->request->getParam("pass")[0];
            return $this->Robots->find()->where(['id' => $robotId, 'OR' => ['user_id' => $user['id'], 'is_public_robot' => 1]])->count() == 1;
        }

        if(in_array($this->request->action, ['edit', 'delete'])){
            $robotId = (int)$this->request->getParam("pass")[0];
            return $this->Robots->find()->where(['user_id' => $user['id'], 'id' => $robotId])->count() == 1;
        }

        if (in_array($this->request->action, ['index', 'add'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
