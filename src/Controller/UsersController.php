<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\NotFoundException;
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
        $passed = ['forgotPassword', 'resetPassword', 'login', 'logout', 'changeProfile', 'changePassword', 'registration'];
        if(!in_array($this->request->getParam('action'), $passed) )
        {
            $this->Flash->error(__('You are not authorized to access that location.'));
            return $this->redirect(['controller' => 'Dashboards', 'action' => 'index']);
        }
        
        $this->Auth->allow(['forgotPassword', 'resetPassword', 'logout','image']);
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

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function registration()
    {
		
        $this->set('page_title', __('Add New User'));
        $user = $this->Users->newEntity();
        if($this->request->is('post'))
        {   
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->is_deleted = 	0; 
            if($this->Users->save($user))
            {
                $this->Flash->success(__('The user has been added successfully.'));
                return $this->redirect(['action' => 'login']);
            }
            
            $this->Flash->error(__('The user could not be added. Please see warning(s) below.'));
        }
        $this->set(compact('user'));
    }
	
	public function login()
    {
        $this->set('page_title', 'Administration Login');
        $this->viewBuilder()->setLayout('login');
        
        if($this->request->is('post'))
        {
			
            //$this->_sessionDestroy();
            $this->Auth->logout();
            
            $user = $this->Auth->identify();
            if($user && $user['is_deleted'] === false)
            {
                if($user['status'])
                {
                    $this->Auth->setUser($user);
                    
                    $currentUser = $this->Users->get($user['id']);
                    if($currentUser)
                    {
                        $this->Users->touch($currentUser, 'Users.login');
                        $this->Users->save($currentUser);
                    }
                    
                    return $this->redirect($this->Auth->redirectUrl());
                }
                else
                {
                    $this->Flash->error(__('Your account is suspended. Please contact site administrator.'));
                    return $this->redirect($this->Auth->loginAction);
                }
            }
           
            $this->Flash->error(__('Invalid username or password, try again'));
            return $this->redirect($this->Auth->loginAction);
        }
        
        $user = $this->Users->newEntity();
        $this->set(compact('user'));
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    public function forgotPassword()
    {   
        $this->set('page_title', 'Forgot password');
        $this->viewBuilder()->setLayout('login');
        
        $user = $this->Users->newEntity();
        if($this->request->is(['patch', 'post', 'put']))
        {
            $user = $this->Users->patchEntity($user, $this->request->getData(), [
                'validate' => 'forgotPassword'
            ]);
            if(!$user->errors())
            {  
                $userInfo = $this->Users->find()
                    ->select(['id', 'name', 'email', 'status', 'is_deleted'])
                    ->where(['Users.email' => $this->request->getData('email')])
                    ->andWhere(['Users.is_deleted' => false])
                    ->first();
               
                if($userInfo)
                {
                    if($userInfo->status)
                    {
                        $time = new Time();
                        $time->modify('+3 Days');
                        
                        $user2 = $this->request
                            ->withData('password_token', $this->_getRandomString(6).'-'.$this->_getRandomString(6).'-'.
                                crypt($userInfo->id, 'ico').'-'.$this->_getRandomString(6).'-'.$this->_getRandomString(6))
                            ->withData('token_expiry', $time->format('Y-m-d H:i:s'))
                            ->withData('is_deleted', $userInfo->is_deleted);
                         
                        $user = $this->Users->patchEntity($userInfo, $user2->getData(), [
                            'accessibleFields' => ['password_token' => true, 'token_expiry' => true]
                        ]);
                        //pr($user);exit;
                        if($this->Users->save($user))
                        {
                            $email = new Email('default');
                            $email->emailFormat('html')
                                ->setFrom('manoj@ifwworld.com', 'ico')
                                ->replyTo('manojtanwar953@gmail.com', 'ico')
                                ->setTo($userInfo->email, $userInfo->name)
                                ->setSubject('Reset your Password for icoss')
                                ->template('forgot_password')
                                ->viewVars([
                                    'userInfo' => $userInfo,
                                    'passwordToken' => $user->password_token,
                                    'tokenExpiry' => $user->token_expiry,
                                    'sitename' => 'ico'
                                ])
                                ->send();
                            
                            $this->Flash->success(__('An email have been sent to your email address with instructions to reset your password.'));
                            return $this->redirect(['action' => 'login']);
                        }
                        else
                        {
                            $this->Flash->error(__('We are unable to complete your request at this time. Please try again.'));
                        }
                    }
                    else
                    {
                        $this->Flash->error(__('Your account is suspended. Please contact site administrator.'));
                    }
                }
                else
                {
                    $this->Flash->error(__('We couldn\'t find an account named with {0} as email address.', $this->request->getData('email')));
                }
            }
            else
            {
                $this->Flash->error(__('Please correct the error(s) below and try again.'));
            }
        }
        
        $this->set(compact('user'));
    }
    
    public function resetPassword($passwordToken = null)
    {
        $this->set('page_title', 'Reset password');
        $this->viewBuilder()->setLayout('admin_login');
        
        $userInfo = $this->Users->find()
            ->select(['id', 'name', 'email', 'status', 'token_expiry', 'is_deleted'])
            ->where([
                'Users.password_token' => $passwordToken,
                'Users.is_deleted' => false
            ])
            ->first();
        
        if($userInfo)
        {
            if($userInfo->status)
            {
                $timeCurrent = new Time();
                $timeExpiry = new Time($userInfo->token_expiry);
                if($timeExpiry->format('Y-m-d H:i:s') >= $timeCurrent->format('Y-m-d H:i:s'))
                { 
					
                    $user = $this->Users->newEntity();
                    if($this->request->is(['patch', 'post', 'put']))
                    {
						
                        $user2 = $this->request
                            ->withData('password_token', '')
                            ->withData('token_expiry', NULL)
                            ->withData('is_deleted', $userInfo->is_deleted);
                        
                        $user = $this->Users->patchEntity($userInfo, $user2->getData(), [
                            'validate' => 'resetPassword',
                            'accessibleFields' => ['password_token' => true, 'token_expiry' => true]
                        ]);
                        $hasher = new DefaultPasswordHasher();
						$user->password = 	$hasher->hash($user->password);
                        if($this->Users->save($user))
                        {
                            $email = new Email('default');
                            $email->emailFormat('html')
                                ->setFrom('manoj@ifwworld.com', 'jupiter')
                                ->replyTo('manoj@ifwworld.com', 'jupiter')
                                ->setTo($userInfo->email, $userInfo->name)
                                ->setSubject('jupiter account password has been changed successfully')
                                ->template('reset_password')
                                ->viewVars([
                                    'userInfo' => $userInfo,
                                    'sitename' => 'Jupiter'
                                ])
                                ->send();
                            
                            $this->Flash->success(__('Your password has been reset successfully! Please login using your email address and new password.'));
                            return $this->redirect(['action' => 'login']);
                        }
                        else
                        {
                            $this->Flash->error(__('We are unable to complete your request at this time. Please try again.'));
                        }
                    }
                }
                else
                {
                    $this->Flash->error(__('Your password reset token has been expired.'));
                    return $this->redirect(['action' => 'forgotPassword']);
                }
            }
            else
            {
                $this->Flash->error(__('Your account is suspended. Please contact site administrator.'));
                return $this->redirect(['action' => 'login']);
            }
        }
        else
        {
            $this->Flash->error(__('Token supplied is invalid.'));
            return $this->redirect(['action' => 'forgotPassword']);
        }
        
        $this->set(compact('user'));
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
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
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
	
	
}
