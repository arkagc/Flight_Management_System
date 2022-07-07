<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Event\EventInterface;

/**
 * Flights Controller
 *
 * @property \App\Model\Table\FlightsTable $Flights
 * @method \App\Model\Entity\Flight[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FlightsController extends AppController
{

    public function initialize(): void
    {

        parent::initialize();

        $this->loadModel("Airports"); //load Colleges table here
        $this->loadModel("Flights"); //load Branches table here
    }

    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {   
        if(!empty($this->Auth->user()['passenger'])){
            $session = $this->getRequest()->getSession(); //create session object
            $session->write([
                'p_data' => $this->Auth->user()['passenger']
            ]);
            $p_session_id = $session->read('p_data');
            $p_id = $p_session_id['id']; 
            $this->set(compact('p_id'));
        }
        $this->paginate = [
            'contain' => ['Source', 'Destination'],
        ];
        //Set two variable as a blank value
        $source_session_data='';
        $destination_session_data='';

        //Taking value by POST
        $source_id = $this->request->getData('source_id');
        $destination_id = $this->request->getData('destination_id');
        
        //Storing source and destination data in session
        $session = $this->getRequest()->getSession();

        //store source data in a session using POST value
        if($source_id!=''){
            $session->write([
                'source_data' => $source_id
            ]);
            $source_session_data = $session->read('source_data');
        }
        else{
            if($session->check('source_data')){
                // Final value of source in session
                $source_session_data = $session->read('source_data');    
            }
        }
        
        //store destination data in a session using POST value
        if($destination_id!=''){
             $session->write([
                'destination_data' => $destination_id
            ]);
            $destination_session_data = $session->read('destination_data');  
        }
        else{
            if($session->check('destination_data')){
                // Final value of destination in session
                $destination_session_data = $session->read('destination_data');    
            }
        }

        $this->set(compact('source_session_data', 'destination_session_data'));

        if($source_session_data!='' && $destination_session_data!=''){

            $flights_search = $this->Flights->find('all')
                                            ->where(['And' => ['source_id'=>$source_session_data, 'destination_id' => $destination_session_data, 'Flights.status' => 'Y']]);
        }
        elseif($source_session_data!=''){
            $flights_search = $this->Flights->find('all')->where(['And' => ['source_id' => $source_session_data, 'Flights.status' => 'Y']]);
        }
        elseif($destination_session_data!=''){
            $flights_search = $this->Flights->find('all')->where(['And' => ['destination_id' => $destination_session_data, 'Flights.status' => 'Y']]);
        }
        else{

            $flights_search = $this->Flights->find('all')->where(['Flights.status' => 'Y']);
        }        

        $flights = $this->paginate($flights_search, ['limit' => $this->page_limit]);
        $airports = $this->Flights->Airports->find('list', ['limit' => 200])
                                            ->where(['status' => 'Y']);
        $this->set(compact('flights','airports'));
    }

    /**
     * View method
     *
     * @param string|null $id Flight id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $flight = $this->Flights->get($id, [
            'contain' => ['Source', 'Destination'],
        ]);
        $this->set(compact('flight'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $flight = $this->Flights->newEmptyEntity();
        if ($this->request->is('post')) {
            $flight = $this->Flights->patchEntity($flight, $this->request->getData());
            if ($this->Flights->save($flight)) {
                $this->Flash->success(__('The flight has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flight could not be saved. Please, try again.'));
        }
        $airports = $this->Flights->Airports->find('list', ['limit' => 200])
                                            ->where(['status' => 'Y']);
        $this->set(compact('flight', 'airports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Flight id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $flight = $this->Flights->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $flight = $this->Flights->patchEntity($flight, $this->request->getData());
            if ($this->Flights->save($flight)) {
                $this->Flash->success(__('The flight has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The flight could not be saved. Please, try again.'));
        }
        $airports = $this->Flights->Airports->find('list', ['limit' => 200])
                                                ->where(['status' => 'Y']);
        $this->set(compact('flight', 'airports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Flight id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $flight = $this->Flights->get($id);
        if ($this->Flights->delete($flight)) {
            $this->Flash->success(__('The flight has been deleted.'));
        } else {
            $this->Flash->error(__('The flight could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function reset(){
        $session = $this->getRequest()->getSession();
        $session->delete('source_data');
        $session->delete('destination_data');
        return $this->redirect(['action' => 'index']);
    }
}
