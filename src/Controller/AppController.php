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

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
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
        // Time::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable DateTime
        // FrozenTime::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable DateTime
        // Date::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any mutable Date
        // FrozenDate::setJsonEncodeFormat('yyyy-MM-dd HH:mm:ss');  // For any immutable Date

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
		$imageRoot = static::IMAGE_ROOT;  
        $this->set(compact('imageRoot'));
    }
	public function beforeRender(Event $event)
    {
        parent::beforeRender($event); 
		
		if(@$this->role=='Admin' || @$this->role=='Staff')
		{   
			$admin_controllers=['News.add','News.index','News.view','News.view','News.edit','Tasks.add','Tasks.index','Tasks.view','Tasks.edit','Tasks.proofApproval','Airdrops.add','Icos.add','Icos.index','Dashboards.index','Users','Airdrops.index'];
			if(!in_array($this->request->getParam('controller').'.'.$this->request->getParam('action'), $admin_controllers))
			{
				$this->Flash->error(__('You are not authorized to access that location.'));
				return $this->redirect(['controller' => 'Dashboards', 'action' => 'index']);
			}

		}elseif($this->role=='User'){
			$user_actions=['News.userNews','News.view','Tasks.add','Tasks.index','Tasks.earnMoney','Tasks.taskSubmit','Tasks.view','Tasks.proofApproval','Airdrops.airdropUserView','Refers.index'];
			if(!in_array($this->request->getParam('controller').'.'.$this->request->getParam('action'), $user_actions))
			{
				$this->Flash->error(__('You are not authorized to access that location.'));
				return $this->redirect(['controller' => 'Refers', 'action' => 'index']);
			}
		}
       // pr($this->request->params['action']);exit;
        $user_id = @$this->userId;
        $user_role = @$this->role; 
		$this->set(compact('user_id','user_role'));
       
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
}
