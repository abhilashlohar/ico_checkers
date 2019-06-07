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
		$referral_code = @$this->Auth->User()['referral_code'];
		$this->set('referral_code', $referral_code);
		$this->set('activeMenu', 'Refers.index');
	}


	public function withdrawRequests()
	{
		$requests = $this->Refers->Withdraws->find()->where(['is_money_transfered'=>'no'])->contain(['Users']);
		$this->set(compact('requests'));
	}

	public function moneySent($id){
		$Withdraw = $this->Refers->Withdraws->get($id);
		$Withdraw->is_money_transfered = "yes";
		$this->Refers->Withdraws->save($Withdraw);
		$this->Flash->success(__('Status updated.'));
		return $this->redirect(['action' => 'withdrawRequests']);
	}

	public function CancelRequest($id){
		$Withdraw = $this->Refers->Withdraws->get($id);
		$Withdraw->is_money_transfered = "cancle";
		$this->Refers->Withdraws->save($Withdraw);
		$this->Flash->success(__('Status updated.'));
		return $this->redirect(['action' => 'withdrawRequests']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Refer id.
	 * @return \Cake\Http\Response|void
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function wallet()
	{
		$session_user_id = $this->Auth->user('id');
		
		$Rf = $this->Refers->find();
		$Rf
			->select(['refer_sum' => $Rf->func()->sum('Refers.points')])
			->where(['ref_by_user_id'=>$session_user_id]);
		if($Rf->toArray()[0]){
			$refer_sum = $Rf->toArray()[0]->refer_sum;
		}else{
			$refer_sum = 0;
		}

		$Wt = $this->Refers->Withdraws->find();
		$Wt
			->select(['withdraw_sum' => $Wt->func()->sum('Withdraws.points')])
			->where(['user_id'=>$session_user_id, 'is_money_transfered'=>'yes']);
		if($Wt->toArray()[0]){
			$withdraw_sum = $Wt->toArray()[0]->withdraw_sum;
		}else{
			$withdraw_sum = 0;			
		}

		$Wlt = $this->Refers->Wallets->find();
		$Wlt
			->select(['wallet_sum' => $Wlt->func()->sum('Wallets.point')])
			->where(['user_id'=>$session_user_id]);
		if($Wlt->toArray()[0]){
			$wallet_sum = $Wlt->toArray()[0]->wallet_sum;
		}else{
			$wallet_sum = 0;			
		}

		$Request = $this->Refers->Withdraws->find()->where(['user_id'=>$session_user_id, 'is_money_transfered'=>'no'])->first();
		if($Request){
			$request_points = $Request->points;
		}else{
			$request_points = 0;
		}

		$wallet_balance = $refer_sum + $wallet_sum - $withdraw_sum - $request_points;

		$Withdraw = $this->Refers->Withdraws->newEntity();
		if ($this->request->is('post')) { 
			$Withdraw = $this->Refers->Withdraws->patchEntity($Withdraw, $this->request->getData());
			$Withdraw->user_id = $session_user_id; 
			if ($this->Refers->Withdraws->save($Withdraw)) {
				$this->Flash->success(__('The withdraw request has been sent.'));

				return $this->redirect(['action' => 'wallet']);
			}
			$this->Flash->error(__('The withdraw request could not be sent. Please, try again.'));
		}
		$this->set(compact('Withdraw', 'Request', 'session_user_id', 'wallet_balance'));
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
	public function delete($user_id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$request = $this->Refers->Withdraws->find()->where(['user_id'=>$user_id, 'is_money_transfered'=>'no'])->first();
		if ($this->Refers->Withdraws->delete($request)) {
			$this->Flash->success(__('The withdraw request has been deleted.'));
		} else {
			$this->Flash->error(__('The withdraw request could not be deleted. Please, try again.'));
		}

		return $this->redirect(['action' => 'wallet']);
	}
}
