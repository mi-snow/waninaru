<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property User $User
 */
class Message extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $validate = array(
		'user_id' =>array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
