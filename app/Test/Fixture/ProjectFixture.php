<?php
/**
 * ProjectFixture
 *
 */
class ProjectFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'primary'),
		'project_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'active_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'recrouit_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'active_place' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'detail_text' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2048, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'image_file_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'people_maxnum' => array('type' => 'integer', 'null' => true, 'default' => null),
		'category' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'project_name' => 'Lorem ipsum dolor sit amet',
			'active_date' => '2014-07-23 05:34:36',
			'recrouit_date' => '2014-07-23 05:34:36',
			'active_place' => 'Lorem ipsum dolor sit amet',
			'detail_text' => 'Lorem ipsum dolor sit amet',
			'image_file_name' => 'Lorem ipsum dolor sit amet',
			'people_maxnum' => 1,
			'category' => 'Lorem ipsum dolor sit amet'
		),
	);

}
