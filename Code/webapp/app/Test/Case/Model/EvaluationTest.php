<?php
App::uses('Evaluation', 'Model');

/**
 * Evaluation Test Case
 *
 */
class EvaluationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.evaluation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Evaluation = ClassRegistry::init('Evaluation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Evaluation);

		parent::tearDown();
	}

}
