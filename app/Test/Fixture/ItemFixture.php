<?php
/**
 * ItemFixture
 *
 */
class ItemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'notes' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 256, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'list_id' => array('column' => 'category_id', 'unique' => 0),
			'name' => array('column' => 'name', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'category_id' => 1,
			'notes' => 'Lorem ipsum dolor sit amet',
			'created' => '2012-12-04 20:44:00'
		),
	);

}
