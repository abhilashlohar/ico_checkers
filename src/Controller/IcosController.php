<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Icos Controller
 *
 * @property \App\Model\Table\IcosTable $Icos
 *
 * @method \App\Model\Entity\Ico[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IcosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $icos = $this->paginate($this->Icos);

        $this->set(compact('icos'));
    }

    /**
     * View method
     *
     * @param string|null $id Ico id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ico = $this->Icos->get($id, [
            'contain' => []
        ]);

        $this->set('ico', $ico);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ico = $this->Icos->newEntity();
        if ($this->request->is('post')) {
            $ico = $this->Icos->patchEntity($ico, $this->request->getData());
            $ico->applied_on = date('Y-m-d h:i:s');
            if ($this->Icos->save($ico)) {
                $this->Flash->success(__('The ico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ico could not be saved. Please, try again.'));
        }
        $this->set(compact('ico'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ico id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ico = $this->Icos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ico = $this->Icos->patchEntity($ico, $this->request->getData());
            if ($this->Icos->save($ico)) {
                $this->Flash->success(__('The ico has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ico could not be saved. Please, try again.'));
        }
        $this->set(compact('ico'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ico id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ico = $this->Icos->get($id);
        if ($this->Icos->delete($ico)) {
            $this->Flash->success(__('The ico has been deleted.'));
        } else {
            $this->Flash->error(__('The ico could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
