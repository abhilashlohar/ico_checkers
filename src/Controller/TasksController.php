<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;
use Cake\I18n\Time;
/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
	const FILE_PATH = 'task_proof'.DS;
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
	public function initialize()
    {
        parent::initialize();
        
        
        $this->Auth->allow(['checkTaskProve']);
    }
    public function index()
    {
		$tasks = $this->paginate($this->Tasks->find()
		                         ->where(['user_id'=>$this->Auth->user('id')]));

        $this->set(compact('tasks','earnMoney'));
		$this->set('activeMenu', 'Tasks.index');
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'conditions' => ['user_id'=>$this->Auth->user('id')]
        ]);

        $this->set('task', $task);
		$this->set('activeMenu', 'Tasks.view');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
			$time = new Time();
			$task->created_on = $time->format('Y-m-d H:i:s');
			$task->user_id    = $this->Auth->user('id');
			$task->is_deleted = 0; 
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
		$day_option=[];
		for($i=1;$i<=30;$i++)
		{
			if($i==1 ) $day = $i.' day';
            else $day = $i.' days';
			$day_option[] = ['value'=>$i,'text'=>$day];
		}
		
        $this->set(compact('task','day_option'));
		$this->set('activeMenu', 'Tasks.add');
    }
	
	public function earnMoney()
    {
        $conditions = [
            'Tasks.is_deleted' => false,
			'user_id !=' => $this->Auth->user('id')
        ];
		$this->paginate = [
            //'fields' => ['id', 'title', 'description', 'created_on','short_description','end_days','user_id'],
            'conditions' => $conditions,
            'contain' => ['Users'=>[
							'fields' =>['name']]
							],
            'order' => ['Tasks.id' => 'DESC'],
						'limit' => 10,
			    ];
		$tasks = $this->paginate($this->Tasks); 
		$this->set(compact('tasks'));
		$this->set('activeMenu', 'Tasks.earnMoney');
    }
    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function taskSubmit($id = null)
    {
		$time = new Time();
        $task = $this->Tasks->get($id,[
		'contain'=>['Users'=>[
		'fields'=>['name']
		]]]); 
        if ($this->request->is(['patch', 'post', 'put'])) 
		{
			
			$taskProof = $this->Tasks->TaskProofs->newEntity();
			$taskProof = $this->Tasks->TaskProofs->patchEntity($taskProof, $this->request->getData());
			
			$errors = [];
			if($this->request->getData('image.tmp_name'))
			{
				$fileName = strtolower(pathinfo($this->request->getData('image.name'), PATHINFO_FILENAME));
				$fileExtension = strtolower(pathinfo($this->request->getData('image.name'), PATHINFO_EXTENSION));
				$taskProof->image = static::FILE_PATH.$fileName.'.'.$fileExtension;
				
				$file = new File(static::IMAGE_ROOT.$taskProof->image);
				$directory = $file->folder();
				$directory->create(static::IMAGE_ROOT.static::FILE_PATH);
				
				$i = 1;
				while($file->exists())
				{
					$taskProof->image = static::FILE_PATH.$fileName.' ('.$i++.').'.$fileExtension;
					$file = new File(static::IMAGE_ROOT.$taskProof->image);
				}
				
				$success = move_uploaded_file($this->request->getData('image.tmp_name'), static::IMAGE_ROOT.$taskProof->image);
				if(!$success)
				{
					$errors[] = __('Unable to upload image. Please try again.');
				}
			}  
			
			/* if(empty($errors))
            { */
				$taskProof->user_id = $this->Auth->user('id');
				$taskProof->created_date = $time->format('Y-m-d H:i:s');
				
				if ($this->Tasks->TaskProofs->save($taskProof)) {
					$this->Flash->success(__('Your Task Proof  has been saved.'));
					return $this->redirect(['action' => 'earnMoney']);
				}else{ 
					$this->Flash->error(__('The task proof could not be saved. Please, try again.'));
				}
			/* }
			else
			{   
				$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
			} */
        }
		$task_proofs = $this->Tasks->TaskProofs->find()
		              ->where(['TaskProofs.task_id'=>$id,'TaskProofs.user_id'=>$this->Auth->user('id')])
					  ->first();
        $this->set(compact('task','task_proofs'));
		$this->set('activeMenu', 'Tasks.taskSubmit');
    }
	
	public function proofApproval($id = null)
    {
		$task_proofs = $this->paginate($this->Tasks->TaskProofs->find()
		                ->contain(['Tasks','Users'])
						->where(['Tasks.is_deleted'=>false,'TaskProofs.task_id'=>$id])
						->order(['TaskProofs.id'=>'DESC']));
						
		$this->set(compact('task_proofs'));
		$this->set('activeMenu', 'Tasks.proofApproval');
	}
	
	public function approve($id = null)
    {
        $this->request->allowMethod(['post']);
        $proof = $this->Tasks->TaskProofs->get($id,[
		'contain'=>['Tasks']
		]);
        $proof->is_approved = 1;
        if ($this->Tasks->TaskProofs->save($proof)) {
			$this->loadModel('Wallets');
			$timeCurrent = new Time();
			$wallet = $this->Wallets->newEntity();
			$wallet->user_id          = $proof->user_id;
			$wallet->point            = $proof->task->minimum_point;
			$wallet->transaction_date = $timeCurrent->format('Y-m-d H:i:s');
			$wallet->task_id          = $proof->task_id;
			$this->Wallets->save($wallet);
          $this->Flash->success(__('The proof has been approved.'));
        } else {
          $this->Flash->error(__('The proof could not be approved. Please, try again.'));
        }

        return $this->redirect($this->referer());
		
    }
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
			
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
		$day_option=[];
		for($i=1;$i<=31;$i++)
		{
			$day= $i.' day';
			$day_option[] = ['value'=>$i,'text'=>$day];
		}
        $this->set(compact('task','day_option'));
		$this->set('activeMenu', 'Tasks.edit');
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $task = $this->Tasks->get($id);
        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function checkTaskProve()
    {
        $time = new Time();
		$current_date =  $time->format('Y-m-d H:i:s');
		$tasks = $this->Tasks->find()
					   ->contain(['TaskProofs','Users'])
					   ->matching('Users', function ($q){
						   return $q->where(['Users.role'=>'User']);
					   })
					   ->matching('TaskProofs', function ($qq){
						   return $qq->where(['TaskProofs.is_approved'=>false]);
					   }); 
		foreach($tasks as $task)
		{
			if(!empty($task->task_proofs))
			{
				foreach($task->task_proofs as $task_proof)
				{
					$diff = abs(strtotime($current_date)-strtotime($task_proof->created_date));
					
					if(date('H',$diff)>23)
					{
						$task_p = $this->Tasks->TaskProofs->get($task_proof->id);
						$task_p->is_approved = 1;
						$this->Tasks->TaskProofs->save($task_p);
						
						$wallet = $this->Tasks->Users->Wallets->newEntity();
						$wallet->user_id          = $task_proof->user_id;
						$wallet->point            = $task->minimum_point;
						$wallet->transaction_date = $time->format('Y-m-d H:i:s');
						$this->Users->Wallets->save($wallet);
						
						//point reduce from task creator account
						/* $task_cretor_point = $this->Tasks->Users->Wallets->find();
						$task_cretor_point = $task_cretor_point->select(['total_point'=>$task_cretor_point->func()->sum('point'),'user_id'])
											->group('user_id')
											->where(['Wallets.user_id'=>$task->user_id])->first(); */
						$w_point=$task->minimum_point;
						$task_cretor_wallet = $this->Tasks->Users->Wallets->find()
						                                  ->select(['Wallets.user_id'=>$task->user_id]);
						if(!empty($task_cretor_wallet->toArray()))
						{
							foreach($task_cretor_wallet as $task_cretor_wallet1)
							{
								$wallet1 = $this->Tasks->Users->Wallets->get($task_cretor_wallet1->id);
								if($wallet1->point > $w_point) 
								{
									$w_point = $wallet1->point-$w_point;
									$wallet1->point = $w_point;
								}
								elseif($wallet1->point < $w_point){
									$w_point = $w_point-$wallet1->point;
									$wallet1->point = $w_point;
								}
								else{
									$w_point = 0;
									$wallet1->point = 0;
								}
								$this->Tasks->Users->Wallets->save($wallet1->point);
							}
						}
					}
				}
			}
		}
		exit;
    }
}
