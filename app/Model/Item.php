<?php

App::uses('AppModel', 'Model');

/**
 * Item Model
 *
 * @property Category $Category
 * @property Tag $Tag
 */
class Item extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Category'
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Tag'
	);

}
