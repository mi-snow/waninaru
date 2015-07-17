<?php
App::uses('AppModel', 'Model');
/**
 * ProducersProject Model
 *
 * @property Project $Project
 * @property Producer $Producer
 */
class ProducersProject extends AppModel {


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
		'Producer' => array(
			'className' => 'Producer',
			'foreignKey' => 'producer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
