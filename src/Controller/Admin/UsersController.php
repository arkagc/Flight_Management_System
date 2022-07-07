<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;
//use Cake\Auth\DefaultPasswordHasher;
// use Cake\Http\Cookie\Cookie;
// use Cake\Http\Cookie\CookieCollection;


/**
 * Users Controller
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize(): void
    {

        parent::initialize();

        $this->viewBuilder()->setLayout("default");
        $this->loadModel("Users");
    }

    public function login(){

        if($this->Auth->user()){
           return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }

        if($this->request->is("post")){

            //validate the user from users table
            $userdata = $this->Auth->identify();

                if($userdata){
                    //store values
                    $admindata['admin'] = $userdata;
                    
                    //settings user data
                    $this->Auth->setUser($admindata);

                    if($this->request->getData('remember_me') == 1){

                        setcookie('email', $this->request->getData('email'), time()+1*60*60);//using expiry in 1 hour(1*60*60 seconds or 3600 seconds)

                        setcookie('password', $this->request->getData('password'), time()+1*60*60);//using expiry in 1 hour(1*60*60 seconds or 3600 seconds)
                    }

                  return $this->redirect($this->Auth->redirectUrl());
                }
                else{

                    $this->Flash->error('Incorrect login');
                }
            }
            
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $users = $this->paginate($this->Users, ['limit' => $this->page_limit]);

        $this->set(compact('users'));
    }


    public function logout(){

        $session = $this->getRequest()->getSession();
        $admin_session_delete = $session->delete('admin_data');

        return $this->redirect($this->Auth->logout());
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

         $old_password = $user->password;
        if ($this->request->is(['patch', 'post', 'put'])) {

            $value = $this->request->getData();

            if($value['password']=='')
                {
                    $value['password']=$old_password;
                }

            $user = $this->Users->patchEntity($user, $value);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
