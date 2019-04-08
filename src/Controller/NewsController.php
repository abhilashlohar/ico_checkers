<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;
/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 *
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsController extends AppController
{
	const FILE_PATH = 'news'.DS;
	public function initialize()
    {
        parent::initialize();
        
        
        $this->Auth->allow(['index', 'add','userNews','view', 'home']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $news = $this->paginate(
            $this->News->find()
            ->order([
                'published_on'=>"DESC"
            ])
        );

        $this->set(compact('news'));
    }

    public function userNews()
    {
		$conditions = [
            'News.is_deleted' => false,
            'News.is_approved' => 'yes'
        ];
		$this->paginate = [
            'fields' => ['id', 'title', 'cover_image', 'short_description', 'created_on'],
            'conditions' => $conditions,
            'order' => ['News.id' => 'DESC'],
			'limit' => 10
        ];
		$news = $this->paginate($this->News);
		$this->set(compact('news'));
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => []
        ]);

        $this->set('news', $news);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $news = $this->News->newEntity();
        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->getData());
			$errors = [];
			if($this->request->getData('cover_image.tmp_name'))
			{
				$fileName = strtolower(pathinfo($this->request->getData('cover_image.name'), PATHINFO_FILENAME));
				$fileExtension = strtolower(pathinfo($this->request->getData('cover_image.name'), PATHINFO_EXTENSION));
				$news->cover_image = static::FILE_PATH.$fileName.'.'.$fileExtension;
				
				$file = new File(static::IMAGE_ROOT.$news->cover_image);
				$directory = $file->folder();
				$directory->create(static::IMAGE_ROOT.static::FILE_PATH);
				
				$i = 1;
				while($file->exists())
				{
					$news->cover_image = static::FILE_PATH.$fileName.' ('.$i++.').'.$fileExtension;
					$file = new File(static::IMAGE_ROOT.$news->cover_image);
				}
				
				$success = move_uploaded_file($this->request->getData('cover_image.tmp_name'), static::IMAGE_ROOT.$news->cover_image);
				if(!$success)
				{
					$errors[] = __('Unable to upload cover photo. Please try again.');
				}
			}  
			if(empty($errors))
            {
				$news->is_approved = "no";
				$news->created_on = date("Y-m-d h:i:s");
				$news->created_by = 11; // session user_id
				if ($this->News->save($news)) {
					$this->Flash->success(__('The news has been saved.'));

					return $this->redirect(['action' => 'index']);
				}else{
					$this->Flash->error(__('The news could not be saved. Please, try again.'));
				}
			}
			else
			{
				$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
			}
        }
        $this->set(compact('news'));
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => []
        ]);
		$newsDb = clone $news;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->getData());
			if($this->request->getData('cover_image.tmp_name'))
			{
				$fileName = strtolower(pathinfo($this->request->getData('cover_image.name'), PATHINFO_FILENAME));
				$fileExtension = strtolower(pathinfo($this->request->getData('cover_image.name'), PATHINFO_EXTENSION));
				$news->cover_image = static::FILE_PATH.$fileName.'.'.$fileExtension;
				
				$file = new File(static::IMAGE_ROOT.$news->cover_image);
				$directory = $file->folder();
				$directory->create(static::IMAGE_ROOT.static::FILE_PATH);
				
				$i = 1;
				while($file->exists())
				{
					$news->cover_image = static::FILE_PATH.$fileName.' ('.$i++.').'.$fileExtension;
					$file = new File(static::IMAGE_ROOT.$news->cover_image);
				}
				
				$success = move_uploaded_file($this->request->getData('cover_image.tmp_name'), static::IMAGE_ROOT.$news->cover_image);
				if(!$success)
				{
					$errors[] = __('Unable to upload cover photo. Please try again.');
				}
			}else{
				$news->cover_image = $newsDb->cover_image;
			}				
			if(empty($errors))
            {
				if ($this->News->save($news)) {
					$this->Flash->success(__('The news has been saved.'));

					return $this->redirect(['action' => 'index']);
				}
				$this->Flash->error(__('The news could not be saved. Please, try again.'));
			}
			else
			{
				$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
			}
        }
        $this->set(compact('news'));
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function approve($id = null)
    {
        $this->request->allowMethod(['post']);
        $news = $this->News->get($id);
        $news->is_approved = "yes";
        $news->published_on = date("Y-m-d h:i s");
        if ($this->News->save($news)) {
          $this->Flash->success(__('The news has been approved.'));
        } else {
          $this->Flash->error(__('The news could not be approved. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function home(){
		$role = $this->role;
        $this->viewBuilder()->setLayout('cryptoland');
		$this->set(compact('role'));
    }
}
