<?php
App::uses('BuildingCondition', 'Model');

/**
 * BuildingCondition Test Case
 *
 */
class BuildingConditionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.building_condition',
		'app.report',
		'app.user',
		'app.role',
		'app.report_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BuildingCondition = ClassRegistry::init('BuildingCondition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BuildingCondition);

		parent::tearDown();
	}

}
