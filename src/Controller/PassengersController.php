<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;

/**
 * Passengers Controller
 *
 * @method \App\Model\Entity\Passenger[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PassengersController extends AppController
{
    
    public function initialize(): void
    {
        parent::initialize();
        $this->viewBuilder()->setLayout("default");
        $this->loadModel("Passengers");
        $this->loadModel("Flights");
        $this->loadModel("Airports");
        $this->loadModel("Bookings");
    }

    //For Regitration Page, go to register.php
    public function register()
    {

      $country = array('India' => 'India', 'United State of America' => 'United State of America', 'United Kingdom' => 'United Kingdom');
         $this->set('country',$country);

      $state = array( 'Andhra Pradesh' => 'Andhra Pradesh', 
                      'Arunachal Pradesh' => 'Arunachal Pradesh', 
                      'Assam' => 'Assam', 
                      'Bihar' => 'Bihar', 
                      'Chhattisgarh' => 'Chhattisgarh', 
                      'Goa' => 'Goa', 
                      'Gujarat' => 'Gujarat', 
                      'Haryana' => 'Haryana', 
                      'Himachal Pradesh' => 'Himachal Pradesh', 
                      'Jharkhand' => 'Jharkhand', 
                      'Karnataka' => 'Karnataka', 
                      'Kerala' => 'Kerala', 
                      'Madhya Pradesh' => 'Madhya Pradesh', 
                      'Maharashtra' => 'Maharashtra', 
                      'Manipur' => 'Manipur', 
                      'Meghalaya' => 'Meghalaya', 
                      'Mizoram' => 'Mizoram', 
                      'Nagaland' => 'Nagaland', 
                      'Odisha' => 'Odisha', 
                      'Punjab' => 'Punjab', 
                      'Rajasthan' => 'Rajasthan', 
                      'Sikkim' => 'Sikkim', 
                      'Tamil Nadu' => 'Tamil Nadu', 
                      'Telangana' => 'Telangana', 
                      'Tripura' => 'Tripura', 
                      'Uttar Pradesh' => 'Uttar Pradesh', 
                      'Uttarakhand' => 'Uttarakhand', 
                      'West Bengal' => 'West Bengal', 
                      'Andaman and Nicobar Islands' => 'Andaman and Nicobar Islands', 
                      'Chandigarh' => 'Chandigarh', 
                      'Dadra and Nagar Haveli and Daman and Diu' => 'Dadra and Nagar Haveli and Daman and Diu', 
                      'Delhi' => 'Delhi', 
                      'Jammu and Kashmir' => 'Jammu and Kashmir', 
                      'Ladakh' => 'Ladakh', 
                      'Lakshadweep' => 'Lakshadweep', 
                      'Puducherry' => 'Puducherry'
                    );
        $this->set('state', $state);

      //already logged in
      if($this->Auth->user()){
           return $this->redirect(['controller' => 'Bookings', 'action' => 'booklist']);
        }
      $passenger = $this->Passengers->newEmptyEntity();
      if($this->request->is('post')){
          $store_data = $this->request->getData();
          $date = $this->request->getData('date_of_birth');
          $newDate = date("Y-m-d", strtotime($date));
          $store_data['date_of_birth'] = $newDate;

        $passenger = $this->Passengers->patchEntity($passenger, $store_data);
        if($this->Passengers->save($passenger)){
          $this->Flash->success(__('Registration successfull!'));
          return $this->redirect(['action' => 'login']);
        }
        $this->Flash->error(__('Please try again!'));
      }
      $this->set(compact('passenger'));
    }


    public function login()
    {
        //already logged in
        if($this->Auth->user()){
           return $this->redirect(['controller' => 'Bookings', 'action' => 'booklist']);
        }
        if($this->request->is("post")){            
            //validate the user from users table
            $userdata = $this->Auth->identify();
                if($userdata){
                    //store values
                    $passengerdata['passenger'] = $userdata;
                    //settings user data
                    $this->Auth->setUser($passengerdata);
                    //Remember me functionality
                    if($this->request->getData('remember_me') == 1){
                        setcookie('email_or_phone_no', $this->request->getData('email_or_phone_no'), time()+1*60*60);//using expiry in 1 hour(1*60*60 seconds or 3600 seconds)
                        setcookie('password', $this->request->getData('password'), time()+1*60*60);//using expiry in 1 hour(1*60*60 seconds or 3600 seconds)     
                    }
                  return $this->redirect($this->Auth->redirectUrl());
                }
                else{
                    $this->Flash->error('Incorrect login');
                }
            }
    }


    public function logout()
    {
        $session = $this->getRequest()->getSession();
        $passenger_session_delete = $session->delete('passenger_data');
        return $this->redirect($this->Auth->logout());
    }

    public function dashboard()
    {
        $session = $this->request->getSession(); //create session object
        $p_session_id = $session->read('Auth.User.id');
        $p_session_name = $session->read('Auth.User.name'); //read data from session(Here read passenger name)
        $session_id = $this->request->getSession()->id(); //create session id
        $login_check = $session->check('Auth.User.id'); // Check the session data
        $this->set('p_session_id', $p_session_id);
        $this->set('p_session_name', $p_session_name);
        $this->set('session_id', $session_id);
        $this->set('login_check', $login_check);

        $this->paginate = [
            'contain' => ['Flights'],
        ];
        $booking_date_to = $this->request->getQuery('booking_date_to');
        $booking_date_from = $this->request->getQuery('booking_date_from');
        $search_name_email = $this->request->getQuery('search_name_email');
        $search_status = $this->request->getQuery('search_status');
        $source_id = $this->request->getQuery('source_id');
        $destination_id = $this->request->getQuery('destination_id');

        if ($booking_date_to!='' && $booking_date_from!='') {
            $search = $this->Passengers->find('all')
                                    ->where(function($exp){
                                        return $exp->between('booking_date', $this->request->getQuery('booking_date_to'), $this->request->getQuery('booking_date_from'));
                                    });
        }
        elseif($search_name_email!=''){
            $search = $this->Passengers->find('all')->where(['Or' => ['Passengers.name like' => '%'.$this->request->getQuery('search_name_email').'%', 'Passengers.email like' => '%'.$this->request->getQuery('search_name_email').'%']]);
        }
        elseif($search_status!='') {
            $search = $this->Passengers->find('all')
                                        ->where(['Passengers.status' => $search_status]);
        }
        elseif($source_id!='' && $destination_id!=''){
          $search = $this->Passengers->find()
                        ->join([
                          'f' => [
                              'table' => 'flights',
                              'type' => 'INNER',
                              'conditions' => ['f.id = passengers.flight_id',
                                              'f.source_id ='.$source_id,
                                              'f.destination_id ='.$destination_id
                                              ]
                          ]
                        ]);
        }
        
        else{
            $search = $this->Passengers;
        }
        $passengers = $this->paginate($search);
        $airports = $this->Passengers->Airports->find('list', ['limit' => 200])
                                            ->where(['status' => 'Y']);
       $passengers_status = $this->Passengers->find('all')->select('status')->distinct('status');
        $this->set(compact('passengers', 'airports', 'passengers_status'));
    }


    public function profile($id = null){
        $passenger = $this->Passengers->get($id, [
            'contain' => ['Bookings'],
        ]);
        $this->set(compact('passenger'));
    }

    /**
     * View method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $passenger = $this->Passengers->get($id, [
            'contain' => ['Flights'],
        ]);

        $this->set(compact('passenger'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $passenger = $this->Passengers->newEmptyEntity();
        if ($this->request->is('post')) {
            $passenger = $this->Passengers->patchEntity($passenger, $this->request->getData());
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        $flights = $this->Passengers->Flights->find('list', ['limit' => 200]);
        $this->set(compact('passenger', 'flights'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = array('India' => 'India', 'United State of America' => 'United State of America', 'United Kingdom' => 'United Kingdom');
        $this->set('country',$country);

        $state = array( 'Andhra Pradesh' => 'Andhra Pradesh', 
                      'Arunachal Pradesh' => 'Arunachal Pradesh', 
                      'Assam' => 'Assam', 
                      'Bihar' => 'Bihar', 
                      'Chhattisgarh' => 'Chhattisgarh', 
                      'Goa' => 'Goa', 
                      'Gujarat' => 'Gujarat', 
                      'Haryana' => 'Haryana', 
                      'Himachal Pradesh' => 'Himachal Pradesh', 
                      'Jharkhand' => 'Jharkhand', 
                      'Karnataka' => 'Karnataka', 
                      'Kerala' => 'Kerala', 
                      'Madhya Pradesh' => 'Madhya Pradesh', 
                      'Maharashtra' => 'Maharashtra', 
                      'Manipur' => 'Manipur', 
                      'Meghalaya' => 'Meghalaya', 
                      'Mizoram' => 'Mizoram', 
                      'Nagaland' => 'Nagaland', 
                      'Odisha' => 'Odisha', 
                      'Punjab' => 'Punjab', 
                      'Rajasthan' => 'Rajasthan', 
                      'Sikkim' => 'Sikkim', 
                      'Tamil Nadu' => 'Tamil Nadu', 
                      'Telangana' => 'Telangana', 
                      'Tripura' => 'Tripura', 
                      'Uttar Pradesh' => 'Uttar Pradesh', 
                      'Uttarakhand' => 'Uttarakhand', 
                      'West Bengal' => 'West Bengal', 
                      'Andaman and Nicobar Islands' => 'Andaman and Nicobar Islands', 
                      'Chandigarh' => 'Chandigarh', 
                      'Dadra and Nagar Haveli and Daman and Diu' => 'Dadra and Nagar Haveli and Daman and Diu', 
                      'Delhi' => 'Delhi', 
                      'Jammu and Kashmir' => 'Jammu and Kashmir', 
                      'Ladakh' => 'Ladakh', 
                      'Lakshadweep' => 'Lakshadweep', 
                      'Puducherry' => 'Puducherry'
                    );
        $this->set('state', $state);

        $passenger = $this->Passengers->get($id, [
            'contain' => [],
        ]);

          $old_password = $passenger->password;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $store_data = $this->request->getData();
            $date = $this->request->getData('date_of_birth');
            $newDate = date("Y-m-d", strtotime($date));
            $store_data['date_of_birth'] = $newDate;

            if($store_data['password']=='')
                {
                    $store_data['password']=$old_password;
                }
            $passenger = $this->Passengers->patchEntity($passenger, $store_data);
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));
                return $this->redirect(['controller' => 'Passengers', 'action' => 'edit', $id]);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        $this->set(compact('passenger'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Passenger id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $passenger = $this->Passengers->get($id);
        if ($this->Passengers->delete($passenger)) {
            $this->Flash->success(__('The passenger has been deleted.'));
        } else {
            $this->Flash->error(__('The passenger could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function index()
    {
        $session = $this->request->getSession(); //create session object
        $p_session_name = $session->read('Auth.User.name'); //read data from session(Here read passenger name)
        $session_id = $this->request->getSession()->id(); //create session id
        $login_check = $session->check('Auth.User.id'); // Check the session data
        $this->set('p_session_name', $p_session_name);
        $this->set('session_id', $session_id);
        $this->set('login_check', $login_check);

        $this->paginate = [
            'contain' => ['Flights'],
        ];
        $booking_date_to = $this->request->getQuery('booking_date_to');
        $booking_date_from = $this->request->getQuery('booking_date_from');
        $search_name_email = $this->request->getQuery('search_name_email');
        $search_status = $this->request->getQuery('search_status');
        $source_id = $this->request->getQuery('source_id');
        $destination_id = $this->request->getQuery('destination_id');
        if ($booking_date_to!='' && $booking_date_from!='') {
            $search = $this->Passengers->find('all')
                                    ->where(function($exp){
                                        return $exp->between('booking_date', $this->request->getQuery('booking_date_to'), $this->request->getQuery('booking_date_from'));
                                    });
        }
        elseif($search_name_email!=''){
            $search = $this->Passengers->find('all')->where(['Or' => ['Passengers.name like' => '%'.$this->request->getQuery('search_name_email').'%', 'Passengers.email like' => '%'.$this->request->getQuery('search_name_email').'%']]);
        }
        elseif($search_status!='') {
            
            $search = $this->Passengers->find('all')
                                        ->where(['Passengers.status' => $search_status]);
        }
        elseif($source_id!='' && $destination_id!=''){
          $search = $this->Passengers->find()
                        ->join([
                          'f' => [
                              'table' => 'flights',
                              'type' => 'INNER',
                              'conditions' => ['f.id = passengers.flight_id',
                                              'f.source_id ='.$source_id,
                                              'f.destination_id ='.$destination_id
                                              ]
                          ]
                        ]);
        }
        
        else{
            $search = $this->Passengers;
        }
        $passengers = $this->paginate($search, ['limit' => $this->page_limit]);
        $airports = $this->Passengers->Airports->find('list', ['limit' => 200])
                                            ->where(['status' => 'Y']);
       $passengers_status = $this->Passengers->find('all')->select('status')->distinct('status');
        
        $this->set(compact('passengers', 'airports', 'passengers_status'));
    }
}
