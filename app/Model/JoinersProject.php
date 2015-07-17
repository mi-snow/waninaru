<?php
App::uses('AppModel', 'Model');
/**
 * JoinersProject Model
 *
 * @property Project $Project
 * @property Joiner $Joiner
 */
class JoinersProject extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
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
		)
	);
}
