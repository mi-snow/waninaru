<?php
App::uses('ProducersProject', 'Model');

/**
 * ProducersProject Test Case
 *
 */
class ProducersProjectTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.producers_project',
		'app.project',
		'app.producer',
		'app.user',
		'app.producers_projects'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProducersProject = ClassRegistry::init('ProducersProject');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProducersProject);

		parent::tearDown();
	}

}
