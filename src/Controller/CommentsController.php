<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
      $this->paginate = [
          'contain' => ['News', 'Users']
      ];
      $comments = $this->paginate($this->Comments->find()->where(['Comments.status'=>'Pending for approval']));

      $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['News', 'Users']
        ]);

        $this->set('comment', $comment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $news = $this->Comments->News->find('list', ['limit' => 200]);
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'news', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $news = $this->Comments->News->find('list', ['limit' => 200]);
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'news', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function approve($id = null)
    {
        $this->request->allowMethod(['post']);
        $comment = $this->Comments->get($id, [
            'contain' => ['Users','News']
        ]);
        $comment->status = "Approved";
        if ($this->Comments->save($comment)) {
          $email = new Email('default');
          $email->viewBuilder()->setTemplate('approve_comment');
          $email->setEmailFormat('html')
            ->setFrom('Info@icocheckers.com', 'icocheckers')
            ->setReplyTo($comment->user->email, 'icocheckers')
            ->setTo($comment->user->email, $comment->user->name)
            ->setSubject('Your comment has been approved.')
            ->setViewVars([
              'comment' => $comment->comment,
              'user_name'=> $comment->user->name,
              'news_id' => $comment->news_id,
              'news_title' => $comment->news->title
            ])
            ->send();

          $this->Flash->success(__('The comment has been approved.'));
        } else {
          $email = new Email('default');
          $email->viewBuilder()->setTemplate('reject_comment');
          $email->setEmailFormat('html')
            ->setFrom('Info@icocheckers.com', 'icocheckers')
            ->setReplyTo($comment->user->email, 'icocheckers')
            ->setTo($comment->user->email, $comment->user->name)
            ->setSubject('Your comment has been rejected.')
            ->setViewVars([
              'comment' => $comment->comment,
              'user_name'=> $comment->user->name,
              'news_id' => $comment->news_id,
              'news_title' => $comment->news->title
            ])
            ->send();

          $this->Flash->error(__('The comment could not be approved. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reject($id = null)
    {
        $this->request->allowMethod(['post']);
        $comment = $this->Comments->get($id, [
            'contain' => ['Users','News']
        ]);
        $comment->status = "Rejected";
        if ($this->Comments->save($comment)) {
          $email = new Email('default');
          $email->viewBuilder()->setTemplate('reject_comment');
          $email->setEmailFormat('html')
            ->setFrom('Info@icocheckers.com', 'icocheckers')
            ->setReplyTo($comment->user->email, 'icocheckers')
            ->setTo($comment->user->email, $comment->user->name)
            ->setSubject('Your comment has been rejected.')
            ->setViewVars([
              'comment' => $comment->comment,
              'user_name'=> $comment->user->name,
              'news_id' => $comment->news_id,
              'news_title' => $comment->news->title
            ])
            ->send();

          $this->Flash->success(__('The comment has been rejected.'));
        } else {
          $this->Flash->error(__('The comment could not be rejected. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
