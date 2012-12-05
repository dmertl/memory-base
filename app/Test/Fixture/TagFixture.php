<?php
/**
 * TagFixture
 *
 */
class TagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'tag' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'tag' => array('column' => 'tag', 'unique' => 0),
			'item_id' => array('column' => 'item_id', 'unique' => 0)
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
			'tag' => 'Lorem ipsum dolor sit amet',
			'item_id' => 1,
			'created' => '2012-12-04 20:44:21'
		),
	);

}
