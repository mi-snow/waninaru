<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
	public $uses = array('User', 'Project', 'JoinersProject', 'Joiner', 'ProducersProject', 'Producer', 'Comment', 'UserTemp','Activity', 'Message');
	
/**
 * Components
 *
 * @var array
 */
	public $components = array(
			'Paginator',
			'Session',
			'Auth' => array(
					'loginRedirect' => array('controller'  => 'index', 'action' => 'index'),
					'logoutRedirect' => array('controller' => 'index', 'action' => 'index'),
					'authenticate' => array('Form' => array('fields' => array('username' => 'student_number','password'=>'user_password')))
			)
	);
/**
 * index method
 *
 * @return void
 */
 //どのアクションが呼ばれても最初に処理される関数
 public function beforeFilter(){
 	parent::beforeFilter();
 	$userSession = $this->Auth->user();
 	//未ログインでアクセス出来るアクションを指定
 	//これ以外のアクションへのアクセスはリダイレクトされる規約になっている
 	$this->Auth->allow('register','login','useradd');
 }
 
 	public $paginate = array(
 		'User' => array(
 			'limit' => 10,
 			'order' => array('id' => 'asc'),
 		)
 	);
 	
	public function index() {
		$userSession = $this->Auth->user();
		
		if($userSession['mode'] == 1){
			$this->Paginator->settings = array(
					'User' => array(
							'limit' => 20,
							'order' => array('id' => 'desc'),
					)
			);
			$this->User->recursive = 1;
			$this->set('users', $this->Paginator->paginate());
		}else{
			$this->autoRender = false;
			$this->User->recursive = 0;
			$this->set('users', $this->paginate());
			//ログイン後にリダイレクトされるアクション
			$this->set('user',$this->Auth->user());
			$this->redirect(array('action'=>'view', $userSession['id']));
		}
	}
	
	public function register(){
		//$this->requestにPOSTされたデータが入っている
		//POSTメソッドかつユーザ追加が成功したら
		if($this->request->is('post') && $this->User->save($this->request->data)){
			//ログイン
			// $this->request->dataの値を使用してログインする規約になっている
			$this->Auth->login();
			$this->redirect('index');
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$userSession = $this->Auth->user();
		if (!$this->User->exists($id)) {
			return $this->redirect(array('action' => 'index'));
		}
		if($id == $userSession['id'] || $userSession['mode'] == 1){
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
			
			$joiner = $this->Joiner->find('first',array('conditions'=>array('Joiner.user_id'=>$id)));
			$joinlist = $this->JoinersProject->find('list',array('fields'=>array('JoinersProject.project_id'),'conditions'=>array('JoinersProject.joiner_id'=>$joiner['Joiner']['id'])));
			$joinproject = $this->Project->find('all',array('conditions'=>array('Project.id'=>$joinlist,'Project.delete_flag'=>0)));
			$this->set('joindata',$joinproject);
			
			$producer = $this->Producer->find('first',array('conditions'=>array('Producer.user_id'=>$id)));
			$producelist = $this->ProducersProject->find('list',array('fields'=>array('ProducersProject.project_id'),'conditions'=>array('ProducersProject.producer_id'=>$producer['Producer']['id'])));
			$produceproject = $this->Project->find('all',array('conditions'=>array('Project.id'=>$producelist,'Project.delete_flag'=>0)));
			$this->set('producedata',$produceproject);
		}else{
			return $this->redirect(array('action' => 'index'));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$countnum = $this->User->find('count')+1;
			$this->User->create();
			$this->request->data['User']['user_password'] = AuthComponent::password($this->data['User']['user_password']);
			if ($this->User->save($this->request->data)) {
				//$this->Session->setFlash(__($this->User->user_password));
				$this->User->Id = $countnum;
				if ($this->User->save($this->request->data)) {
					$this->Activity->create();
					$Active[user_id]=$this->User->id;
					$this->Activity->save($Active);
					$message['user_id'] = $this->User->id;
					$message['category'] = 'その他';
					$message['text'] = 'Waninaruにご登録いただきありがとうございます！

Waninaruは企画を立てたり、企画に参加することを支援するためのウェブサービスです。
ぜひたくさん活用して充実したネ学生活をお楽しみください。

わに育成委員会';
					$massage['text'] = strip_tags($message['text']);
					$message['text'] = nl2br($message['text']);
					$this->Message->save($message);
					return $this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">登録できませんでした、再度お試しください。</font></b></div>'));
			}
		}
	}
	
	public function superadd(){
		$userSession = $this->Auth->user();
		if($userSession['mode'] == 1){
			if ($this->request->is('post')) {
				$countnum = $this->User->find('count')+1;
				$min = $this->request->data['User']['min'];
				$max = $this->request->data['User']['max'];
				for($i = $min ; $i <= $max ; $i++){
					$this->User->create();
					$this->request->data['User']['real_name'] = $i;
					$this->request->data['User']['student_number'] = $i;
					$this->request->data['User']['nick_name'] = $i;
					$this->request->data['User']['user_password'] = AuthComponent::password($i);
					$this->request->data['User']['mode'] = null;
					if ($this->User->save($this->request->data)) {
							$this->Activity->create();
							$Active[user_id]=$this->User->id;
							$this->Activity->save($Active);
							$message['user_id'] = $this->User->id;
							$message['category'] = 'その他';
							$message['text'] = 'Waninaruにご登録いただきありがとうございます！

Waninaruは企画を立てたり、企画に参加することを支援するためのウェブサービスです。
ぜひたくさん活用して充実したネ学生活をお楽しみください。

わに育成委員会';
							$massage['text'] = strip_tags($message['text']);
							$message['text'] = nl2br($message['text']);
							$this->Message->save($message);
					}
					else{
						$this->Session->setFlash('<div align="center"><b><font size="3" color="#ff0000">'.$i.'件目の学生の登録で失敗しました。再度登録願います。</font></b></div>');
						break;
					}
				}
				return $this->redirect(array('action' => 'index'));
			}
		}
	}
//user 本登録
	public function useradd() {
	
		if ($this->request->is('post')) {
			//パスワードの文字数チェック
			$this->User->set($this->data);
			if($this->User->invalidFields()){
				
			}else{
				$countnum = $this->User->find('count')+1;
				$this->User->create();	
				$reg_key=$this->UserTemp->find('all',array('conditions'=>array('UserTemp.student_number'=>$this->request->data['User']['student_number']),'fields'=>array('UserTemp.reg_key')));
				//echo print_r(data['User']['user_password']);
				
				if($this->request->data['User']['user_password'] == $this->request->data['User']['user_password2']){
					if($this->request->params[pass][0]==$reg_key[0][UserTemp][reg_key]){
						$this->request->data['User']['user_password'] = AuthComponent::password($this->data['User']['user_password']);
						$data = $this->request->data;
						$data['User']['login'] = 1;
						if ($this->User->save($data)) {
							$id = $this->User->id;
					        $this->request->data['User'] = array_merge($this->request->data['User'], array('id' => $id));
    					    if($this->Auth->login($this->request->data['User'])){
								$userSession = $this->Auth->user();
								$this->User->id = $userSession['id'];
								if($userSession['mode']==1){
									$this->request->data['User']['mode'] = 1;
								}else{
									$this->request->data['User']['mode'] = 0;
								}

								$this->User->Id = $countnum;
								$this->UserTemp->deleteAll(array('UserTemp.student_number'=>$this->request->data['User']['student_number']));
						
								//Activitiesへのデータ保存
								//$countA=$this->Activity->find('count')+1;
								$this->Activity->create();
								$Active[user_id]=$this->User->id;
								$this->Activity->save($Active);
								$this->Message->create();
								$message['user_id'] = $this->User->id;
								$message['category'] = 'その他';
								$message['text'] = 'Waninaruにご登録いただきありがとうございます！

Waninaruは企画を立てたり、企画に参加することを支援するためのウェブサービスです。
ぜひたくさん活用して充実したネ学生活をお楽しみください。

わに育成委員会';
								$massage['text'] = strip_tags($message['text']);
								$message['text'] = nl2br($message['text']);
								$this->Message->save($message);
								$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">登録完了しました。</font></b></div>'));
								return $this->redirect(array('controller' => 'projects', 'action' => 'index'));
    					    }
						} else {
							$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">登録できませんでした、再度お試しください。</font></b></div>'));
						}	
					}else {	
							$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">その学籍番号の仮登録が見つかりません。登録できませんでした、再度お試しください。</font></b></div>'));
					}
				}else{	
					$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">パスワードが一致しません。</font></b></div>'));
				}
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
	public function edit($id = null) {
		$userSession = $this->Auth->user();
		if(!$userSession['id']==$id && $userSession['mode']!=1){
			
			$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">ユーザの編集ができませんでした。もう一度お試し下さい。</font></b></div>'));
			return $this->redirect(array('controller'=>'Project','action' => 'index'));
		}
		$options = array('conditions' => array('User.id' => $id));
		$this->set('user', $this->User->find('first', $options));
		$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
		unset($user['User']['password']); // 念のためパスワードは除外。どうでもよければ消してもOK
		$this->Session->write('Auth', $user);
	}
	
	public function nameedit() {
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$this->User->id = $this->request->data['User']['id'];
		if ($this->request->is('post') || $this->request->is('put')) {
			if($userSession['mode'] == 1){
				$this->request->data['User']['mode'] = $userSession['mode'];
			}
			if ($this->User->save($this->request->data)) {
				$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
				$this->Session->write('Auth', $user);
				$this->set('userSession',$this->Auth->user());
			} else {
				$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">名前の編集ができませんでした。もう一度お試し下さい。</font></b></div>'));
			}
			$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
			$this->Session->write('Auth', $user);
			return $this->redirect(array('action' => 'view',$this->request->data['User']['id']));
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function nicknameedit() {
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$this->User->id = $this->request->data['User']['id'];
		if ($this->request->is('post') || $this->request->is('put')) {
			if($userSession['mode'] == 1){
				$this->request->data['User']['mode'] = $userSession['mode'];
			}
			if ($this->User->save($this->request->data)) {
				$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
				$this->Session->write('Auth', $user);
				$this->set('userSession',$this->Auth->user());
			} else {
				$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">名前の編集ができませんでした。もう一度お試し下さい。</font></b></div>'));
			}
			$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
			$this->Session->write('Auth', $user);
			return $this->redirect(array('action' => 'view',$this->request->data['User']['id']));
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
	
	public function passwordedit() {
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$this->User->id = $this->request->data['User']['id'];
		if ($this->request->is('post') || $this->request->is('put')) {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $userSession['id']));
			if($userSession['mode'] == 1){
				$this->request->data['User']['mode'] = $userSession['mode'];
			}
			$user = $this->User->find('first',array('conditions'=>array('User.id' => $userSession['id'])));
			if($user['User']['user_password'] == AuthComponent::password($this->data['User']['old_password'])){
				if($this->request->data['User']['new_password'] == $this->request->data['User']['new_password_second']){
					$this->request->data['User']['mode'] = $userSession['mode'];
					$this->request->data['User']['user_password'] = AuthComponent::password($this->data['User']['new_password']);
					if ($this->User->save($this->request->data)) {
						$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
						$this->Session->write('Auth', $user);
						$this->Session->setFlash(__('<div align="center">パスワードが正常に変更されました。</div>'));
					} else {
						$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">正常に保存できませんでした。もう一度お試し下さい。</font></b></div>'));
					}
				} else {
					$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">確認用パスワードが間違っています。</font></b></div>'));
				}
			} else {
				if($userSession['mode']!=1){
					$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">現在使用中のパスワードが間違っています。</font></b></div>'));
				}else{
					$this->Session->setFlash(__(AuthComponent::password($this->data['User']['old_password'])).' : '.$user['User']['user_password']);
					//$this->Session->setFlash($user['User']['user_password']);
				}
			}
			$user = $this->User->find('first', array('conditions' => array('id' => $this->Auth->user('id')), 'recursive' => -1));
			$this->Session->write('Auth', $user);
			return $this->redirect(array('action' => 'view',$this->request->data['User']['id']));
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $userSession['id']));
			$this->request->data = $this->User->find('first', $options);
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
		$userSession = $this->Auth->user();
		if($userSession['id']==$id || $userSession['mode']==1){
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->User->delete()) {
			} else {
				$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">ユーザを削除できませんでした。再度お試しください。'));
			}
			return $this->redirect(array('action' => 'index'));
		}else{
			return $this->redirect(array('action' => 'view',$id));
		}
	}
	
	public function login(){
		$today = Date("Y-m-d");
		if($this->request->is('post')){
			$logins = $this->User->find('all',array('conditions'=>array('login'=>1)));
			/**
			if(count($logins)>=70){
				$this->Session->setFlash('<div align="center"><b><font size="3" color="#ff0000">ログイン数超過のため、現在ログイン制限をかけております。しばらくしてから再度ログインください。</font></b></div>');
			}else{
			**/
				if($this->Auth->login()){
					$userSession = $this->Auth->user();
					$this->User->id = $userSession['id'];
					$this->request->data['User']['login'] = 1;
					if($userSession['mode']==1){
						$this->request->data['User']['mode'] = 1;
					}else{
						$this->request->data['User']['mode'] = 0;
					}
					
					$this->request->data['User']['user_password'] = AuthComponent::password($this->data['User']['user_password']);

					if($this->User->save($this->request->data)){
						return $this->redirect(array('controller'=>'projects', 'action'=>'index'));
					}
				}
				else{
					$this->Session->setFlash('<div align="center"><b><font size="3" color="#ff0000">学籍番号またはパスワードが正しく入力されていません。</font></b></div>');
				}
			//}
			
		}
	}
	
	public function logout(){
		$userSession = $this->Auth->user();
		$this->User->id = $userSession['id'];
		$this->request->data['User']['login'] = 0;
		if($userSession['mode']==1){
			$this->request->data['User']['mode'] = 1;
		}else{
			$this->request->data['User']['mode'] = 0;
		}
		if($this->User->save($this->request->data)){
			$this->Auth->logout();
			$this->redirect(array('controller' => 'projects', 'action' => 'index'));
		}
	}
	
	
	
	public function config(){}
	//パスワード初期化機能
	public function passwordiniti(){
		if($this->request->is('post')){
			$user_id=$this->User->set($this->data);
			$user=$this->User->find('first',array('conditions'=>array('User.student_number'=>$this->request->data['User']['student_number'])));
			//print_r($user);
			$ipassword="123456";//初期化後のパスワード
			if ($user!=null) {
				$user['User']['user_password']=AuthComponent::password($ipassword);
				$this->User->save($user,array('validate'=>true,'fieldList'=>array('user_password')));
				$this->Session->setFlash(__('<div align="center">パスワードが正常に初期化されました。</div>'));
				return $this->redirect(array('controller'=>'projects', 'action'=>'index'));
			}else{//対象のユーザが見つからない。
				$this->Session->setFlash('<div align="center"><b><font size="3" color="#ff0000">その学籍番号のユーザが見つかりませんでした。</font></b></div>');
			}
		}
	}
	
	
	
}