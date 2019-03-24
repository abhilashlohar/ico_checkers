<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Airdrops Controller
 *
 * @property \App\Model\Table\AirdropsTable $Airdrops
 *
 * @method \App\Model\Entity\Airdrop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AirdropsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $airdrops = $this->paginate($this->Airdrops);

        $this->set(compact('airdrops'));
    }

    /**
     * View method
     *
     * @param string|null $id Airdrop id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $airdrop = $this->Airdrops->get($id, [
            'contain' => []
        ]);

        $this->set('airdrop', $airdrop);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $airdrop = $this->Airdrops->newEntity();
        if ($this->request->is('post')) {
            $airdrop = $this->Airdrops->patchEntity($airdrop, $this->request->getData());
            $airdrop->applied_on = date('Y-m-d h:i:s');
            if ($this->Airdrops->save($airdrop)) {
                $this->Flash->success(__('The airdrop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airdrop could not be saved. Please, try again.'));
        }
        $this->set(compact('airdrop'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Airdrop id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $airdrop = $this->Airdrops->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $airdrop = $this->Airdrops->patchEntity($airdrop, $this->request->getData());
            if ($this->Airdrops->save($airdrop)) {
                $this->Flash->success(__('The airdrop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airdrop could not be saved. Please, try again.'));
        }
        $this->set(compact('airdrop'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Airdrop id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $airdrop = $this->Airdrops->get($id);
        if ($this->Airdrops->delete($airdrop)) {
            $this->Flash->success(__('The airdrop has been deleted.'));
        } else {
            $this->Flash->error(__('The airdrop could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
