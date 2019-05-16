<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Exception\BadRequestException;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	const FILE_PATH = 'user'.DS;
	public function initialize()
    {
        parent::initialize();
        $passed = ['forgotPassword', 'resetPassword', 'login', 'logout', 'changeProfile', 'changePassword', 'registration','approveemail','dashboard','index','broadcastEmail','userProfile','changeStatus','brodcast','saveemailuser','healthcheck'];
        if(!in_array($this->request->getParam('action'), $passed) )
        {
            return $this->redirect(['/Dashboard']);
        }
        
        $this->Auth->allow(['forgotPassword', 'resetPassword', 'logout','image','registration','approveemail','saveemailuser','healthcheck']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void 
     */
    public function index($id=null)
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users','id'));
    }

	public function brodcast()
    {
        $users = $this->Users->sentEmails->newEntity();
		if($this->request->is('post'))
        {
			$sent_email = $this->Users->SentEmails->patchEntity($users, $this->request->getData());
			$sent_email->create_date = date('Y-m-d');
			$sent_email->status = 'Draft';
			
			if($sent_email = $this->Users->sentEmails->save($sent_email))
            {
				$this->Flash->success(__('Message successfully Save.'));
                return $this->redirect(['action' => 'index',$sent_email->id]);
			}
			else{ 
				$this->Flash->error(__('The message could not be save.'));
			}
		}
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
		$this->viewBuilder()->setLayout('login');

        $ref_code = $this->request->getQuery('ref');

        $user = $this->Users->newEntity();
        if($this->request->is('post'))
        {   
			
            $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->is_deleted = 	0; 
			$user->status = 	0; 
			$user->role = 	'User'; 
			$str = $this->_getRandomString(6).'-'.$this->_getRandomString(6).'-ico'.$this->_getRandomString(6).'-'.$this->_getRandomString(6);
			$user->password_token =  $str;
			$user->referral_code = $this->_getReferralCode(6);

            if($this->Users->save($user))
            {
                // Refer code
                if($ref_code){
                    $RefByUser = $this->Users->find()->where(['referral_code'=>$ref_code])->first();

                    $refer = $this->Users->Refers->newEntity();
                    $refer->ref_by_user_id = $RefByUser->id;
                    $refer->ref_to_user_id = $user->id;
                    $refer->points = 10;
                    $this->Users->Refers->save($refer);
                }
                

				$email = new Email('default');
                $email->viewBuilder()->setTemplate('approve_email');
				$email->setEmailFormat('html')
					->setFrom('manoj@ifwworld.com', 'ico')
					->setReplyTo($user->email, 'ico')
					->setTo($user->email, $user->name)
					->setSubject('Approve your Email')
					->setViewVars([
						'str' => $str,
						'name'=> $user->name,
						'sitename' => 'ico'
					])
					->send();
                $this->Flash->success(__('The user has been added successfully.'));
                return $this->redirect(['action' => 'login']);
            }
            
            $this->Flash->error(__('The user could not be added. Please see warning(s) below.'));
        }
        $this->set(compact('user'));
		$this->set('activeMenu', ' Users.registration');
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

                    
                    if($this->Auth->user('role')!='User')
					{ 
				        return $this->redirect('/Dashboard');
					}
					else{
						return $this->redirect('/Refer-and-Earn');
					}
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
		$this->set('activeMenu', ' Users.login');
    }
    
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
    
    public function approveemail($passwordToken=null)
	{
		$this->set('page_title', 'Approve Email');
      
        $userInfo = $this->Users->find()
            ->select(['id', 'name', 'email', 'status', 'token_expiry', 'is_deleted'])
            ->where([
                'Users.password_token' => $passwordToken,
                'Users.is_deleted' => false
            ])
            ->first();
        
        if($userInfo)
        {   
            if($userInfo->status==false)
            {    
                 $userInfo->status = 1;
				 $userInfo->password_token = null;
				
				 if($this->Users->save($userInfo))
				 {
					$this->Flash->success(__('Your email approval  successfully.Plz login.'));
						return $this->redirect(['action' => 'login']);
				 }
				 else{
						$this->Flash->error(__('Your email approval  unsuccessfull. Please contact site administrator.'));
						return $this->redirect(['action' => 'login']);
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
		exit;
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
            if(!$user->getErrors())
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
                            $email->setEmailFormat('html')
                                ->setFrom('manoj@ifwworld.com', 'ico')
                                ->setReplyTo($userInfo->email, 'ico')
                                ->setTo($userInfo->email, $userInfo->name)
                                ->setSubject('Reset your Password for icoss');
								$email->viewBuilder()->setTemplate('forgot_password');
                                //$email->template('forgot_password')
                                $email->setViewVars([
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
        $this->viewBuilder()->setLayout('login');
        
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
                        if($this->Users->save($user))
                        {
                            $email = new Email('default');
                            $email->setEmailFormat('html')
                                ->setFrom('manoj@ifwworld.com', 'ico')
                                ->setReplyTo($userInfo->email, 'ico')
                                ->setTo($userInfo->email, $userInfo->name)
                                ->setSubject('jupiter account password has been changed successfully');
								$email->viewBuilder()->setTemplate('reset_password');
                                //->template('reset_password')
                                 $email->setViewVars([
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
	
    
    public function dashboard()
    {
		$this->set(compact('dashboard'));
        $this->set('activeMenu', ' Users.dashboard');
    }
	
	public function broadcastEmail()
    {
        $user = $this->Users->newEntity();
        $this->set(compact('user'));
    }
	
	public function userProfile()
    {
		$id= $this->Auth->user('id'); 
		try
        {
			$user = $this->Users->get($id,[
			'fields'=>['id','name','email','mobile','photo','dob'],
			'conditions'=>['Users.id'=>$id,'Users.is_deleted'=>false,'Users.status'=>true,'role'=>'User']
			]);
			$formattableFields = ['dob'];
            foreach($formattableFields as $formattableField)
            {
                if($user->{$formattableField})
                {
                    $fieldDate = new Time($user->{$formattableField});
                    $user->{$formattableField} = $fieldDate->format('d/m/Y');
                }
            }
		 }
        catch(RecordNotFoundException $e)
        {
            $this->Flash->error(__('Invalid selection.'));
            return $this->redirect(['controller' => 'Refers', 'action' => 'index']);
        }  
		if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
			
			 $errors = [];
                if($this->request->getData('photo.tmp_name'))
                {
                    $fileName = strtolower(pathinfo($this->request->getData('photo.name'), PATHINFO_FILENAME));
                    $fileExtension = strtolower(pathinfo($this->request->getData('photo.name'), PATHINFO_EXTENSION));
                    $user->photo = static::FILE_PATH.$fileName.'.'.$fileExtension;
                    
                    $file = new File(static::IMAGE_ROOT.$user->photo);
                    $directory = $file->folder();
                    $directory->create(static::IMAGE_ROOT.static::FILE_PATH);
                    
                    $i = 1;
                    while($file->exists())
                    {
                        $user->photo = static::FILE_PATH.$fileName.' ('.$i++.').'.$fileExtension;
                        $file = new File(static::IMAGE_ROOT.$user->photo);
                    }
                    
                    $success = move_uploaded_file($this->request->getData('photo.tmp_name'), static::IMAGE_ROOT.$user->photo);
                    if(!$success)
                    {
                        $errors[] = __('Unable to upload category image. Please try again.');
                    }
                }
			if(empty($errors))
            {  
				if ($this->Users->save($user)) {
					$this->Flash->success(__('The user has been saved.'));

					return $this->redirect(['action' => 'userProfile']);
				}
				else{
					$this->Flash->error(__('The user could not be saved. Please, try again.'));
				}
			}
			else
			{
				$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
			}
        }
		$this->set(compact('user'));
	}
	public function changeStatus($id = null,$status=null)
    {
        
        $user = $this->Users->get($id);
		if($status=='active')
		{
			$user->status = 1;
        }else{
			$user->status = 0;
		}
        if ($this->Users->save($user)) {
          $this->Flash->success(__('The user status '.$status ));
        } else {
          $this->Flash->error(__('The user status could not be change. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
	
	public function saveemailuser()
    {
		$this->autoRender = false;
        try
        {
            if(!$this->request->is('ajax'))
            {
                throw new BadRequestException();
            }
        }
        catch(BadRequestException $e)
        {
            $this->Flash->error(__('Only ajax request can be processed.'));
            return $this->redirect($this->_redirectUrl());
        }
		echo '1';exit;
        $email_user = $this->Users->SentEmails->EmailUsers->newEntity();
		$email_user->sent_email_id = $this->request->getData('id');
		$email_user->user_id       = $this->request->getData('user_id');
		$email_user->status        = 'Pending';
		
        if ($this->Users->SentEmails->EmailUsers->save($email_user)) {
          echo 'Add user successfully';
        } else {
          echo 'Try Again';
        }

        exit;
    }

    public function healthcheck(){
    	$this->viewBuilder()->setLayout('');
    	echo "hello"; exit();
    }
}
