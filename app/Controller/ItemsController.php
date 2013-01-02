<?php

App::uses('AppController', 'Controller');

/**
 * Items Controller
 *
 * @property Item $Item
 * @property Tag $Tag
 */
class ItemsController extends AppController {

	var $uses = array('Item', 'Tag');

	/**
	 * store method
	 *
	 * @return void
	 */
	public function store() {
		if($this->request->is('post')) {
			//Parse tags from tag input element
			$tag_csv = $this->request->data['Item']['tags'];
			unset($this->request->data['Item']['tags']);
			//Save Item
			$this->Item->create();
			if($this->Item->save($this->request->data)) {
				//Save Tags
				if($this->_saveTagsFromCsv($tag_csv, $this->Item->id)) {
					$this->Session->setFlash(__('The item has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('Unable to save tags.'));
				}
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories'));
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->Item->recursive = 0;
		$this->set('items', $this->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->Item->id = $id;
		if(!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		$this->set('item', $this->Item->read(null, $id));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if($this->request->is('post')) {
			$this->Item->create();
			if($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		}
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories'));
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$this->Item->id = $id;
		if(!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if($this->request->is('post') || $this->request->is('put')) {
			if($this->Item->save($this->request->data)) {
				$this->Session->setFlash(__('The item has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The item could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Item->read(null, $id);
		}
		$categories = $this->Item->Category->find('list');
		$this->set(compact('categories'));
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if(!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Item->id = $id;
		if(!$this->Item->exists()) {
			throw new NotFoundException(__('Invalid item'));
		}
		if($this->Item->delete()) {
			$this->Session->setFlash(__('Item deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Item was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * Save Tags for Item from CSV
	 * @param string $tag_csv CSV of tags
	 * @param int $item_id ID of Item to associate tags with
	 * @return bool
	 */
	protected function _saveTagsFromCsv($tag_csv, $item_id) {
		$tags = $this->Item->tagCsvToModel($tag_csv, $item_id);
		$tags_success = true;
		foreach($tags as $tag) {
			$this->Tag->create();
			if(!$this->Tag->save($tag)) {
				$tags_success = false;
			}
		}
		return $tags_success;
	}

}
