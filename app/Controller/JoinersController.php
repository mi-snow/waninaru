<?php
App::uses('AppController', 'Controller');
/**
 * Joiners Controller
 *
 * @property Joiner $Joiner
 * @property PaginatorComponent $Paginator
 */
class JoinersController extends AppController {
	
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
			$this->Joiner->create();
			if ($this->Joiner->save($this->request->data)) {
			} else {
				$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">参加者登録に失敗しました。もう一度お試し下さい。</font></b></div>'));
			}
		}
		$users = $this->Joiner->User->find('list');
		$this->set(compact('users'));
	}}