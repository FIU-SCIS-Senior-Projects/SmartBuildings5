<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {
    
        public $belongsTo = 'Role';
        public $MAPPER=1,$EVALUATOR=2,$ADMIN=3,$ACTIVE=1,$PENDING=2,$INACTIVE=3;
/**
 * Validation rules
 *
 * @var array
 */ 
	public $validate = array(
                'username' => array(
                    'required' => array(
                        'rule' => 'notBlank',
                        'message' => 'A username is required'
                    )
                ),
               'password' => array(
                    'length' => array(
                        'rule'      => array('between', 8, 40),
                        'message'   => 'Your password must be between 8 and 40 characters.',
                    ),
                ),
                'password_repeat' => array(
                    'length' => array(
                        'rule'      => array('between', 8, 40),
                        'message'   => 'Your password must be between 8 and 40 characters.',
                    ),
                    'compare'    => array(
                        'rule'      => array('validate_passwords'),
                        'message' => 'The passwords you entered do not match.',
                    )
                ),
		'last_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
                'role_id' => 'numeric'
	);
        
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
