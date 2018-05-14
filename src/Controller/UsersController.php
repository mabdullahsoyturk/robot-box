<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Core\Configure;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(["add", "forgotPassword", "logout", "activate"]);
    }

    public function forgotPassword()
    {

    }

    public function activate($token = null){
        if($token == null)
            return $this->redirect(['controller'=>'pages', 'action'=>'display', 'home']);
        $user = $this->Users->find()->where(['activation_code' => $token, 'activated' => 0])->firstOrFail();
        $user->activated = 1;
        if($this->Users->save($user)){
            $this->Flash->success("Your account has been activated successfully!");
            return $this->redirect(['controller'=>'pages', 'action'=>'display', 'home']);
        }else{
            $this->Flash->error("We cannot activate your account! If problem continues, ask for help from administrator.");
            return $this->redirect(['controller'=>'pages', 'action'=>'display', 'home']);
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    private function createToken($length = 40, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $res = "";
        for ($i = 0; $i < $length; $i++) {
            $res .= $keyspace[rand(0, strlen($keyspace) - 1)];
        }
        return $res;
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->activation_code = $this->createToken();
            $user->activated = 0; //For now
            if ($this->Users->save($user)) {
                $email = new Email('debugmail');
                $email
                    ->setTemplate('activation')
                    ->setEmailFormat("both")
                    ->setViewVars(['token' => $user->activation_code])
                    ->setSubject("UI For Warehouse Robot Activation Mail")
                    ->setTo($user->email)
                    ->send();

                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index', 'controller' => 'pages']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function login()
    {
        if($this->Auth->user() != null && $this->Auth->user() != false)
            return $this->redirect(['controller' => 'pages', 'action' => 'display', 'home']);
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
        {
            if (in_array($this->request->action, ['index', 'view', 'logout'])) {
              return true;
             }

            if (in_array($this->request->action, ['edit', 'delete'])) {
                return false;
             }
        
        return parent::isAuthorized($user);
      }
}
