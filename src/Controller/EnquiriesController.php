<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Network\Exception\NotFoundException;

class EnquiriesController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->Auth->allow(['callback','subscribe']);
    }
    
   
    
    public function callback(){
        $this->autoRender = false;
        $enquiry = $this->Enquiries->newEntity();
        if($this->request->is('post'))
        {
			pr($this->request->data());exit;
            $enquiry2 = $this->request->withData('is_deleted', 0)
                            ->withData('type', 'contact');
            $enquiry = $this->Enquiries->patchEntity($enquiry, $enquiry2->getData());
            
            if(!$enquiry->errors())
            {
                if($this->Enquiries->save($enquiry))
                {
                    $email = new Email();
                    $email->transport('gmail');
                    $email->emailFormat('html')
                      ->setTo($this->coreVariable['emailSenderEmail'], $this->coreVariable['siteName'])
                      ->setSubject('Request Callback enquiry for '.$this->coreVariable['siteName'])
                      ->template('enquiry')
                      ->viewVars([
                          'enquiry' => $enquiry,
                        ])
                      ->send();
					  $this->Flash->success(__('Enquiry form has been submitted successfully.'));
                    
                }
                else
                {
					$this->Flash->error(__('Enquiry form could not be submitted.'));
                    
                }
            }
            else
            {
				$this->Flash->error(__('Enquiry form could not be submitted.'));
               
            }
        }
       return $this->redirect('/');
        $this->set(compact('msg'));
        $this->viewBuilder()->setLayout('ajax');
        
    }
    
    public function subscribe(){
        $this->autoRender = false;
        $enquiry = $this->Enquiries->newEntity();
        if($this->request->is('post'))
        {
            
            $check_enq = $this->Enquiries->find()
                        ->where(['Enquiries.email' => $this->request->getData('email'),'Enquiries.is_deleted' => false])
                        ->first();
            
            if(empty($check_enq)){
            
            $enquiry2 = $this->request->withData('is_deleted', 0)
                                       ->withData('type', 'subscribe');
            $enquiry = $this->Enquiries->patchEntity($enquiry, $enquiry2->getData(),[
                'validate' => 'subscribe'
            ]);
            if(!$enquiry->errors())
            {
                if($this->Enquiries->save($enquiry))
                {
                    $email = new Email();
                    $email->transport('gmail');
                    $email->emailFormat('html')
                          ->setTo($this->coreVariable['emailSenderEmail'], $this->coreVariable['emailSenderName'])
                          ->setSubject('Subscription for '.$this->coreVariable['siteName'])
                          ->template('subscribe')
                          ->viewVars([
                              'enquiry' => $enquiry,
                            ])
                          ->send();
                    
                    $msg =  '<div class="note note-success show" role="alert" id="success_message"  onclick="this.classList.add("hidden")" style="color:green;">Thanks! You have successfully subscribed.</div>';
					
                }
                else
                {
                    $msg =  '<div class="note note-danger show" role="alert" id="error_message"  onclick="this.classList.add("hidden");" style="color:#d82424;">Failed</div>';
                }
            }
            else
            {
                 $msg =  '<div class="note note-danger show" role="alert" id="error_message"  onclick="this.classList.add("hidden");" style="color:#d82424;">Failed</div>';
            }
            }
            else
            {
                 $msg =  '<div class="note note-danger show" role="alert" id="error_message"  onclick="this.classList.add("hidden");" style="color:#d82424;">Email Address is already subscribed!</div>';
            }
        echo $msg;
        $this->set(compact('msg'));
        $this->viewBuilder()->setLayout('ajax');
        }
      
    }
    
   
}
