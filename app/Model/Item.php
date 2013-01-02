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
		'Tag' => array(
			'dependent' => true
		)
	);

	/**
	 * Create a list of Tag models from a CSV of tags
	 * @param string $tag_csv CSV of tags
	 * @param int $item_id ID of item to link tags to
	 * @return array
	 */
	public function tagCsvToModel($tag_csv, $item_id) {
		$tag_strings = explode(',', $tag_csv);
		$tags = array();
		foreach($tag_strings as $tag_string) {
			$tags[] = array('tag' => trim($tag_string), 'item_id' => $item_id);
		}
		return $tags;
	}

	/**
	 * Create CSV of tags from list of models
	 * @param array $tags List of Tag models
	 * @return string
	 */
	public function tagModelToCsv($tags) {
		$tag_strings = array();
		foreach($tags as $tag) {
			$tag_strings[] = $tag['tag'];
		}
		return implode(', ', $tag_strings);
	}
}
