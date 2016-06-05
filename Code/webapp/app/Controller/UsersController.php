<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');       
    
        public function beforeFilter() {
            parent::beforeFilter();
            // Allow non-auth users to register and logout.
            $this->Auth->allow('add', 'logout');
        }
       
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
                        
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-success'
                                                ));
                                
                                //attempt to login user
                                $this->login();
				
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'alert', array(
                                                        'plugin' => 'BoostCake',
                                                        'class' => 'alert-danger'
                                                ));
			}
		}
                
                //populate the role_id input in view except for admin
                $this->set('roles', $this->User->Role->find('list', array('conditions' => array('not' => array('Role.id' => 3)))));

	}

        
        public function login() {            
            
            //if already logged-in, redirect
            if($this->Auth->loggedIn()){
                return $this->redirect($this->Auth->redirectUrl());      
            }
            
            if ($this->request->is('post')) {        
                
                if ($this->Auth->login()) {
                    
                    $ACTIVE=1;$PENDING=2;$INACTIVE=3;
                    //check if acc status is pending for approval
                    if($this->Auth->user('account_status_id') == $PENDING){
                        $this->Session->setFlash(__('This account is pending for approval'), 'alert', array(
                                                                                    'plugin' => 'BoostCake',
                                                                                    'class' => 'alert-danger'
                                                                            ));
                        return $this->logout();                     
                    }else if($this->Auth->user('account_status_id') == $INACTIVE){
                        $this->Session->setFlash(__('This account is inactive'),'alert', array(
                                                                        'plugin' => 'BoostCake',
                                                                        'class' => 'alert-danger'
                                                                ));                    
                        return $this->logout();                      
                    }
                    return $this->redirect('/home');
                }
                
                $this->Session->setFlash(__('Invalid username or password, try again'), 'alert', array(
                                                                                'plugin' => 'BoostCake',
                                                                                'class' => 'alert-danger'
                                                                        ));
                    
            }
        }

        public function logout() {
            return $this->redirect($this->Auth->logout());
        }
        
        public function profile(){
            if($this->Auth->loggedIn()){
                
                if ($this->request->is(array('post', 'put'))) {
                    //save info passed from view to db 
                    
                }else{
                    //pass db info to view
                    $uid = $this->Auth->user('id');
                    $this->request->data = $this->User->findById($uid);
                    $this->set('roles', $this->User->Role->find('list'));
                }
                                
            }else{
                $this->Session->setFlash(__('Please login to view profile'), 'alert', array(
                                                                    'plugin' => 'BoostCake',
                                                                    'class' => 'alert-danger'
                                                            ));
            }
                
            
                        
        }
}
