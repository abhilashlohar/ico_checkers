<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * MdiCoins Controller
 *
 * @property \App\Model\Table\MdiCoinsTable $MdiCoins
 *
 * @method \App\Model\Entity\MdiCoin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MdiCoinsController extends AppController
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
        $mdiCoins = $this->paginate($this->MdiCoins->find()->where(['MdiCoins.module'=>'Pending-Withdraw-Request']));

        $this->set(compact('mdiCoins'));
    }

    /**
     * View method
     *
     * @param string|null $id Mdi Coin id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mdiCoin = $this->MdiCoins->get($id, [
            'contain' => ['Users', 'Tasks']
        ]);

        $this->set('mdiCoin', $mdiCoin);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      $user_id = $this->Auth->user('id');
      $this->set(compact('user_id'));

      # START: Save  withdraw request
      $mdiCoin = $this->MdiCoins->newEntity();
      if ($this->request->is('post')) {
        $data = $this->request->getData();

        $meta_description['payment_mode'] = $data['payment_mode'];
        if ($data['google_mobile_no']) $meta_description['google_mobile_no'] = $data['google_mobile_no'];
        if ($data['paypal_email']) $meta_description['paypal_email'] = $data['paypal_email'];
        if ($data['ethereum_address']) $meta_description['ethereum_address'] = $data['ethereum_address'];
        // Wallet - Refer-and-Earn
        $meta_description = json_encode( $meta_description);
        $this->manageWallet(
          $user_id, 
          $data['points'], 
          'Pending-Withdraw-Request', 
          null, 
          null, 
          $meta_description
        );
        
        $this->Flash->success(__('The withdraw request has been sent.'));
        return $this->redirect(['action' => 'add']);
      }
      $this->set(compact('mdiCoin'));
      # END: Save  withdraw request

      # START: Check request already sent or not
      $RequestExists = $this->MdiCoins->find()->where(['user_id'=>$user_id, 'module'=>'Pending-Withdraw-Request'])->first();
      if($RequestExists){
        $RequestExists_coins = $RequestExists->coins;
      }else{
        $RequestExists_coins = 0;
      }
      $this->set(compact('RequestExists'));
      # END: Check request already sent or not

      $this->set('wallet_balance', $this->walletBalance($user_id));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mdi Coin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cancel($id = null)
    {
      $this->request->allowMethod(['post']);
      $mdiCoin = $this->MdiCoins->get($id);
      $mdiCoin->module = "Cancelled-Withdraw-Request";
      if ($this->MdiCoins->save($mdiCoin)) {
          $this->Flash->success(__('The withdraw request has been cancelled.'));

          return $this->redirect(['action' => 'add']);
      }
      $this->Flash->error(__('The withdraw request could not be cancelled. Please, try again.'));
    }

    
    public function approve($id = null)
    {
      $this->request->allowMethod(['post']);
      $mdiCoin = $this->MdiCoins->get($id);
      $mdiCoin->module = "Approved-Withdraw-Request";
      if ($this->MdiCoins->save($mdiCoin)) {
          $this->Flash->success(__('The withdraw request has been approved.'));
      } else {
          $this->Flash->error(__('The withdraw request could not be approved. Please, try again.'));
      }

      return $this->redirect(['action' => 'index']);
    }

    public function reject($id = null)
    {
      $this->request->allowMethod(['post']);
      $mdiCoin = $this->MdiCoins->get($id);
      $mdiCoin->module = "Rejected-Withdraw-Request";
      if ($this->MdiCoins->save($mdiCoin)) {
          $this->Flash->success(__('The withdraw request has been rejected.'));
      } else {
          $this->Flash->error(__('The withdraw request could not be rejected. Please, try again.'));
      }

      return $this->redirect(['action' => 'index']);
    }

  public function addCoins($user_id) {
    if (!$user_id) return $this->redirect(['action' => 'index']);

    # START: Fetching user info
    $user = $this->MdiCoins->Users->get($user_id);
    $this->set(compact('user'));
    # END: Fetching user info

    $mdiCoin = $this->MdiCoins->newEntity();
    if ($this->request->is('post')) {
      $data = $this->request->getData();

      if ($data['wallet_action'] == 'ADD') $module_type = 'Manually-added';
      if ($data['wallet_action'] == 'REMOVE') $module_type = 'Manually-removed';

      $meta_description['reason'] = $data['reason']; 
      // Wallet - Refer-and-Earn
      $meta_description = json_encode( $meta_description);
      $this->manageWallet(
        $user_id, 
        $data['coins'], 
        $module_type, 
        null, 
        null, 
        $meta_description
      );

      if ($data['wallet_action'] == 'ADD') {
        $email = new Email('default');
        $email->viewBuilder()->setTemplate('coin_add');
        $email->setEmailFormat('html')
              ->setFrom('info@icocheckers.com', 'ICO-CHECKERS')
              ->setReplyTo('info@icocheckers.com', 'ICO-CHECKERS')
              ->setTo($user->email, $user->name)
              ->setSubject('Admin added some MDI coins in your wallet.')
              ->setViewVars([
                'user_name' => $user->name,
                'coins'=> $data['coins'],
                'reason' => $data['reason']
              ])
              ->send();
      } else {
        $email = new Email('default');
        $email->viewBuilder()->setTemplate('coin_remove');
        $email->setEmailFormat('html')
              ->setFrom('info@icocheckers.com', 'ICO-CHECKERS')
              ->setReplyTo('info@icocheckers.com', 'ICO-CHECKERS')
              ->setTo($user->email, $user->name)
              ->setSubject('Admin removed some MDI coins in your wallet.')
              ->setViewVars([
                'user_name' => $user->name,
                'coins'=> $data['coins'],
                'reason' => $data['reason']
              ])
              ->send();
      }
      
      
      $this->Flash->success(__('Wallet managed.'));
      return $this->redirect(['action' => 'addCoins', $user_id]);
    }
    $this->set('mdiCoin', $mdiCoin);

    $this->set('wallet_balance', $this->walletBalance($user_id)); # Setting wallet balance  static
  }
}
