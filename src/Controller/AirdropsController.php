<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
/**
 * Airdrops Controller
 *
 * @property \App\Model\Table\AirdropsTable $Airdrops
 *
 * @method \App\Model\Entity\Airdrop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AirdropsController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        
        
        $this->Auth->allow(['airdropUserView','view','edit']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$time = new Time();
        $airdrops = $this->paginate($this->Airdrops);

        $this->set(compact('airdrops','time'));
		$this->set('activeMenu', 'Airdrops.index');
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
		$this->set('activeMenu', 'Airdrops.view');
    }
	
	public function userView($id = null)
    {
        $airdrop = $this->Airdrops->get($id, [
            'contain' => []
        ]);

        $this->set('airdrop', $airdrop);
		$this->set('activeMenu', 'Airdrops.userView');
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
            $airdrop->created_on = date('Y-m-d h:i:s');
            $airdrop->is_deleted = 0; 
			
            if ($this->Airdrops->save($airdrop)) { 
                $this->Flash->success(__('The airdrop has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airdrop could not be saved. Please, try again.'));
        }
        $this->set(compact('airdrop'));
		$this->set('activeMenu', 'Airdrops.add');
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
		$this->set('activeMenu', 'Airdrops.edit');
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
	
	public function airdropUserView()
    {
		$conditions = [
            'Airdrops.is_deleted' => false
        ];
		$this->paginate = [
            'fields' => ['id', 'name', 'link', 'country', 'email', 'created_on', 'description','project_quality','strongness','different_ico','actual_use','team'],
            'conditions' => $conditions,
            'order' => ['Airdrops.id' => 'DESC'],
			'limit' => 10
        ];
		$airdrops = $this->paginate($this->Airdrops);
		$this->set(compact('airdrops'));
		$this->set('activeMenu', 'Airdrops.airdropUserView');
    }
}
