<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail','Network/Email');
/**
 * UserTemps Controller
 *
 * @property UserTemp $UserTemp
 * @property PaginatorComponent $Paginator
 */
class UserTempsController extends AppController {
public function beforeFilter(){
 	parent::beforeFilter();
 	$userSession = $this->Auth->user();
 	//未ログインでアクセス出来るアクションを指定
 	//これ以外のアクションへのアクセスはリダイレクトされる規約になっている
 	$this->Auth->allow('add','add_after');
 }
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
		$this->UserTemp->recursive = 0;
		$this->set('userTemps', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UserTemp->exists($id)) {
			throw new NotFoundException(__('Invalid user temp'));
		}
		$options = array('conditions' => array('UserTemp.' . $this->UserTemp->primaryKey => $id));
		$this->set('userTemp', $this->UserTemp->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	//仮登録
	public function add() {
		$data = '今回はWaninaruへの仮登録をありがとうございます。
以下のURLから本登録をお願いします。

このメールに心当たりがない方は、お手数ですがこのメールの削除をお願いします。

';
		if ($this->request->is('post')) {
			$this->UserTemp->create();
			$reg_key=uniqid(rand(),true);
			$reg_key=substr($reg_key,0,8);
			$this->UserTemp->data['UserTemp']['reg_key']=$reg_key;
	
				if ($this->UserTemp->save($this->request->data)) {//dataを保存する
				//	$this->Session->setFlash(__('The user temp has been saved.'));
					// print_r('http://waninaru/users/useradd/'.$reg_key);	
					//メール送信
					if((260600<= $this->request->data['UserTemp']['student_number']) && ($this->request->data['UserTemp']['student_number'] <= 260999)){ //テスト用
						$student_number=$this->request->data['UserTemp']['student_number'];
						$cakeemail=new CakeEmail('default');
						$cakeemail->to('waninaru.2015@gmail.com');
						$cakeemail->subject('【テスト用】仮登録完了のお知らせ');
						$cakeemail->send($data.sprintf('http://waninaru.net/Users/useradd/%s', $reg_key));
					}else{
						$student_number=$this->request->data['UserTemp']['student_number'];
						$cakeemail=new CakeEmail('default');
						$cakeemail->to('ne'.$student_number.'@senshu-u.jp');
						$cakeemail->subject('仮登録完了のお知らせ');
						$cakeemail->send($data.sprintf('http://waninaru.net/Users/useradd/%s', $reg_key));
					}
			
					return $this->redirect('/UserTemps/add_after'); //仮登録後はadd_afterへ
				} else {
					$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">保存に失敗しました。もう一度お試し下さい。</font></b></div>'));
				}
	//		} else {
		//			$this->Session->setFlash(__('The user temp could not be saved. Please, try again.'));
		//	}
			
		}
	}
	//add_after
	public function add_after() {
		
	}
	
/*motono program
 * 	public function add() {
		if ($this->request->is('post')) {
			$this->UserTemp->create();
			if ($this->UserTemp->save($this->request->data)) {
				$this->Session->setFlash(__('The user temp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user temp could not be saved. Please, try again.'));
			}
		}
	}*/

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UserTemp->exists($id)) {
			throw new NotFoundException(__('Invalid user temp'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->UserTemp->save($this->request->data)) {
				$this->Session->setFlash(__('The user temp has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user temp could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UserTemp.' . $this->UserTemp->primaryKey => $id));
			$this->request->data = $this->UserTemp->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UserTemp->id = $id;
		if (!$this->UserTemp->exists()) {
			throw new NotFoundException(__('Invalid user temp'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UserTemp->delete()) {
			$this->Session->setFlash(__('The user temp has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user temp could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
