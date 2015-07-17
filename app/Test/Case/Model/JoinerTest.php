<?php
App::uses('Joiner', 'Model');

/**
 * Joiner Test Case
 *
 */
class JoinerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Joiner = ClassRegistry::init('Joiner');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Joiner);

		parent::tearDown();
	}

}
