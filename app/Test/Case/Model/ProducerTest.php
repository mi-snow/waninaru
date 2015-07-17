<?php
App::uses('Producer', 'Model');

/**
 * Producer Test Case
 *
 */
class ProducerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Producer = ClassRegistry::init('Producer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Producer);

		parent::tearDown();
	}

}
