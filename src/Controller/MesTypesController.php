<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MesTypes Controller
 *
 * @property \App\Model\Table\MesTypesTable $MesTypes
 *
 * @method \App\Model\Entity\MesType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MesTypesController extends AppController
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
        $mesTypes = $this->paginate($this->MesTypes->find()->where(['OR' => ['MesTypes.user_id' => $this->Auth->user('id'), 'is_public_message_type' => 1]]));
        foreach ($mesTypes as $mesType){
            $mesType->belongsToUser = $mesType->user->id == $this->Auth->user('id');
        }
        $this->set(compact('mesTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Mes Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mesType = $this->MesTypes->get($id, [
            'contain' => ['Users']
        ]);
        $belongsToUser = $mesType->user->id == $this->Auth->user('id');

        $this->set('belongsToUser', $belongsToUser);
        $this->set('mesType', $mesType);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mesType = $this->MesTypes->newEntity();
        if ($this->request->is('post')) {
            $mesType = $this->MesTypes->patchEntity($mesType, $this->request->getData());
            $mesType->user_id = $this->Auth->user("id");
            if(!$this->isAdmin($this->Auth->user('id'))){
                $mesType->is_public_message_type = false;
                //Only admins can add public message types
            }

            if ($this->MesTypes->save($mesType)) {
                $this->Flash->success(__('The mes type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mes type could not be saved. Please, try again.'));
        }
        $this->set(compact('mesType'));
        $this->set('admin', $this->isAdmin($this->Auth->user('id')));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mes Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mesType = $this->MesTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mesType = $this->MesTypes->patchEntity($mesType, $this->request->getData());
            $mesType->user_id = $this->Auth->user("id");
            if(!$this->isAdmin($this->Auth->user('id'))){
                $mesType->is_public_message_type = false;
                //Only admins can add public message types
            }

            if ($this->MesTypes->save($mesType)) {
                $this->Flash->success(__('The mes type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mes type could not be saved. Please, try again.'));
        }
        $this->set(compact('mesType'));
        $this->set('admin', $this->isAdmin($this->Auth->user('id')));
    }

    /**
     * Delete method
     *
     * @param string|null $id Mes Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mesType = $this->MesTypes->get($id);
        if ($this->MesTypes->delete($mesType)) {
            $this->Flash->success(__('The mes type has been deleted.'));
        } else {
            $this->Flash->error(__('The mes type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if($this->request->action == 'view'){
            $messageTypeId = (int)$this->request->getParam("pass")[0];
            return $this->MesTypes->find()
                ->where(['id' => $messageTypeId,
                 'OR' => ['user_id' => $user['id'], 'is_public_message_type' => 1]])->count() == 1;
        }
        if(in_array($this->request->action , ['index', 'add'])) return true;
        if(in_array($this->request->action, ['edit', 'delete'])){
            $messageTypeId = (int)$this->request->getParam("pass")[0];
            return $this->MesTypes->find()->where(['user_id' => $user['id'], 'id' => $messageTypeId])->count() == 1;
        }

        return false;
    }

}
