<?php
App::uses('AppController', 'Controller');
/**
 * Producers Controller
 *
 * @property Producer $Producer
 * @property PaginatorComponent $Paginator
 */
class ProducersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->autoRender = false;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->autoRender = false;
		if ($this->request->is('post')) {
			$this->Producer->create();
			if ($this->Producer->save($this->request->data)) {
			} else {
				$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">企画者登録に失敗しました。もう一度お試し下さい。</font></b></div>'));
			}
		}
		$users = $this->Producer->User->find('list');
		$this->set(compact('users'));
	}}
