<?php
App::uses('AppModel', 'Model');
// app/Model/Activity

class Activity extends AppModel {
	
	public $belongsTo = array(
		'Users' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'type' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);
}