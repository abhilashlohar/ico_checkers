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
        $passed = ['forgotPassword', 'resetPassword', 'login', 'logout', 'changeProfile', 'changePassword', 'registration','approveemail','dashboard','index','broadcastEmail','userProfile','changeStatus','brodcast','saveemailuser','healthcheck','view','emailSent','userLists','saveMsgStatus','testEmail'];
        if(!in_array($this->request->getParam('action'), $passed) )
        {
            return $this->redirect(['/Dashboard']);
        }
        
        $this->Auth->allow(['forgotPassword', 'resetPassword', 'logout','image','registration','approveemail','saveemailuser','healthcheck','testEmail']);

        $this->Security->setConfig('unlockedActions', ['registration']);
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
	public function userLists($id=null)
    {
		
        $users = $this->paginate($this->Users->find());
		$email_users = $this->Users->EmailUsers->find()
		                                     ->select(['user_id'])
											 ->where(['EmailUsers.sent_email_id'=>$id]);
		$email_user_arr=[];
		if(!empty($email_users->toArray()))
		{
			foreach($email_users as $email_user)
			{
				$email_user_arr[$email_user->user_id] = $email_user->user_id;
			}
		}
		
		$this->set(compact('users','id','user','email_user_arr'));
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
                return $this->redirect(['action' => 'userLists',$sent_email->id]);
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
		public function registration() { 
		$this->set('page_title', __('Add New User'));
		$this->viewBuilder()->setLayout('login');

    $ref_code = $this->request->getQuery('ref');

    $user = $this->Users->newEntity();
    
    if ($this->request->is('post')) {   
			$time = new Time();
      $user = $this->Users->patchEntity($user, $this->request->getData());
			$user->is_deleted = 	0; 
			$user->status = 	0; 
			$user->role = 	'User'; 
			$str = $this->_getRandomString(6).'-'.$this->_getRandomString(6).'-ico'.$this->_getRandomString(6).'-'.$this->_getRandomString(6);
			$user->password_token =  $str;
			$user->referral_code = $this->_getReferralCode(6);
			$ref= $this->request->getQuery('ref');
			

			if ($this->request->getData()['g-recaptcha-response']) {
				// Google reCAPTCHA API secret key 
        $secretKey = '6LdqIbAUAAAAADeKq7FKuEfDxj6yA7_CJnVq-hpF'; 
         
        // Verify the reCAPTCHA response 
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$this->request->getData()['g-recaptcha-response']); 
         
        // Decode json data 
        $responseData = json_decode($verifyResponse); 

        if ($responseData->success) {
        	if ($this->Users->save($user)) {
		        // Refer code
			      if ($ref_code) {
			          $RefByUser = $this->Users->find()->where(['referral_code'=>$ref_code])->first();

			          $refer = $this->Users->Refers->newEntity();
			          $refer->ref_by_user_id = $RefByUser->id;
			          $refer->ref_to_user_id = $user->id;
			          $refer->points = 10;
			          $this->Users->Refers->save($refer);
			      }
			      $wallet = $this->Users->Wallets->newEntity();
						$wallet->user_id = $user->id;
						$wallet->point = 500;
						$wallet->transaction_date = $time->format('Y-m-d H:i:s');
						$this->Users->Wallets->save($wallet);
						
						if (!empty($ref)) {
							$user_detail   = $this->Users->find()
							                  ->select('id')
												  			->where(['Users.referral_code'=>$ref,'Users.is_deleted'=>false,'Users.status'=>true])
												  			->first();
							$wallet = $this->Users->Wallets->newEntity();
							$wallet->user_id = $user_detail->id;
							$wallet->point = 200;
							$wallet->transaction_date = $time->format('Y-m-d H:i:s');
							$this->Users->Wallets->save($wallet);
						}
						
						$email = new Email('default');
		                $email->viewBuilder()->setTemplate('approve_email');
						$email->setEmailFormat('html')
							->setFrom('Info@icocheckers.com', 'ico')
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
        } else {
        	$this->Flash->error(__('Robot validation has failed.'));
        }
        $this->Flash->error(__('Robot validation has failed.'));
			}
      
            
   		$this->Flash->error(__('The user could not be added. Please see warning(s) below.'));
    }
		// country code
		$country[]= ['value'=>'Algeria (+213)','text' =>'Algeria (+213)'];
		$country[]= ['value'=>'Andorra (+376)','text' =>'Andorra (+376)'];
		$country[]= ['value'=>'Angola (+244)','text' =>'Angola (+244)'];
		$country[]= ['value'=>'Anguilla (+1264)','text' =>'Anguilla (+1264)'];
		$country[]= ['value'=>'Antigua  Barbuda (+1268)','text' =>'Antigua  Barbuda (+1268)'];
		$country[]= ['value'=>'Argentina (+54)','text' =>'Argentina (+54)'];
		$country[]= ['value'=>'Armenia (+374)','text' =>'Armenia (+374)'];
		$country[]= ['value'=>'Aruba (+297)','text' =>'Aruba (+297)'];
		$country[]= ['value'=>'Australia (+61)','text' =>'Australia (+61)'];
		$country[]= ['value'=>'Austria (+43)','text' =>'Austria (+43)'];
		$country[]= ['value'=>'Azerbaijan (+994)','text' =>'Azerbaijan (+994)'];
		$country[]= ['value'=>'Bahamas (+1242)','text' =>'Bahamas (+1242)'];
		$country[]= ['value'=>'Bahrain (+973)','text' =>'Bahrain (+973)'];
		$country[]= ['value'=>'Bangladesh (+880)','text' =>'Bangladesh (+880)'];
		$country[]= ['value'=>'Barbados (+1246)','text' =>'Barbados (+1246)'];
		$country[]= ['value'=>'Belarus (+375)','text' =>'Belarus (+375)'];
		$country[]= ['value'=>'Belgium (+32)','text' =>'Belgium (+32)'];
		$country[]= ['value'=>'Belize (+501)','text' =>'Belize (+501)'];
		$country[]= ['value'=>'Benin (+229)','text' =>'Benin (+229)'];
		$country[]= ['value'=>'Bermuda (+1441)','text' =>'Bermuda (+1441)'];
		$country[]= ['value'=>'Bhutan (+975)','text' =>'Bhutan (+975)'];
		$country[]= ['value'=>'Bolivia (+591)','text' =>'Bolivia (+591)'];
		$country[]= ['value'=>'Bosnia Herzegovina (+387)','text' =>'Bosnia Herzegovina (+387)'];
		$country[]= ['value'=>'Botswana (+267)','text' =>'Botswana (+267)'];
		$country[]= ['value'=>'Brazil (+55)','text' =>'Brazil (+55)'];
		$country[]= ['value'=>'Brunei (+673)','text' =>'Brunei (+673)'];
		$country[]= ['value'=>'Bulgaria (+359)','text' =>'Bulgaria (+359)'];
		$country[]= ['value'=>'Burkina Faso (+226)','text' =>'Burkina Faso (+226)'];
		$country[]= ['value'=>'Burundi (+257)','text' =>'Burundi (+257)'];
		$country[]= ['value'=>'Cambodia (+855)','text' =>'Cambodia (+855)'];
		$country[]= ['value'=>'Cameroon (+237)','text' =>'Cameroon (+237)'];
		$country[]= ['value'=>'Canada (+1)','text' =>'Canada (+1)'];
		$country[]= ['value'=>'Cape Verde Islands (+238)','text' =>'Cape Verde Islands (+238)'];
		$country[]= ['value'=>'Cayman Islands (+1345)','text' =>'Cayman Islands (+1345)'];
		$country[]= ['value'=>'Central African Republic (+236)','text' =>'Central African Republic (+236)'];
		$country[]= ['value'=>'Chile (+56)','text' =>'Chile (+56)'];
		$country[]= ['value'=>'China (+86)','text' =>'China (+86)'];
		$country[]= ['value'=>'Colombia (+57)','text' =>'Colombia (+57)'];
		$country[]= ['value'=>'Comoros (+269)','text' =>'Comoros (+269)'];
		$country[]= ['value'=>'Congo (+242)','text' =>'Congo (+242)'];
		$country[]= ['value'=>'Cook Islands (+682)','text' =>'Cook Islands (+682)'];
		$country[]= ['value'=>'Costa Rica (+506)','text' =>'Costa Rica (+506)'];
		$country[]= ['value'=>'Croatia (+385)','text' =>'Croatia (+385)'];
		$country[]= ['value'=>'Cuba (+53)','text' =>'Cuba (+53)'];
		$country[]= ['value'=>'Cyprus North (+90392)','text' =>'Cyprus North (+90392)'];
		$country[]= ['value'=>'Cyprus South (+357)','text' =>'Cyprus South (+357)'];
		$country[]= ['value'=>'Czech Republic (+42)','text' =>'Czech Republic (+42)'];
		$country[]= ['value'=>'Denmark (+45)','text' =>'Denmark (+45)'];
		$country[]= ['value'=>'Djibouti (+253)','text' =>'Djibouti (+253)'];
		$country[]= ['value'=>'Dominica (+1809)','text' =>'Dominica (+1809)'];
		$country[]= ['value'=>'Dominican Republic (+1809)','text' =>'Dominican Republic (+1809)'];
		$country[]= ['value'=>'Ecuador (+593)','text' =>'Ecuador (+593)'];
		$country[]= ['value'=>'Egypt (+20)','text' =>'Egypt (+20)'];
		$country[]= ['value'=>'El Salvador (+503)','text' =>'El Salvador (+503)'];
		$country[]= ['value'=>'Equatorial Guinea (+240)','text' =>'Equatorial Guinea (+240)'];
		$country[]= ['value'=>'Eritrea (+291)','text' =>'Eritrea (+291)'];
		$country[]= ['value'=>'Estonia (+372)','text' =>'Estonia (+372)'];
		$country[]= ['value'=>'Ethiopia (+251)','text' =>'Ethiopia (+251)'];
		$country[]= ['value'=>'Falkland Islands (+500)','text' =>'Falkland Islands (+500)'];
		$country[]= ['value'=>'Faroe Islands (+298)','text' =>'Faroe Islands (+298)'];
		$country[]= ['value'=>'Fiji (+679)','text' =>'Fiji (+679)'];
		$country[]= ['value'=>'Finland (+358)','text' =>'Finland (+358)'];
		$country[]= ['value'=>'France (+33)','text' =>'France (+33)'];
		$country[]= ['value'=>'French Guiana (+594)','text' =>'French Guiana (+594)'];
		$country[]= ['value'=>'French Polynesia (+689)','text' =>'French Polynesia (+689)'];
		$country[]= ['value'=>'Gabon (+241)','text' =>'Gabon (+241)'];
		$country[]= ['value'=>'Gambia (+220)','text' =>'Gambia (+220)'];
		$country[]= ['value'=>'Georgia (+7880)','text' =>'Georgia (+7880)'];
		$country[]= ['value'=>'Germany (+49)','text' =>'Germany (+49)'];
		$country[]= ['value'=>'Ghana (+233)','text' =>'Ghana (+233)'];
		$country[]= ['value'=>'Gibraltar (+350)','text' =>'Gibraltar (+350)'];
		$country[]= ['value'=>'Greece (+30)','text' =>'Greece (+30)'];
		$country[]= ['value'=>'Greenland (+299)','text' =>'Greenland (+299)'];
		$country[]= ['value'=>'Grenada (+1473)','text' =>'Grenada (+1473)'];
		$country[]= ['value'=>'Guadeloupe (+590)','text' =>'Guadeloupe (+590)'];
		$country[]= ['value'=>'Guam (+671)','text' =>'Guam (+671)'];
		$country[]= ['value'=>'Guatemala (+502)','text' =>'Guatemala (+502)'];
		$country[]= ['value'=>'Guinea (+224)','text' =>'Guinea (+224)'];
		$country[]= ['value'=>'Guinea - Bissau (+245)','text' =>'Guinea - Bissau (+245)'];
		$country[]= ['value'=>'Guyana (+592)','text' =>'Guyana (+592)'];
		$country[]= ['value'=>'Haiti (+509)','text' =>'Haiti (+509)'];
		$country[]= ['value'=>'Honduras (+504)','text' =>'Honduras (+504)'];
		$country[]= ['value'=>'Hong Kong (+852)','text' =>'Hong Kong (+852)'];
		$country[]= ['value'=>'Hungary (+36)','text' =>'Hungary (+36)'];
		$country[]= ['value'=>'Iceland (+354)','text' =>'Iceland (+354)'];
		$country[]= ['value'=>'India (+91)','text' =>'India (+91)'];
		$country[]= ['value'=>'Indonesia (+62)','text' =>'Indonesia (+62)'];
		$country[]= ['value'=>'Iran (+98)','text' =>'Iran (+98)'];
		$country[]= ['value'=>'Iraq (+964)','text' =>'Iraq (+964)'];
		$country[]= ['value'=>'Ireland (+353)','text' =>'Ireland (+353)'];
		$country[]= ['value'=>'Israel (+972)','text' =>'Israel (+972)'];
		$country[]= ['value'=>'Italy (+39)','text' =>'Italy (+39)'];
		$country[]= ['value'=>'Jamaica (+1876)','text' =>'Jamaica (+1876)'];
		$country[]= ['value'=>'Japan (+81)','text' =>'Japan (+81)'];
		$country[]= ['value'=>'Jordan (+962)','text' =>'Jordan (+962)'];
		$country[]= ['value'=>'Kazakhstan (+7)','text' =>'Kazakhstan (+7)'];
		$country[]= ['value'=>'Kenya (+254)','text' =>'Kenya (+254)'];
		$country[]= ['value'=>'Kiribati (+686)','text' =>'Kiribati (+686)'];
		$country[]= ['value'=>'Korea North (+850)','text' =>'Korea North (+850)'];
		$country[]= ['value'=>'Korea South (+82)','text' =>'Korea South (+82)'];
		$country[]= ['value'=>'Kuwait (+965)','text' =>'Kuwait (+965)'];
		$country[]= ['value'=>'Kyrgyzstan (+996)','text' =>'Kyrgyzstan (+996)'];
		$country[]= ['value'=>'Laos (+856)','text' =>'Laos (+856)'];
		$country[]= ['value'=>'Latvia (+371)','text' =>'Latvia (+371)'];
		$country[]= ['value'=>'Lebanon (+961)','text' =>'Lebanon (+961)'];
		$country[]= ['value'=>'Lesotho (+266)','text' =>'Lesotho (+266)'];
		$country[]= ['value'=>'Liberia (+231)','text' =>'Liberia (+231)'];
		$country[]= ['value'=>'Libya (+218)','text' =>'Libya (+218)'];
		$country[]= ['value'=>'Liechtenstein (+417)','text' =>'Liechtenstein (+417)'];
		$country[]= ['value'=>'Lithuania (+370)','text' =>'Lithuania (+370)'];
		$country[]= ['value'=>'Luxembourg (+352)','text' =>'Luxembourg (+352)'];
		$country[]= ['value'=>'Macao (+853)','text' =>'Macao (+853)'];
		$country[]= ['value'=>'Macedonia (+389)','text' =>'Macedonia (+389)'];
		$country[]= ['value'=>'Madagascar (+261)','text' =>'Madagascar (+261)'];
		$country[]= ['value'=>'Malawi (+265)','text' =>'Malawi (+265)'];
		$country[]= ['value'=>'Malaysia (+60)','text' =>'Malaysia (+60)'];
		$country[]= ['value'=>'Maldives (+960)','text' =>'Maldives (+960)'];
		$country[]= ['value'=>'Mali (+223)','text' =>'Mali (+223)'];
		$country[]= ['value'=>'Malta (+356)','text' =>'Malta (+356)'];
		$country[]= ['value'=>'Marshall Islands (+692)','text' =>'Marshall Islands (+692)'];
		$country[]= ['value'=>'Martinique (+596)','text' =>'Martinique (+596)'];
		$country[]= ['value'=>'Mauritania (+222)','text' =>'Mauritania (+222)'];
		$country[]= ['value'=>'Mayotte (+269)','text' =>'Mayotte (+269)'];
		$country[]= ['value'=>'Mexico (+52)','text' =>'Mexico (+52)'];
		$country[]= ['value'=>'Micronesia (+691)','text' =>'Micronesia (+691)'];
		$country[]= ['value'=>'Moldova (+373)','text' =>'Moldova (+373)'];
		$country[]= ['value'=>'Monaco (+377)','text' =>'Monaco (+377)'];
		$country[]= ['value'=>'Mongolia (+976)','text' =>'Mongolia (+976)'];
		$country[]= ['value'=>'Montserrat (+1664)','text' =>'Montserrat (+1664)'];
		$country[]= ['value'=>'Morocco (+212)','text' =>'Morocco (+212)'];
		$country[]= ['value'=>'Mozambique (+258)','text' =>'Mozambique (+258)'];
		$country[]= ['value'=>'Myanmar (+95)','text' =>'Myanmar (+95)'];
		$country[]= ['value'=>'Namibia (+264)','text' =>'Namibia (+264)'];
		$country[]= ['value'=>'Nauru (+674)','text' =>'Nauru (+674)'];
		$country[]= ['value'=>'Nepal (+977)','text' =>'Nepal (+977)'];
		$country[]= ['value'=>'Netherlands (+31)','text' =>'Netherlands (+31)'];
		$country[]= ['value'=>'New Caledonia (+687)','text' =>'New Caledonia (+687)'];
		$country[]= ['value'=>'New Zealand (+64)','text' =>'New Zealand (+64)'];
		$country[]= ['value'=>'Nicaragua (+505)','text' =>'Nicaragua (+505)'];
		$country[]= ['value'=>'Niger (+227)','text' =>'Niger (+227)'];
		$country[]= ['value'=>'Nigeria (+234)','text' =>'Nigeria (+234)'];
		$country[]= ['value'=>'Niue (+683)','text' =>'Niue (+683)'];
		$country[]= ['value'=>'Norfolk Islands (+672)','text' =>'Norfolk Islands (+672)'];
		$country[]= ['value'=>'Northern Marianas (+670)','text' =>'Northern Marianas (+670)'];
		$country[]= ['value'=>'Norway (+47)','text' =>'Norway (+47)'];
		$country[]= ['value'=>'Oman (+968)','text' =>'Oman (+968)'];
		$country[]= ['value'=>'Pakistan (+92)','text' =>'Pakistan (+92)'];
		$country[]= ['value'=>'Palau (+680)','text' =>'Palau (+680)'];
		$country[]= ['value'=>'Panama (+507)','text' =>'Panama (+507)'];
		$country[]= ['value'=>'Papua New Guinea (+675)','text' =>'Papua New Guinea (+675)'];
		$country[]= ['value'=>'Paraguay (+595)','text' =>'Paraguay (+595)'];
		$country[]= ['value'=>'Peru (+51)','text' =>'Peru (+51)'];
		$country[]= ['value'=>'Philippines (+63)','text' =>'Philippines (+63)'];
		$country[]= ['value'=>'Poland (+48)','text' =>'Poland (+48)'];
		$country[]= ['value'=>'Portugal (+351)','text' =>'Portugal (+351)'];
		$country[]= ['value'=>'Puerto Rico (+1787)','text' =>'Puerto Rico (+1787)'];
		$country[]= ['value'=>'Qatar (+974)','text' =>'Qatar (+974)'];
		$country[]= ['value'=>'Reunion (+262)','text' =>'Reunion (+262)'];
		$country[]= ['value'=>'Romania (+40)','text' =>'Romania (+40)'];
		$country[]= ['value'=>'Russia (+7)','text' =>'Russia (+7)'];
		$country[]= ['value'=>'Rwanda (+250)','text' =>'Rwanda (+250)'];
		$country[]= ['value'=>'San Marino (+378)','text' =>'San Marino (+378)'];
		$country[]= ['value'=>'Sao Tome Principe (+239)','text' =>'Sao Tome Principe (+239)'];
		$country[]= ['value'=>'Saudi Arabia (+966)','text' =>'Saudi Arabia (+966)'];
		$country[]= ['value'=>'Senegal (+221)','text' =>'Senegal (+221)'];
		$country[]= ['value'=>'Serbia (+381)','text' =>'Serbia (+381)'];
		$country[]= ['value'=>'Seychelles (+248)','text' =>'Seychelles (+248)'];
		$country[]= ['value'=>'Sierra Leone (+232)','text' =>'Sierra Leone (+232)'];
		$country[]= ['value'=>'Singapore (+65)','text' =>'Singapore (+65)'];
		$country[]= ['value'=>'Slovak Republic (+421)','text' =>'Slovak Republic (+421)'];
		$country[]= ['value'=>'Slovenia (+386)','text' =>'Slovenia (+386)'];
		$country[]= ['value'=>'Solomon Islands (+677)','text' =>'Solomon Islands (+677)'];
		$country[]= ['value'=>'Somalia (+252)','text' =>'Somalia (+252)'];
		$country[]= ['value'=>'South Africa (+27)','text' =>'South Africa (+27)'];
		$country[]= ['value'=>'Spain (+34)','text' =>'Spain (+34)'];
		$country[]= ['value'=>'Sri Lanka (+94)','text' =>'Sri Lanka (+94)'];
		$country[]= ['value'=>'St. Helena (+290)','text' =>'St. Helena (+290)'];
		$country[]= ['value'=>'St. Kitts (+1869)','text' =>'St. Kitts (+1869)'];
		$country[]= ['value'=>'St. Lucia (+1758)','text' =>'St. Lucia (+1758)'];
		$country[]= ['value'=>'Sudan (+249)','text' =>'Sudan (+249)'];
		$country[]= ['value'=>'Suriname (+597)','text' =>'Suriname (+597)'];
		$country[]= ['value'=>'Swaziland (+268)','text' =>'Swaziland (+268)'];
		$country[]= ['value'=>'Sweden (+46)','text' =>'Sweden (+46)'];
		$country[]= ['value'=>'Switzerland (+41)','text' =>'Switzerland (+41)'];
		$country[]= ['value'=>'Syria (+963)','text' =>'Syria (+963)'];
		$country[]= ['value'=>'Taiwan (+886)','text' =>'Taiwan (+886)'];
		$country[]= ['value'=>'Tajikstan (+7)','text' =>'Tajikstan (+7)'];
		$country[]= ['value'=>'Thailand (+66)','text' =>'Thailand (+66)'];
		$country[]= ['value'=>'Togo (+228)','text' =>'Togo (+228)'];
		$country[]= ['value'=>'Tonga (+676)','text' =>'Tonga (+676)'];
		$country[]= ['value'=>'Trinidad  Tobago (+1868)','text' =>'Trinidad  Tobago (+1868)'];
		$country[]= ['value'=>'Tunisia (+216)','text' =>'Tunisia (+216)'];
		$country[]= ['value'=>'Turkey (+90)','text' =>'Turkey (+90)'];
		$country[]= ['value'=>'Turkmenistan (+7)','text' =>'Turkmenistan (+7)'];
		$country[]= ['value'=>'Turkmenistan (+993)','text' =>'Turkmenistan (+993)'];
		$country[]= ['value'=>'Turks Caicos Islands (+1649)','text' =>'Turks Caicos Islands (+1649)'];
		$country[]= ['value'=>'Tuvalu (+688)','text' =>'Tuvalu (+688)'];
		$country[]= ['value'=>'Uganda (+256)','text' =>'Uganda (+256)'];
		$country[]= ['value'=>'UK (+44) ','text' =>'UK (+44) '];
		$country[]= ['value'=>'Ukraine (+380)','text' =>'Ukraine (+380)'];
		$country[]= ['value'=>'United Arab Emirates (+971)','text' =>'United Arab Emirates (+971)'];
		$country[]= ['value'=>'Uruguay (+598)','text' =>'Uruguay (+598)'];
		$country[]= ['value'=>'USA (+1) ','text' =>'USA (+1) '];
		$country[]= ['value'=>'Uzbekistan (+7)','text' =>'Uzbekistan (+7)'];
		$country[]= ['value'=>'Vanuatu (+678)','text' =>'Vanuatu (+678)'];
		$country[]= ['value'=>'Vatican City (+379)','text' =>'Vatican City (+379)'];
		$country[]= ['value'=>'Venezuela (+58)','text' =>'Venezuela (+58)'];
		$country[]= ['value'=>'Vietnam (+84)','text' =>'Vietnam (+84)'];
		$country[]= ['value'=>'Virgin Islands - British (+1284)','text' =>'Virgin Islands - British (+1284)'];
		$country[]= ['value'=>'Virgin Islands - US (+1340)','text' =>'Virgin Islands - US (+1340)'];
		$country[]= ['value'=>'Wallis &amp; Futuna (+681)','text' =>'Wallis &amp; Futuna (+681)'];
		$country[]= ['value'=>'Yemen (North)(+969)','text' =>'Yemen (North)(+969)'];
		$country[]= ['value'=>'Yemen (South)(+967)','text' =>'Yemen (South)(+967)'];
		$country[]= ['value'=>'Zambia (+260)','text' =>'Zambia (+260)'];
		$country[]= ['value'=>'Zimbabwe (+263)','text' =>'Zimbabwe (+263)'];

        $this->set(compact('user','country'));
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
                                ->setFrom('Info@icocheckers.com', 'ico')
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
                                ->setFrom('Info@icocheckers.com', 'ico')
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
	
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Wallets']
        ]); 
		$point=0;
		if(!empty($user->wallets))
		{
			foreach($user->wallets as $wallet)
			{
				$point +=$wallet->point;
			}
		}
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user','point'));
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
	public function xyz()
    {
		$id= $this->Auth->user('id');
		$user = $this->Users->get($id);
		 if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
		 }  pr($user);exit;
	}
	public function userProfile()
    {
		$id= $this->Auth->user('id');  
		try
        {
			$user = $this->Users->get($id,[
			'conditions'=>['Users.is_deleted'=>false,'Users.status'=>true,'Users.role'=>'User']
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
			$userCopy = clone $user;
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
				else{
					$user->photo = $userCopy->photo;
				}
			if(empty($errors))
            { 	
		        $user->dob = date('Y-m-d',strtotime($user->dob));
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
		$chk        = $this->request->getQuery('chk');
		if($chk==1)
		{
			$email_user = $this->Users->SentEmails->EmailUsers->newEntity();
			$email_user->sent_email_id = $this->request->getQuery('id');
			$email_user->user_id       = $this->request->getQuery('user_id');
			$email_user->status        = 'Pending';
			$exist=$this->Users->SentEmails->EmailUsers->find()
			                   ->where(['EmailUsers.sent_email_id'=>$this->request->getQuery('id'),'EmailUsers.user_id'=>$this->request->getQuery('user_id'),'EmailUsers.status'=>'Pending'])->count();
			if($exist==0){
				if ($this->Users->SentEmails->EmailUsers->save($email_user)) {
				  echo 'Add user successfully';
				} else {
				  echo 'Try Again';
				}
			}
		}
		else{
			$this->Users->SentEmails->EmailUsers->deleteAll(['EmailUsers.user_id'=>$this->request->getQuery('user_id'),'EmailUsers.sent_email_id'=>$this->request->getQuery('id')]);
		}
        exit;
    }

    public function healthcheck(){
    	$this->viewBuilder()->setLayout('');
    	echo "hello"; exit();
    }
	public function saveMsgStatus()
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
		$id= $this->request->getQuery('id');
		if(!empty($id))
		{
			$email_exist = $this->Users->SentEmails->EmailUsers->find()
			                           ->where(['EmailUsers.sent_email_id'=>$id,'EmailUsers.status'=>'Pending'])->count();
			if($email_exist!=0)
			{
				$sent_mail = $this->Users->SentEmails->get($id);
				$sent_mail->status ='sent';
				if($this->Users->SentEmails->save($sent_mail))
				{ 
					echo 1;
				}else
				{ 
					echo 0;
				}
			}
		} exit;
	}
	
	
	
	public function emailSent()
    {
		$email_users = $this->Users->SentEmails->EmailUsers->find()
									->where(['EmailUsers.status'=>'Pending'])
                                    ->contain(['Users'=>function($a){
										return $a->select(['id','email','name']);
									},'SentEmails'])
									->matching('SentEmails', function($q){
										return $q->where(['SentEmails.status'=>'Sent']);
									})->limit(10);
		if(!empty($email_users->toArray()))
		{
			$emailArr=[];
			foreach($email_users as $email_user)
			{
				if(!empty($email_user->user))
				{
					$email = new Email('default');
					$email->setEmailFormat('html')
						->setFrom('Info@icocheckers.com', 'ico')
						->setReplyTo($email_user->user->email, 'ico')
						->setTo($email_user->user->email, $email_user->user->name)
						->setSubject('Meassage');
						$email->viewBuilder()->setTemplate('meaasage');
						$email->setViewVars([
							'name' => $email_user->user->name,
							'msg'  => $email_user->sent_email->message
						])
						->send();
					$email_user1 = $this->SentEmails->EmailUsers->get($email_user->id);
					$email_user1->status = 'send';
					$this->SentEmails->EmailUsers->save($email_user1);
				}
			}
			
		}

	}
	
	public function testEmail()
	{
		$email = new Email('default');
					$email->setEmailFormat('html')
						->setFrom('info@icocheckers.com', 'ico')
						->setReplyTo('info@icocheckers.com', 'ico')
						->setTo('info@icocheckers.com', 'Abhilash')
						->setSubject('Meassage');
						$email->viewBuilder()->setTemplate('meaasage');
						$email->setViewVars([
							'name' => 'Jai Shree Ram',
							'msg'  => 'Jai Shree Ram'
						])
						->send();
		exit;
	}
}
