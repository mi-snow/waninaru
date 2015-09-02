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
			'role' => 'notEmpty'
		),
		'joiner_id' =>array(
			'role' => 'notEmpty'
		),
		'category' => array(
			'role' => 'notEmpty'
		)
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

	);
	
}
