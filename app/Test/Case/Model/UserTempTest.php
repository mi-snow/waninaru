<?php
App::uses('UserTemp', 'Model');

/**
 * UserTemp Test Case
 *
 */
class UserTempTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_temp'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserTemp = ClassRegistry::init('UserTemp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserTemp);

		parent::tearDown();
	}

}
