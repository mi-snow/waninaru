<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 */
class CommentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('view');
	}
	
	public $components = array('Paginator');
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->autoRender = false;
		$this->Comment->recursive = 0;
		$this->set('comments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->autoRender = false;
		if (!$this->Comment->exists($id)) {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">無効なコメントです。</font></b></div>'));
		}
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id, 'Comment.delete_flag' => 0));
		$this->set('comment', $this->Comment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$userSession = $this->Auth->user();
//		print_r($this->request->data);
//		print_r($userSession);
		$this->autoRender = false;
		if ($userSession == null) {
			return $this->redirect(array('controller'=>'projects','action' => 'view'));
		}else{
			$projectid = $this->request->data['Comment']['project_id'];
			$commentcount = $this->Comment->find('first',array('conditions' => array('Comment.project_id'=>$projectid),'order'=>array('Comment.id desc')));
			if ($this->request->is('post')){
				$this->request->data['Comment']['comment_num'] = $commentcount['Comment']['comment_num'] + 1;
				$this->Comment->create();
				$this->request->data['Comment']['comment_text'] = htmlspecialchars($this->request->data['Comment']['comment_text']);
				$this->request->data['Comment']['comment_text'] = nl2br($this->request->data['Comment']['comment_text']);
				if ($this->Comment->save($this->request->data)) {
					return $this->redirect(array('controller'=>'projects','action' => 'view',$this->request->data['Comment']['project_id'] ));
				} else {
					$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">コメントを投稿できませんでした、再度お試しください。</font></b></div>'));
				}
			}
			$users = $this->Comment->User->find('list');
			$projects = $this->Comment->Project->find('list');
			$this->set(compact('users', 'projects'));
		}
	}



/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null,$project_id = null) {
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$this->Comment->id = $id;
//		print_r($this->request->data);
		if (!$this->Comment->exists()) {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">無効なコメントです。</font></b></div>'));
			return $this->redirect(array('controller'=>'projects','action' => 'view',$project_id));
		}
		$this->request->data['Comment']['delete_flag'] = 1;
		if ($this->Comment->save($this->request->data)) {
			$this->Session->setFlash(('<div align="center"><b><font size="3">コメントを削除しました。</font></b></div>'));
		} else {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">コメントの削除ができませんでした。もう一度お試し下さい。</font></b></div>'));
		}
		return $this->redirect(array('controller'=>'projects','action' => 'view',$project_id));
	}
}