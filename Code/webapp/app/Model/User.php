<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

App::uses('Validation', 'Utility');

/**
 * User Model
 *
 */
class User extends AppModel {
    
        public $belongsTo = 'Role';
/**
 * Validation rules
 *
 * @var array
 */ 
	public $validate = array(
               'password' => array(
                    'length' => array(
                        'rule'      => array('minLength', 8),
                        'message'   => 'Your password must be at least 8 characters.',
                    ),
                ),
                'password_repeat' => array(
                    'length' => array(
                        'rule'      => array('minLength', 8),
                        'message'   => 'Your password must be at least 8 characters.',
                    ),
                    'compare'    => array(
                        'rule'      => array('validate_passwords'),
                        'message' => 'The passwords you entered do not match.',
                    )
                ),
		'last_name' => array(
                            'rule' => 'notEmpty',
                            'message' => 'A last name is required',
		),
		'first_name' => array(
			'rule' => 'notEmpty',
                        'message' => 'A first name is required',
		),
                'email' => array(
                    'email' => array(
                        'rule'    => array('email'),
                        'message' => 'Please enter a valid email address.'
                    ),
                    'isUnique' => array(
                        'rule'    => 'isUnique',
                        'message' => 'This email has already been taken.'
                    )
                ), 
            
                'role_id' => 'numeric',            
                
	);
        
        public function beforeValidate($options = array()) {
            $MAPPER=1;$EVALUATOR=2;
            $role_id = $this->data[$this->alias]['role_id'];
            if($role_id == $MAPPER){
                 $this->validator()
                         ->add('company', 'required', array(
                                'rule' => array('check_role'),
                                'allowEmpty' => true,
                              ))
                         ->add('position', 'required', array(
                                'rule' => array('check_role'),
                                'allowEmpty' => true,
                              ))
                         ->add('company_url', 'required', array(
                                'rule' => array('check_role'),
                                'allowEmpty' => true,
                              ))
                         ->add('company_url','val_url',array(
                                'rule' => array('url', true), 
                                'message' => 'Please enter a valid URL'
                              ));  
            }else if($role_id == $EVALUATOR){
                $this->validator()
                         ->add('company', 'required', array(
                                'rule' => 'notEmpty',
                                'message' => 'A company is required',
                              ))
                        ->add('position', 'required', array(
                                'rule' => 'notEmpty',
                                'message' => 'A position is required',
                              ))
                        ->add('company_url', 'required', array(
                                'rule' => 'notEmpty',
                                'message' => 'A company is required',
                                
                              ))
                        ->add('company_url','val_url',array(
                                'rule' => array('url', true), 
                                'message' => 'Please enter a valid URL'
                              ));                
            }
        }


        public function check_role()
        {
            $MAPPER=1;
            return $this->data[$this->alias]['role_id'] == $MAPPER;
        }
        
        public function validate_passwords() {
            return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_repeat'];
        }
        
        
        public function beforeSave($options = array()) {
            
            //hash password
            if (isset($this->data[$this->alias]['password'])) {
                $passwordHasher = new BlowfishPasswordHasher();
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
                );
            }
            
            //assign account status
            $MAPPER=1;$EVALUATOR=2;$ADMIN=3;$ACTIVE=1;$PENDING=2;$INACTIVE=3;
            if (isset($this->data[$this->alias]['role_id'])) {
               $chosen_role = $this->data[$this->alias]['role_id'];
               
                if($chosen_role == $MAPPER){
                    $this->data[$this->alias]['account_status_id'] = $ACTIVE;
                }
                else if($chosen_role == $EVALUATOR){
                    $this->data[$this->alias]['account_status_id'] = $PENDING;
                }
                
                
            }
            
            
            return true;
        }
}
