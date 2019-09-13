<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

	 const IMAGE_ROOT = WWW_ROOT.'img'.DS;
	/**
	 * Initialization hook method.
	 *
	 * Use this method to add common initialization code like loading components.
	 *
	 * e.g. `$this->loadComponent('Security');`
	 *
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();

		// echo "<div align='center'><br/><br/><br/><h2 style='line-height:40px;color:#545454;'>Site is under maintenance. it will be resume soon. <br> Thanks for your patience.</h2><br/><div><img src='https://icocheckers.com/img/new-logo.png' style='height:40px;background-color: #000;padding: 15px 25px;border-radius: 10px;' /></div></div>";
		// exit();

		$this->loadComponent('RequestHandler', [
			'enableBeforeRedirect' => false,
		]);
		$this->loadComponent('Flash');
		$this->loadComponent('Security');
		$this->loadComponent('Auth', [
		 'authenticate' => [
				'Form' => [
				'fields' => [
						'username' => 'email',
						'password' => 'password',
						'is_deleted' => false
					],
					'userModel' => 'Users'
				]
			],
			'loginAction' => ['controller' => 'Users', 'action' => 'login'],
			//'loginRedirect' => ['controller' => 'News', 'action' => 'index'],
			'unauthorizedRedirect' => $this->referer(),
		]);
		
		 $this->userId = $this->Auth->user('id');
		 $this->role = $this->Auth->user('role'); 
		 
		if($this->Auth->user('name')){
			$session_user_name = explode(" ", $this->Auth->user('name'))[0];
			$this->set(compact('session_user_name'));
		}
		// Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
		// FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
		// Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable Date
		// FrozenDate::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable Date

		/*
		 * Enable the following component for recommended CakePHP security settings.
		 * see https://book.cakephp.org/3.0/en/controllers/components/security.html
		 */
		//$this->loadComponent('Scurity');
		$imageRoot = static::IMAGE_ROOT;  
		$this->set(compact('imageRoot'));


    # START: Core variables
		$MDICoins = [
      'sign_up' => 50,
      'refer' => 20,
    ];
    $this->set(compact('MDICoins'));
    # END: Core variables
	}
	
	public function beforeRender(Event $event)
	{   
		parent::beforeRender($event); 
		// $this->Security->setConfig('unlockedActions', ['saveemailuser']);
		
		if(@$this->role=='Admin' || @$this->role=='Staff')
		{   

			$admin_controllers=[
				'News.add',
				'News.index',
				'News.view',
				'News.edit',
				'Tasks.add',
				'Tasks.index',
				'Tasks.view',
				'Tasks.edit',
				'Tasks.proofApproval',
				'Airdrops.add',
				'Icos.add',
				'Icos.index',
				'Users.dashboard',
        'Users.menus',
				'Users',
				'Airdrops.index',
				'News.home', 
				'Users.index',
				'Users.broadcastEmail',
				'Airdrops.edit',
				'Airdrops.view', 
				'Refers.withdrawRequests',
				'Users.brodcast',
				'Users.view',
				'Users.userLists',
				'Enquiries.index',
        'News.saveNewsImage',
        'Comments.index',
        'MdiCoins.index',
        'MdiCoins.addCoins',
        'News.userView',
        'News.userNews',
			];

			if(!in_array($this->request->getParam('controller').'.'.$this->request->getParam('action'), $admin_controllers))
			{
				$this->Flash->error(__('You are not authorized to access that location.'));
				return $this->redirect('/Dashboard');
			}

		}elseif(@$this->role=='User'){

			$user_actions=[
				'News.userNews',
				'News.view',
				'Tasks.add',
				'Tasks.index',
				'Tasks.earnMoney',
				'Tasks.taskSubmit',
				'Tasks.view',
				'Tasks.edit',
				'Tasks.proofApproval',
				'Airdrops.airdropUserView',
				'Refers.index',
				'Users.login', 
				'News.home', 
				'Users.login',
				'Icos.add',
				'News.userView',
				'Airdrops.userView',
				'Users.userProfile', 
				'Refers.wallet',
				'News.add',
				'News.index',
				'News.edit',
        'MdiCoins.add',
			];
			
			if(!in_array($this->request->getParam('controller').'.'.$this->request->getParam('action'), $user_actions))
			{
				$this->Flash->error(__('You are not authorized to access that location.'));
				return $this->redirect(['controller' => 'Refers', 'action' => 'index']);
			}
		}
		$user_id = @$this->userId;
		$user_role = @$this->role; 
		$this->set(compact('user_id','user_role'));

		
		$menuActive = $this->request->getParam('controller').'.'.$this->request->getParam('action'); 
		$this->set(compact('menuActive'));
	}
	protected function _getRandomString($length = 10, $validCharacters = null)
	{
		if($validCharacters == '')
		{
			$validCharacters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
		}
		
		$validCharactersCount = strlen($validCharacters);
		
		$string = '';
		for($i=0; $i<$length; $i++)
		{
			$string .= $validCharacters[mt_rand(0, $validCharactersCount-1)];
		}
		
		return $string;
	}

	protected function _getReferralCode($length = 10, $validCharacters = null)
	{
		if($validCharacters == '')
		{
			$validCharacters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
		}
		
		$validCharactersCount = strlen($validCharacters);
		
		$string = '';
		for($i=0; $i<$length; $i++)
		{
			$string .= $validCharacters[mt_rand(0, $validCharactersCount-1)];
		}

		$this->loadModel('Users');
		$v = $this->Users->find()->where(['referral_code'=>$string])->count();
		if($v==0){
			return $string;
		}else{
			$this->_getReferralCode(6);
		}
		
	}
	protected function _redirectUrl()
	{
		if($this->request->query('page') > 1)
		{
			return ['action' => 'index', 'page' => $this->request->query('page')];
		}
		
		return ['action' => 'index'];
	}


	# To save in wallet
	public function manageWallet($user_id, $coins, $module, $task_id=NULL, $referred_user=NULL, $meta_description) {
		$this->loadModel('MdiCoins');
		$MdiCoin = $this->MdiCoins->newEntity();
		$MdiCoin->user_id 					= $user_id;
		$MdiCoin->coins 						= $coins;
		$MdiCoin->module 						= $module;
		$MdiCoin->task_id 	        = $task_id;
    $MdiCoin->referred_user     = $referred_user;
		$MdiCoin->meta_description 	= $meta_description;
    $MdiCoin->date_created      = date('Y-m-d H:i:s');
    $MdiCoin->date_modified     = date('Y-m-d H:i:s');
		if ($this->MdiCoins->save($MdiCoin)) {
			return true;
		} else {
			return false;
		}
	}

  public function walletBalance($user_id) {
    #------Modules-------
    # Refer-and-Earn
    # Sign-up
    # Task
    # Manually-added

    # Manually-removed
    # Approved-Withdraw-Request
    # Pending-Withdraw-Request


    # Cancelled-Withdraw-Request
    # Rejected-Withdraw-Request
    #-------------------------

    $this->loadModel('MdiCoins');
    $coinRows = $this->MdiCoins->find()->where(['user_id'=>$user_id]);

    $walletBalance = 0;
    foreach ($coinRows as $coinRow) {
      if (in_array($coinRow->module, ['Refer-and-Earn','Sign-up','Task','Manually-added'])) {
        $walletBalance += $coinRow->coins;
      }

      if (in_array($coinRow->module, ['Manually-removed','Approved-Withdraw-Request','Pending-Withdraw-Request'])) {
        $walletBalance -= $coinRow->coins;
      }
    }

    return $walletBalance;
  }
}
