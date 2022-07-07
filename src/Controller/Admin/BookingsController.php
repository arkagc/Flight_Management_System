<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
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

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Passengers', 'Flights'],
        ];

        //Set two variable as a blank value
        $source_session_data='';
        $destination_session_data='';

        $booking_to_session_data='';
        $booking_from_session_data='';

        $status_session_data='';

       //Taking value by POST
        $source_id = $this->request->getData('source_id');
        $destination_id = $this->request->getData('destination_id');

        $booking_date_to = $this->request->getData('booking_date_to');
        $booking_date_from = $this->request->getData('booking_date_from');

        $search_status = $this->request->getData('search_status');

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

        ////store destination data in a session using POST value
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

        //booking to
        if($booking_date_to!=''){
            $session->write([
                'booking_to_data' => $booking_date_to
            ]);
            $booking_to_session_data = $session->read('booking_to_data');


        }
        else{
            if($session->check('booking_to_data')){
                // Final value of destination in session
                $booking_to_session_data = $session->read('booking_to_data');    
            }
        }

        //booking date from
        if($booking_date_from!=''){
            $session->write([
                'booking_from_data' => $booking_date_from
            ]);
            $booking_from_session_data = $session->read('booking_from_data');
        }
        else{
            if($session->check('booking_from_data')){
                // Final value of destination in session
                $booking_from_session_data = $session->read('booking_from_data');    
            }
        }

        if($search_status!=''){
            $session->write([
                'booking_status_data' => $search_status
            ]);
            $status_session_data = $session->read('booking_status_data');
        }
        else{
            if($session->check('booking_status_data')){
                $status_session_data = $session->read('booking_status_data');
            }
        }

        $this->set(compact('source_session_data', 'destination_session_data', 'booking_to_session_data','booking_from_session_data','status_session_data'));

        //Query form fetch data using source and destination
        if($source_session_data!='' && $destination_session_data!=''){

          $search = $this->Bookings->find()
                        ->join([

                          'f' => [

                              'table' => 'flights',
                              'type' => 'INNER',
                              'conditions' => ['f.id = bookings.flight_id',
                                              'f.source_id ='.$source_session_data,
                                              'f.destination_id ='.$destination_session_data
                                              ]
                          ]
                        ]);
        }
        elseif($source_session_data!=''){
            $search = $this->Bookings->find()
                        ->join([

                          'f' => [

                              'table' => 'flights',
                              'type' => 'INNER',
                              'conditions' => ['f.id = bookings.flight_id',
                                              'f.source_id ='.$source_session_data
                                              ]
                          ]
                        ]);
        }
        elseif($destination_session_data!=''){
            $search = $this->Bookings->find()
                        ->join([

                          'f' => [

                              'table' => 'flights',
                              'type' => 'INNER',
                              'conditions' => ['f.id = bookings.flight_id',
                                              'f.destination_id ='.$destination_session_data
                                              ]
                          ]
                        ]);
        }
        elseif($booking_to_session_data!='' && $booking_from_session_data!=''){
            $search = $this->Bookings->find()
                            ->where([
                                'booking_date BETWEEN :start AND :end'
                            ])
                            ->bind(':start', $booking_to_session_data)
                            ->bind(':end', $booking_from_session_data);  
        }
        elseif($status_session_data!=''){
            $search = $this->Bookings->find('all')
                                     ->where(['Bookings.status' => $status_session_data]);
        }
        else{

            $search = $this->Bookings;
        }
        $bookings = $this->paginate($search, ['limit' => $this->page_limit]);

        $airports = $this->Bookings->Airports->find('list', ['limit' => 200])
                                            ->where(['status' => 'Y']);

        $this->set(compact('bookings','airports'));
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
        $booking = $this->Bookings->get($id, [
            'contain' => ['Passengers', 'Flights'],
        ]);

        $this->set(compact('booking'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $status = array('Booked' => 'Booked', 'Cancelled' => 'Cancelled', 'Waiting' => 'Waiting');
         $this->set('status',$status);

        $booking = $this->Bookings->newEmptyEntity();
        if ($this->request->is('post')) {
            //Check flight seats
            $flight_id = $this->request->getData('flight_id');
            $query_booking_list = $this->Bookings->find('all')
                                                ->where(['flight_id' => $flight_id]);
            $query_total_booking = $query_booking_list->count();                                         
            $query_total_seat = $this->Flights->find('all')
                                         ->select(['total_seat'])
                                         ->where(['Flights.id' => $flight_id])
                                         ->toList();

            $query_total_seat_no = $query_total_seat[0]['total_seat'];

            if($query_total_booking < $query_total_seat_no){

                //Change Date format
                $store_data = $this->request->getData();
                $date = $this->request->getData('deperture_date');
                $newDate = date("Y-m-d", strtotime($date));
                $store_data['deperture_date'] = $newDate;

                 $booking = $this->Bookings->patchEntity($booking, $store_data);
                if ($this->Bookings->save($booking)) {
                    $this->Flash->success(__('The booking has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }

                $this->Flash->error(__('The booking could not be saved. Please, try again.'));
            }
            else{
                $this->Flash->error(__('Seat full. Please, try again.'));
            }                                    
        }

        $airports = $this->Bookings->Airports->find('list', ['limit' => 200])
                                             ->where(['status' => 'Y']);

        $passengers = $this->Bookings->Passengers->find('list', ['limit' => 200])
                                                 ->where(['status' => 'Active']);

        $this->set(compact( 'booking', 'airports','passengers'));
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
        $status = array('Booked' => 'Booked', 'Cancelled' => 'Cancelled', 'Waiting' => 'Waiting');
         $this->set('status',$status);

        $booking = $this->Bookings->get($id, [
            'contain' => [],
        ]);

        $booking_id = $booking['id'];
        $booking_flight_id = $booking['flight_id'];
        $booking_passenger_id = $booking['passenger_id'];
        
        if ($this->request->is(['patch', 'post', 'put'])) {

            $store_data = $this->request->getData();

            $date = $this->request->getData('deperture_date');

            $newDate = date("Y-m-d", strtotime($date));

            $store_data['deperture_date'] = $newDate;


            $booking = $this->Bookings->patchEntity($booking, $store_data);
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }

        $airports = $this->Bookings->Airports->find('list', ['limit' => 200])
                                             ->where(['status' => 'Y']);

        $flights = $this->Bookings->Flights->find('list', ['limit' => 200])
                                           ->where(['Flights.id' => $booking_flight_id]);

        $passengers = $this->Bookings->Passengers->find('list', ['limit' => 200])
                                                  ->where(['Passengers.id' => $booking_passenger_id]);
      
        $this->set(compact('booking', 'airports', 'flights', 'passengers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function changedropdown()
    {
        $this->request->allowMethod('ajax');
        $this->autoRender = false;
        $source_id=$this->request->getData('source_id');
        $destination_id=$this->request->getData('destination_id');
        //exit($source_id);
        $flights=$this->Bookings->Flights->find('list')->select(['id'])
                                  ->where(['And'=>['source_id'=>$source_id,'destination_id'=>$destination_id]]);
        $this->set(compact('flights')); 
        $this->set('_serialize', ['flights']);                           
       
        echo json_encode($flights);

    }

    public function reset(){
        
        $session = $this->getRequest()->getSession();
        $session->delete('source_data');
        $session->delete('destination_data');
        $session->delete('booking_to_data');
        $session->delete('booking_from_data');
        $session->delete('booking_status_data');
        return $this->redirect(['action' => 'index']);
    }

    public function pbooklist($id = null){
      
      $passenger_id = $id;

      $this->paginate = [

            'contain' => ['Flights'],
        ];

      $passenger_details = $this->Passengers->find('all')->where(['Passengers.id' => $id])->toList();
      $passenger_name = $passenger_details[0]['name'];

      $search = $this->Bookings->find('all')->where(['Bookings.passenger_id' => $id]);

      $bookings = $this->paginate($search, ['limit' => $this->page_limit]);

      $this->set(compact('bookings','passenger_name'));
    }
}
