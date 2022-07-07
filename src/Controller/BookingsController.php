<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bookings Controller
 *
 * @method \App\Model\Entity\Booking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout("default");
        $this->loadModel("Passengers");
        $this->loadModel("Flights");
        $this->loadModel("Airports");
    }

    public function booklist()
    {
        $session = $this->getRequest()->getSession(); //create session object
        $session->write([
                         'p_data' => $this->Auth->user()['passenger']
                    ]);
        $p_session_id = $session->read('p_data');
        $p_id = $p_session_id['id'];
        $p_name = $p_session_id['name'];

        $this->paginate = [
            'contain' => ['Flights', 'Passengers'],
        ];
        $p_booking = $this->Bookings->find('all')->where(['passenger_id' => $p_id]);
        $bookings = $this->paginate($p_booking, ['limit' => $this->page_limit]);
        $this->set(compact('bookings', 'p_id', 'p_name'));
    }

    /**
     * View method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $session = $this->getRequest()->getSession(); //create session object
        $session->write([
                         'p_data' => $this->Auth->user()['passenger']
                    ]);
        $p_session_id = $session->read('p_data');
        $p_id = $p_session_id['id'];
        $booking = $this->Bookings->get($id, [
            'contain' => ['Flights'],
        ]);
        $this->set(compact('booking', 'p_id'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $session = $this->getRequest()->getSession(); //create session object
        $session->write([
                         'p_data' => $this->Auth->user()['passenger']
                    ]);
        $p_session_id = $session->read('p_data');
        $p_id = $p_session_id['id'];
        $booking = $this->Bookings->newEmptyEntity();
        if ($this->request->is('post')) {
            $store_data = $this->request->getData();
            $date = $this->request->getData('deperture_date');
            $newDate = date("Y-m-d", strtotime($date));
            $store_data['deperture_date'] = $newDate;
            $booking = $this->Bookings->patchEntity($booking, $store_data);
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'booklist']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $airports = $this->Bookings->Airports->find('list', ['limit' => 200])
                                             ->where(['status' => 'Y']);
        $this->set(compact('booking', 'airports', 'p_id'));
    }

    public function fbookadd($id = null)
    {
        $session = $this->getRequest()->getSession(); //create session object
        $session->write([
                         'p_data' => $this->Auth->user()['passenger']
                    ]);
        $p_session_id = $session->read('p_data');
        $p_id = $p_session_id['id'];
        $flight = $this->Flights->get($id, [
            'contain' => ['Source', 'Destination'],
        ]);
        $flight_source_name = $flight->source->name;
        $flight_destination_name = $flight->destination->name;
        $flight_id = $flight['id'];
        $booking = $this->Bookings->newEmptyEntity();
        if ($this->request->is('post')) {
            $store_data = $this->request->getData();
            $date = $this->request->getData('deperture_date');
            $newDate = date("Y-m-d", strtotime($date));
            $store_data['deperture_date'] = $newDate;
            $booking = $this->Bookings->patchEntity($booking, $store_data);
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'booklist']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('p_id', 'flight', 'flight_source_name', 'flight_destination_name', 'flight_id','booking'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->getRequest()->getSession(); //create session object
        $session->write([
                         'p_data' => $this->Auth->user()['passenger']
                    ]);
        $p_session_id = $session->read('p_data');
        $p_id = $p_session_id['id'];
        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);
        $booking_id = $booking['id'];
        $booking_flight_id = $booking['flight_id'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $store_data = $this->request->getData();
            $date = $this->request->getData('deperture_date');
            $newDate = date("Y-m-d", strtotime($date));
            $store_data['deperture_date'] = $newDate;
            $booking = $this->Bookings->patchEntity($booking, $store_data);
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'booklist']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $airports = $this->Bookings->Airports->find('list', ['limit' => 200])
                                             ->where(['status' => 'Y']);         
        $flights = $this->Bookings->Flights->find('list', ['limit' => 200])
                                           ->where(['Flights.id' => $booking_flight_id]);
        $this->set(compact('booking','airports','flights','p_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cancel($id = null)
    {
        $status = array('Cancelled' => 'Cancelled');
         $this->set('status',$status);
        $session = $this->getRequest()->getSession(); //create session object
        $session->write([
                         'p_data' => $this->Auth->user()['passenger']
                    ]);
        $p_session_id = $session->read('p_data');
        $p_id = $p_session_id['id'];
        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));
                return $this->redirect(['action' => 'booklist']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('booking', 'p_id'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'booklist']);
    }

    public function changedropdown()
    {
        $this->request->allowMethod('ajax');
        $this->autoRender = false;
        $source_id=$this->request->getData('source_id');
        $destination_id=$this->request->getData('destination_id');
        $flights=$this->Bookings->Flights->find('list')->select(['id'])
                                  ->where(['And'=>['source_id'=>$source_id,'destination_id'=>$destination_id]]);
        $this->set(compact('flights')); 
        $this->set('_serialize', ['flights']);
        echo json_encode($flights);

    }
}
