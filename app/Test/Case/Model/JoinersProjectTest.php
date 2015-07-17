<?php
App::uses('JoinersProject', 'Model');

/**
 * JoinersProject Test Case
 *
 */
class JoinersProjectTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.joiners_project',
		'app.project',
		'app.joiner',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JoinersProject = ClassRegistry::init('JoinersProject');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JoinersProject);

		parent::tearDown();
	}

}
