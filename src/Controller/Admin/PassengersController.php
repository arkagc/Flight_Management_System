<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

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
        $this->loadModel("Bookings");
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [

            'contain' => [],
        ];

        $search_data = '';
        $search_name_email_phone_no = $this->request->getData('search_name_email_phone_no');

        //Storing source and destination data in session
        $session = $this->getRequest()->getSession();

        //store source data in a session using POST value
        if($search_name_email_phone_no!=''){
            $session->write([
                'data' => $search_name_email_phone_no
            ]);
            $search_data = $session->read('data');
        }
        else{
            if($session->check('data')){
                // Final value of source in session
                $search_data = $session->read('data');    
            }
        }

        if($search_data!=''){
          $search = $this->Passengers->find('all')->where(['Or' => ['Passengers.name like' => '%'.        $this->request->getData('search_name_email_phone_no').'%', 'Passengers.email like' => '%'.$this->request->getData('search_name_email_phone_no').'%', 'Passengers.phone_no like' => '%'.$this->request->getData('search_name_email_phone_no').'%']]);
        }
        else{
          $search = $this->Passengers;
        }
     
        $passengers = $this->paginate($search, ['limit' => $this->page_limit]);

        $this->set(compact('passengers'));
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
            'contain' => [],
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
        $this->set('state',$state);

        $status = array('Active' => 'Active', 'Inactive' => 'Inactive');
        
        $this->set('status',$status);

        $passenger = $this->Passengers->newEmptyEntity();
        if ($this->request->is('post')) {
            $store_data = $this->request->getData();

            $date = $this->request->getData('date_of_birth');

            $newDate = date("Y-m-d", strtotime($date));

            $store_data['date_of_birth'] = $newDate;

            $passenger = $this->Passengers->patchEntity($passenger, $store_data);
            if ($this->Passengers->save($passenger)) {
                $this->Flash->success(__('The passenger has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The passenger could not be saved. Please, try again.'));
        }
        
        $this->set(compact('passenger'));
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

        $status = array('Active' => 'Active', 'Inactive' => 'Inactive');
        
        $this->set('status',$status);

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

                return $this->redirect(['action' => 'index']);
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

        $passenger_id = $passenger['id'];

        $query_bookings = $this->Bookings->find('all')->where(['Bookings.passenger_id' => $passenger_id]);

        if(isset($query_bookings) && !empty($query_bookings)){

          if($this->Passengers->delete($passenger)){
          
            if($this->Bookings->deleteAll([       
                  'Bookings.passenger_id'=>$passenger_id
                  ])){
              $this->Flash->success(__('The passenger and bookings has been deleted.'));
            }
            $this->Flash->success(__('The passenger has been deleted. No booking info available'));
          }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function reset(){
        $session = $this->getRequest()->getSession();
        $session->delete('data');
        return $this->redirect(['action' => 'index']);
    }

}
