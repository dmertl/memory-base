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

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Item'
	);
}
