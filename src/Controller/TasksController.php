<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;
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
    public function index()
    {
        $tasks = $this->paginate($this->Tasks);

        $this->set(compact('tasks','earnMoney'));
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
            'contain' => []
        ]);

        $this->set('task', $task);
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
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $this->set(compact('task'));
    }
	
	public function earnMoney()
    {
        $conditions = [
            'Tasks.is_deleted' => false,
        ];
		$this->paginate = [
            'fields' => ['id', 'title', 'description', 'created_on','short_description'],
            'conditions' => $conditions,
            'order' => ['Tasks.id' => 'DESC'],
			'limit' => 10
        ];
		$tasks = $this->paginate($this->Tasks);
		$this->set(compact('tasks'));
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
        $task = $this->Tasks->get($id);
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
			if(empty($errors))
            {
				$taskProof->user_id = $this->Auth->user('id');
				if ($this->Tasks->TaskProofs->save($taskProof)) {
					$this->Flash->success(__('Your Task Proof  has been saved.'));
					return $this->redirect(['action' => 'earnMoney']);
				}else{ 
					$this->Flash->error(__('The task proof could not be saved. Please, try again.'));
				}
			}
			else
			{   
				$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
			}
        }
		$task_proofs = $this->Tasks->TaskProofs->find()
		              ->where(['TaskProofs.task_id'=>$id,'TaskProofs.user_id'=>$this->Auth->user('id')])
					  ->first();
        $this->set(compact('task','task_proofs'));
    }
	
	public function proofApproval($id = null)
    {
		$task_proofs = $this->Tasks->TaskProofs->find()
		                ->contain(['Tasks'])
						->where(['Tasks.is_deleted'=>false])
						->order(['TaskProofs.id'=>'DESC']);
						
		$this->set(compact('task_proofs'));
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
        $this->set(compact('task'));
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
}
