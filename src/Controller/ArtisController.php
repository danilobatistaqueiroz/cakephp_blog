<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Artis Controller
 *
 *
 * @method \App\Model\Entity\Arti[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArtisController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $artis = $this->paginate($this->Artis);

        $this->set(compact('artis'));
    }

    /**
     * View method
     *
     * @param string|null $id Arti id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $arti = $this->Artis->get($id, [
            'contain' => []
        ]);

        $this->set('arti', $arti);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arti = $this->Artis->newEntity();
        if ($this->request->is('post')) {
            $arti = $this->Artis->patchEntity($arti, $this->request->getData());
            if ($this->Artis->save($arti)) {
                $this->Flash->success(__('The arti has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arti could not be saved. Please, try again.'));
        }
        $this->set(compact('arti'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Arti id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $arti = $this->Artis->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $arti = $this->Artis->patchEntity($arti, $this->request->getData());
            if ($this->Artis->save($arti)) {
                $this->Flash->success(__('The arti has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arti could not be saved. Please, try again.'));
        }
        $this->set(compact('arti'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Arti id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $arti = $this->Artis->get($id);
        if ($this->Artis->delete($arti)) {
            $this->Flash->success(__('The arti has been deleted.'));
        } else {
            $this->Flash->error(__('The arti could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
