<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class MessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $uses = array('Message', 'User', 'Activity');
	
	public $components = array('Paginator');
	
 	public $paginate = array(
 		'Message' => array(
 			'limit' => 20,
 			'order' => array('id' => 'asc'),
 		)
 	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = array(
				'Message' => array(
						'limit' => 20,
						'order' => array('created' => 'desc'),
				)
		);
		$this->Message->recursive = 1;		
		$this->set('messages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id), 'recursive' => 0);
		$this->set('message', $this->Message->find('first', $options));
//		$message = $this->Message->find('first', array('recursive' => 0));
//		print_r($message);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$category=array(0 => 'メンテ', 1 =>'警告', 2 =>'提案', 3 =>'その他');
//		print_r($category);
		if ($this->request->is('post')) {
			$data = $this->request->data['Message'];
			$data['category'] = $category[$data['category']];
//			print_r($data);
			$data['text'] = nl2br($data['text']);
			if($data['student_number'] != null){
				$user_id = $this->User->find(first, array('fields'=>array('User.id'), 'conditions'=>array('User.student_number'=>$data['student_number']), 'recursive' => -1));
//				print_r($user_id);
				$user_id = $user_id['User']['id'];
			}else{
				$user_id = -1;				
			}
			$data['user_id'] = $user_id;
			unset($data['student_number']);
//			print_r($data);
			$this->Message->create();
			if ($this->Message->save($data)) {
				if($data['user_id'] == -1){
					$this->User->updateAll(array('info_flag'=> 1));
				}
				return $this->redirect(array('controller'=>'messages', 'action' => 'view',$this->Message->id));
			} else {
				$this->Session->setFlash(__('メッセージを送信できませんでした。もう一度お試しください。'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function edit($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Message->save($this->request->data)) {
				$this->Session->setFlash(__('The message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id));
			$this->request->data = $this->Message->find('first', $options);
		}
		$users = $this->Message->User->find('list');
		$this->set(compact('users'));
	}
*/

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
/*	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Message->delete()) {
			$this->Session->setFlash(__('The message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
*/
}
