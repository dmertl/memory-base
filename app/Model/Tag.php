<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Item $Item
 */
class Tag extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'tag';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
