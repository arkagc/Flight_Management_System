<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Airports Controller
 *
 * @property \App\Model\Table\AirportsTable $Airports
 * @method \App\Model\Entity\Airport[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AirportsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $airports = $this->paginate($this->Airports, ['limit' => $this->page_limit]);

        $this->set(compact('airports'));
    }

    /**
     * View method
     *
     * @param string|null $id Airport id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $airport = $this->Airports->get($id, [
            'contain' => ['Source', 'Destination'],
        ]);

        $this->set(compact('airport'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $status = array('Y' => 'Active', 'N' => 'Inactive');
         $this->set('status',$status);

        $airport = $this->Airports->newEmptyEntity();
        if ($this->request->is('post')) {
            $airport = $this->Airports->patchEntity($airport, $this->request->getData());
            if ($this->Airports->save($airport)) {
                $this->Flash->success(__('The airport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airport could not be saved. Please, try again.'));
        }
        $this->set(compact('airport'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Airport id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $status = array('Y' => 'Active', 'N' => 'Inactive');
         $this->set('status',$status);
         
        $airport = $this->Airports->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $airport = $this->Airports->patchEntity($airport, $this->request->getData());
            if ($this->Airports->save($airport)) {
                $this->Flash->success(__('The airport has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The airport could not be saved. Please, try again.'));
        }
        $this->set(compact('airport'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Airport id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $airport = $this->Airports->get($id);
        if ($this->Airports->delete($airport)) {
            $this->Flash->success(__('The airport has been deleted.'));
        } else {
            $this->Flash->error(__('The airport could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
