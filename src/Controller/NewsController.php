<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 *
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        
        
        $this->Auth->allow(['index', 'add','userNews']);
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
            'fields' => ['id', 'title', 'cover_image', 'description', 'created_on'],
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
            $news->is_approved = "no";
            $news->created_on = date("Y-m-d h:i:s");
            $news->created_by = 11; // session user_id
            if ($this->News->save($news)) {
                $this->Flash->success(__('The news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news could not be saved. Please, try again.'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->getData());
            if ($this->News->save($news)) {
                $this->Flash->success(__('The news has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The news could not be saved. Please, try again.'));
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
}
