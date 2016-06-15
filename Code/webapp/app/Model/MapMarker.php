<?php
App::uses('AppModel', 'Model');
/**
 * MapMarker Model
 *
 * @property Report $reports
 */
class MapMarker extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'reports' => array(
			'className' => 'Report',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
