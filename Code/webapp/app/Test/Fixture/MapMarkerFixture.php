<?php
/**
 * MapMarkerFixture
 *
 */
class MapMarkerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'latitude' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6'),
		'longitude' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'latitude' => 1,
			'longitude' => 1
		),
	);

}
