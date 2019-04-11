<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Refers Controller
 *
 * @property \App\Model\Table\RefersTable $Refers
 *
 * @method \App\Model\Entity\Refer[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RefersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $referral_code = $this->Auth->User()['referral_code'];
        $this->set('referral_code', $referral_code);
		$this->set('activeMenu', 'Refers.index');
    }

    /**
     * View method
     *
     * @param string|null $id Refer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $refer = $this->Refers->get($id, [
            'contain' => ['RefByUsers', 'RefToUsers']
        ]);

        $this->set('refer', $refer);
		$this->set('activeMenu', ' Refers.view');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $refer = $this->Refers->newEntity();
        if ($this->request->is('post')) {
            $refer = $this->Refers->patchEntity($refer, $this->request->getData());
            if ($this->Refers->save($refer)) {
                $this->Flash->success(__('The refer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The refer could not be saved. Please, try again.'));
        }
        $refByUsers = $this->Refers->RefByUsers->find('list', ['limit' => 200]);
        $refToUsers = $this->Refers->RefToUsers->find('list', ['limit' => 200]);
        $this->set(compact('refer', 'refByUsers', 'refToUsers'));
		$this->set('activeMenu', ' Refers.add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Refer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $refer = $this->Refers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $refer = $this->Refers->patchEntity($refer, $this->request->getData());
            if ($this->Refers->save($refer)) {
                $this->Flash->success(__('The refer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The refer could not be saved. Please, try again.'));
        }
        $refByUsers = $this->Refers->RefByUsers->find('list', ['limit' => 200]);
        $refToUsers = $this->Refers->RefToUsers->find('list', ['limit' => 200]);
        $this->set(compact('refer', 'refByUsers', 'refToUsers'));
		$this->set('activeMenu', ' Refers.edit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Refer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $refer = $this->Refers->get($id);
        if ($this->Refers->delete($refer)) {
            $this->Flash->success(__('The refer has been deleted.'));
        } else {
            $this->Flash->error(__('The refer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
