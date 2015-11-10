<?php
App::uses('AppModel', 'Model');
//App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 * @property Comment $Comment
 * @property Joiner $Joiner
 * @property Producer $Producer
 */
class User extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */ //バリデーション　入力の形式を決める　形式に合わないとエラー
	public $validate = array(
		'student_number' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
			'numeric' => array(
				'rule' => array('numeric'),
			),
			'decimal'=>array(
				'rule'=>array('decimal'),
				'message' => '学籍番号は数字のみで入力してください。',
				''
			),
			'minLength'=>array(
				'rule'=>array('minLength',5),
			),
			'maxLength'=>array(
				'rule'=>array('maxLength',7),
			),
			'isUnique'=>array(
				'rule'=>array('isUnique'),
				'message'=>'その学籍番号はすでに登録されています。',
				'on'=>'create'
			),
		),
		'real_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'user_password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		/*	'between'=>array(
				'rule'=>array('between',5,17),
				'message'=>'６文字以上16文字以下で入力してください。',
		*/	'minLength'=>array(
				'rule'=>array('minLength',6),
				'message'=>'６文字以上で入力してください。',	
				'required'=>'false',
				'on'=>'create'
		/*	),'maxLength'=>array(
				'rule'=>array('maxLength',17),
				'message'=>'16文字以下で入力してください。',	
				'required'=>'false',
				'on'=>'create'*/
			),		
			'alphaNumeric'=>array(
				'rule'=>array('alphaNumeric'),
				'message' => 'パスワードは半角英数字で入力してください。',		
			),
			
		),
		'new_password'=> array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		/*	'between'=>array(
				'rule'=>array('between',5,17),
				'message'=>'６文字以上16文字以下で入力してください。',
		*/	'minLength'=>array(
				'rule'=>array('minLength',6),
				'message'=>'６文字以上で入力してください。',	
				'required'=>'false',
			//	'on'=>'create'　//レコード作成時のみならcreate、更新時のみならupdate
		/*	),'maxLength'=>array(
				'rule'=>array('maxLength',17),
				'message'=>'16文字以下で入力してください。',	
				'required'=>'false',
				'on'=>'create'*/
			),		
			'alphaNumeric'=>array(
				'rule'=>array('alphaNumeric'),
				'message' => 'パスワードは半角英数字で入力してください。',		
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Joiner' => array(
			'className' => 'Joiner',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Producer' => array(
			'className' => 'Producer',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	public function beforeSave($options = array()){
		//$this->data[$this->alias]['user_password'] = AuthComponent::password($this->data[$this->alias]['user_password']);
		if(!$this->id){
			//$this->data['User']['user_password'] = AuthComponent::password($this->data['User']['user_password']);
//			$passwordHasher = new SimplePasswordHasher();
//			$this->data['User']['user_password'] = $passwordHasher->hash($this->data['User']['user_password']);
//			$this->data[$this->alias]['user_password'] = $passwordHasher->hash($this->data[$this->alias]['user_password']);
		}
		return true;
	}
}