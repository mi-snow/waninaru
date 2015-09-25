<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property User $User
 */
class DirectMessage extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
		'producer_id' =>array(
	     'notEmpty'=>array(
			'rule' => array('notEmpty'),
			'message' => '選択してください',
	      ),
		),
		'joiner_id' =>array(
	     'notEmpty'=>array(
			'rule' => array('notEmpty'),
			'message' => '選択してください',
	      ),
		),
		'category' =>array(
	     'notEmpty'=>array(
			'rule' => array('notEmpty'),
			'message' => '選択してください',
	      ),
		),
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
	 
		'Producer' => array(
			'className' => 'Producer',
			'foreignKey' => 'producer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Joiner' => array(
			'className' => 'Joiner',
			'foreignKey' => 'joiner_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
		)

	);
	
}
