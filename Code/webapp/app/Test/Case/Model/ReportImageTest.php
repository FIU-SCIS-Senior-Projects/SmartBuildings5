<?php
App::uses('ReportImage', 'Model');

/**
 * ReportImage Test Case
 *
 */
class ReportImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.report_image',
		'app.report',
		'app.user',
		'app.role',
		'app.building_condition'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ReportImage = ClassRegistry::init('ReportImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ReportImage);

		parent::tearDown();
	}

}
