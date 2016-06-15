<?php
/**
 * ReportFixture
 *
 */
class ReportFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'building_condition_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'electricity' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'water' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'road_block' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'telecommunication' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'comments' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'user_id' => 1,
			'building_condition_id' => 1,
			'electricity' => 1,
			'water' => 1,
			'road_block' => 1,
			'telecommunication' => 1,
			'comments' => 'Lorem ipsum dolor sit amet',
			'created' => '2016-06-11 21:07:53',
			'modified' => '2016-06-11 21:07:53'
		),
	);

}
