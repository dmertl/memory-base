<?php

App::uses('AppModel', 'Model');

/**
 * Category Model
 *
 * @property Item $Item
 */
class Category extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Item'
	);

}
