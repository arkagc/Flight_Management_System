<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{


    public $page_limit = 2; // Page limit for every list pages
    public $date_style = 'd-m-Y'; //Date format
    public $time_style1 = 'h:i A'; //Time format hr:min AM/PM
    public $time_style2 = 'h:i:s'; // Time format hr:min:sec
    public $date_time_style = 'd-m-Y h:i A'; // Date and Time both 

    public function beforeRender(EventInterface $event)
    {
        $this->set('date_style', $this->date_style);
        $this->set('time_style1', $this->time_style1);
        $this->set('time_style2', $this->time_style2);
        $this->set('date_time_style', $this->date_time_style);
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

    }
    
    public function beforeFilter(EventInterface $event)
    {
        //Seperate Login for Admin and Passengers
        if($this->request->getParam('prefix') &&  $this->request->getParam('prefix')=='Admin'){
            
            //For Admin
            //load Auth component
            $this->loadComponent('Auth',[
                "authenticate" => [
                    "Form" => [
                        "fields" => [
                            "username" => "email",
                            "password" => "password"
                        ],
                        "userModel" => "Users"
                    ]  
                ],
                "loginAction" => [  //  /admin/users/login
                    "controller" => "Users",
                    "action" => "login",
                    "prefix" =>"Admin"
                ],
                "loginRedirect" => [  //    /admin/users/index
                    "controller" => "Users",
                    "action" => "index",
                    "prefix" => "Admin"
                ],
                "logoutRedirect" => [   //  /admin/users/login
                    "controller" => "Users",
                    "action" => "login",
                    "prefix" => "Admin"
                ]
                ]); 
                if ($this->Auth->user() && !isset($this->Auth->user()['admin'])) {
                    return $this->redirect(['controller' => 'Passengers', 'action' => 'login', 'prefix' => false, 'Admin' => false]);
                    exit;
                }
            
        }
        else{
            //For Passengers
            //load Auth component
            $this->loadComponent('Auth',[
                "authenticate" => [
                    "Form" => [
                        "fields" => [
                            "username" => "email_or_phone_no",
                            "password" => "password"
                        ],
                        "finder" => "auth",
                        "userModel" => "Passengers"
                    ]  
                ],
                "loginAction" => [  //  /passengers/login
                    "controller" => "Passengers",
                    "action" => "login"
                ],
                "loginRedirect" => [  //    /bookings/booklist
                    "controller" => "Bookings",
                    "action" => "booklist"
                ],
                "logoutRedirect" => [   //  /passengers/login

                    "controller" => "Passengers",
                    "action" => "login"
                ]
                ]); 
                $this->Auth->allow(['register']);
                $this->Auth->allow(['controller' => 'Flights', 'action' => 'index', 'view', 'reset']);
                if ($this->Auth->user() && !isset($this->Auth->user()['passenger'])) {
                    return $this->redirect(['controller' => 'Users', 'action' => 'login', 'prefix' => 'Admin', 'Admin' => true]);
                    exit;
                }
            }
    }
}
