<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 <?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 * @property Comment $Comment
 * @property JoinersProject $JoinersProject
 * @property ProducersProject $ProducersProject
 */
class Project extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'project_name' => array(
			'maxlength' => array(
				'rule' => array('maxlength',64),
				'message' => '文字数がオーバーしています。64文字以内で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '必須項目です。64文字以内で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		/*	'isUnique'=>array(
			'rule'=>array('isUnique'),
			//'message'=>'その企画はすでに登録されています。',
		   // 'on'=>'create'
	     	),*/
		),
		
		'active_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '開催日を選択してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'date' => array(
					'rule' => array('comparisonDate', 'greaterorequal'),
					'message' => '今以降の日付を選択してください。',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'recrouit_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '締め切り日を選択してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		
	
			'date' => array(
					'rule' => array('comparisonDate2', 'greaterorequal'),
			
			                 
					'message' => '今以降かつ開催日以前の日付を選択してください。',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'active_place' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '場所を入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'detail_text' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '企画内容を入力してください。',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'people_maxnum' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '募集人数を入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'naturalNumber' => array(
				'rule' => array('naturalNumber', false),
				'message' => '募集人数は1以上の整数値で入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		
/*		'category' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
		
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
			'foreignKey' => 'project_id',
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
		'JoinersProject' => array(
			'className' => 'JoinersProject',
			'foreignKey' => 'project_id',
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
		'ProducersProject' => array(
			'className' => 'ProducersProject',
			'foreignKey' => 'project_id',
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
		'DirectMessage' => array(
			'className' => 'DirectMessage',
			'foreignKey' => 'project_id',
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

}
