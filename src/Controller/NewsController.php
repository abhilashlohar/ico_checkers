<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File;
use Cake\I18n\Time;
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
	
	public function initialize() {
    parent::initialize();
    $this->Auth->allow(['userNews', 'home','userView','savePoint']);
  }

  /**
   * Index method
   *
   * @return \Cake\Http\Response|void
   */
  public function index() {
  	$user_id 		= $this->Auth->user('id');
  	$user_role 	= $this->Auth->user('role');

  	# Admin can see all news but user will be able see his own news only
  	$where_clause = "";
  	if ($user_role=="User") $where_clause = ['News.created_by'=>$user_id];

    $news = $this->paginate(
        $this->News->find()
        ->where($where_clause)
        ->order([
            'published_on'=>"DESC"
        ])
        ->contain(['Users'])
    );

    $this->set(compact('news', 'user_role'));
		$this->set('activeMenu', 'News.index');
  }

  public function userNews() {
		$conditions = [
      'News.is_deleted' => false,
      'News.status' => 'Approved'
    ];

		$this->paginate = [
      'fields' => ['id', 'title', 'cover_image', 'description', 'created_on'],
      'conditions' => $conditions,
      'order' => ['News.id' => 'DESC'],
			'limit' => 10
    ];
		$news = $this->paginate($this->News);
		$this->set(compact('news'));
		$this->set('activeMenu', 'News.userNews');
  }

  /**
   * View method
   *
   * @param string|null $id News id.
   * @return \Cake\Http\Response|void
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function view($id = null) {
    $news = $this->News->get($id, [
        'contain' => []
    ]);

    $this->set('news', $news);
		$this->set('activeMenu', 'News.view');
  }
	
	public function userView($id = null) {
		$user_id = $this->Auth->user('id');
    $news = $this->News->get($id, [
        'contain' => []
    ]);
		
    $this->set('news', $news);
		$this->set('activeMenu', 'News.view','user_id');
  }

  /**
   * Add method
   *
   * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
   */
  public function add() {
  	$user_id = $this->Auth->user('id');
  	$user_role 	= $this->Auth->user('role');

    $news = $this->News->newEntity();
    
    if ($this->request->is('post')) {
      $news = $this->News->patchEntity($news, $this->request->getData());
		  
		  $errors = [];
		  if ($this->request->getData('cover_image.tmp_name')) {
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

			if (empty($errors)) {
				$news->created_on = date("Y-m-d H:i:s");
				$news->created_by = $user_id; // session user_id
				
				# Saving news
				if ($this->News->save($news)) {
					$this->Flash->success(__('The news has been sant for approval.'));
					return $this->redirect(['action' => 'add']);
				}else{
					$this->Flash->error(__('The news could not be saved. Please, try again.'));
				}
			} else {
				$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
			}
    }
     
    $this->set(compact('news', 'user_role'));
		$this->set('activeMenu', 'News.add');
  }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
    	$user_id = $this->Auth->user('id');
    	$user_role 	= $this->Auth->user('role');

      $news = $this->News->get($id, [
          'contain' => []
      ]);

      $news->published_on = date("Y-m-d H:i:s");
			
			$newsDb = clone $news;

      if ($this->request->is(['patch', 'post', 'put'])) {
        $news = $this->News->patchEntity($news, $this->request->getData());
					
					if($this->request->getData('cover_image.tmp_name')) {
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
					} else {
						$news->cover_image = $newsDb->cover_image;
					}				
				
				if (empty($errors)) {
					// pr($news); exit();
					if ($this->News->save($news)) {

						if ($news->status=="Approved") {
							// Rewarding coins
							if (!$this->updateWallet($news->created_by, 10, "news_create", date("Y-m-d H:i:s"), $news->id, '')) {
								$this->Flash->success(__('Something went wrong.'));
							}
						} else {
							// Deleting coins
							$this->deleteFromWallet($news->created_by, 'news_create', $news->id);
						}
						
						$this->Flash->success(__('The news has been saved.'));
						return $this->redirect(['action' => 'index']);
					} else {
						$this->Flash->error(__('The news could not be saved. Please, try again. 111111111'));
					}
				}	else {
					$this->Flash->error(implode('<br />', $errors), ['escape' => false]);
				}
    	}

      $this->set(compact('news', 'user_role'));
			$this->set('activeMenu', 'News.edit');
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
        $this->viewBuilder()->setLayout('front-page');
		$inquiry = $this->News->Enquiries->newEntity();
		$this->set(compact('role','inquiry'));
    }

	public function savePoint()
	{
		$id = $this->request->getQuery('user_id');
		$news_id = $this->request->getQuery('news_id');
		if(!empty($id) && !empty($news_id))
		{
			$checkPoints = $this->News->Wallets->find()
			                                   ->where(['Wallets.user_id'=>$id,'Wallets.news_id'=>$news_id])->first();
											   
			if(empty($checkPoints))
			{
				
				$timeCurrent = new Time();
				$wallet = $this->News->Wallets->newEntity();
				$wallet->user_id            = $id;
				$wallet->news_id            = $news_id;
				$wallet->point              = 10;
				$wallet->transaction_date   = $timeCurrent->format('Y-m-d H:i:s');
				$this->News->Wallets->save($wallet);
			}
			
		}
	}
}
