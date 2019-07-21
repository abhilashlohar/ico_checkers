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
        $this->Auth->allow(['index','callback','subscribe','delete']);
    }
    
   
    public function index(){

		$name   = $this->request->getQuery('name');
        $type   = $this->request->getQuery('type');
        $email  = $this->request->getQuery('email');
        $reason = $this->request->getQuery('reason');
        if(!empty($name))
		{
			$where['Enquiries.name LIKE'] = '%'.$name.'%';
		}
        if(!empty($type))
		{
			$where['Enquiries.type'] = $type;
		}
		if(!empty($email))
		{
			$where['Enquiries.email LIKE'] = '%'.$email.'%';
		}
		if(!empty($reason))
		{
			$where['Enquiries.reason'] = $reason;
		}
		$where['Enquiries.is_deleted'] = 0;
		//Inquiries
		$inquiries = $this->paginate($this->Enquiries->find()
		                  ->where($where)
						  ->order(['Enquiries.id'=>'DESC']));
		
		$this->set(compact('inquiries','name','type','email','reason'));
	}
    public function callback(){
		//Contact Inquiry
        $this->autoRender = false;
        $enquiry = $this->Enquiries->newEntity();
		$name = $this->request->getData('name');
		$email = $this->request->getData('email');
		$reason = $this->request->getData('reason');
		$message = $this->request->getData('message');
		if(!empty($name) && !empty($email))
		{
			$enquiry->name = $name;
			$enquiry->email = $email;
			$enquiry->reason = $reason;
			$enquiry->message = $message;
			$enquiry->is_deleted = 0;
			$enquiry->type = 'contact';
			if($this->Enquiries->save($enquiry))
			{
				$msg='Enquiry form has been submitted successfully.';
				$this->Flash->success(__('Enquiry form has been submitted successfully.'));
			}
			else{
				$msg='Enquiry form has been submitted successfully.';
				$this->Flash->error(__('Enquiry form has been submitted successfully.'));
			}
		}else{
			$msg='Enquiry form could not be submitted.';
			$this->Flash->error(__('Enquiry form could not be submitted.'));
		}
        echo $msg;
		return $this->redirect('/');
        $this->set(compact('msg'));
        $this->viewBuilder()->setLayout('ajax');
        
    }
    
    public function subscribe(){
		//Subscribe Inquiry
        $this->autoRender = false;
        $enquiry = $this->Enquiries->newEntity();
		$email = $this->request->getQuery('email'); 
		if(!empty($email))
		{  
			$check_enq = $this->Enquiries->find()
                        ->where(['email' => $email,'is_deleted'=>0])->first();
            
            if(empty($check_enq)){
				$enquiry->email = $email;
				$enquiry->is_deleted = 0;
				$enquiry->type = 'subscribe';
				if($this->Enquiries->save($enquiry))
				{
					$msg='Thanks! You have successfully subscribed.';
				}
				else{
					$msg='Failed.';
				}
			}
			else{
				$msg='Email Address is already subscribed!';
			}
		}else{
			$msg='Failed.';
		}
        
        echo $msg;
        $this->set(compact('msg'));
        $this->viewBuilder()->setLayout('ajax');
        
      
    }
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['get', 'delete']);
        $inquiry = $this->Enquiries->get($id);
        if ($this->Enquiries->delete($inquiry)) {
            $this->Flash->success(__('The Inquiry has been deleted.'));
        } else {
            $this->Flash->error(__('The Inquiry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
