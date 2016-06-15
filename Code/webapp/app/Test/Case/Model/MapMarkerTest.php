<?php
App::uses('MapMarker', 'Model');

/**
 * MapMarker Test Case
 *
 */
class MapMarkerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.map_marker',
		'app.report',
		'app.user',
		'app.role',
		'app.building_condition',
		'app.report_image'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MapMarker = ClassRegistry::init('MapMarker');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MapMarker);

		parent::tearDown();
	}

}
