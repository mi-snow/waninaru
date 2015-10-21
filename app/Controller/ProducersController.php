<?php
App::uses ( 'AppController', 'Controller' );
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
	public $components = array (
			'Paginator' 
	);
	
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
		if ($this->request->is ( 'post' )) {
			$this->Producer->create ();
			if ($this->Producer->save ( $this->request->data )) {
			} else {
				$this->Session->setFlash ( ('<div align="center"><b><font size="3" color="#ff0000">企画者登録に失敗しました。もう一度お試し下さい。</font></b></div>') );
			}
		}
		$users = $this->Producer->User->find ( 'list' );
		$this->set ( compact ( 'users' ) );
	}
	/**
	 * sub_add method
	 *
	 * @return void
	 */
	public function sub_add() {
		$userSession = $this->Auth->user ();
		$user_id = $this->User->find ( 'first', array (
				'conditions' => array (
						'User.user_id' => $joiner_id 
				),
				'recursive' => 0,
				'fileds' => 'User.user_id' 
		) );
		$producer_id = $this->Producer->find ( 'first', array (
				'conditions' => array (
						'Producer.user_id' => $user_id ['User'] ['id'] 
				) 
		) );
		if (true) {
			if (count ( $producer ) <= 0) {
				$this->Producer->create ();
				$this->request->data ['Producer'] ['user_id'] = $user_id ['User'] ['id'];
				if ($this->Producer->save ( $this->request->data )) {
					$producer = $this->Producer->find ( 'all', array (
							'conditions' => array (
									'Producer.user_id' => $user_id ['User'] ['id'] 
							) 
					) );
				} else {
					$this->Session->setFlash ( __ ( '<div align="center"><b><font size="3" color="#ff0000">企画者登録に失敗しました。</font></b></div>' ) );
				}
			}
			$this->ProducersProject->create ();
			$this->request->data ['ProducersProject'] ['user_id'] = $user_id ['User'] ['id'];
			$this->request->data ['ProducersProject'] ['project_id'] = $user_id ['User'] ['id'];
			$this->ProducersProject->save ( $this->request->data );
			// DM
			$this->DirectMessage->create ();
			// $joiner_id =$_POST["select"][0];
			$data ['send_mode'] = '企画者申請';
			$data ['joiner_id'] = $userSession ['id'];
			$student_number = $this->User->find ( 'first', array (
					'conditions' => array (
							'User.user_id' => $user_id ['User'] ['id'] 
					),
					'recursive' => 0,
					'fileds' => 'User.student_number' 
			) );
			$student_number = $student_number ['User'] ['student_number'];
			// print_r($data);
			if ($this->DirectMessage->save ( $data )) {
				/*
				 * //メール送信　宛先:企画者
				 * $student_number=$data['producer_id'];
				 * $message_text="企画登録が承認されました";
				 * // print_r( "to:".'ne'.$student_number.'@senshu-u.jp'." "."to:".$student_number." ".$message_text);
				 * if((260600<= $this->request->data['DirectMessage']['producer_id']) && ($this->request->data['DirectMessage']['producer_id'] <= 260999)){ //テスト用
				 * //print_r("true");}else{print_r("false");}
				 * $cakeemail=new CakeEmail('default');
				 * $cakeemail->to('waninaru.2015@gmail.com');
				 * $cakeemail->subject('【テスト用】メッセージ受信');
				 * $cakeemail->send($message_text);
				 * }else{
				 * $student_number=$this->request->data['DirectMessage']['producer_id'];
				 * $cakeemail=new CakeEmail('default');
				 * $cakeemail->to('ne'.$student_number.'@senshu-u.jp');
				 * $cakeemail->subject('メッセージ受信');
				 * $cakeemail->send($message_text);
				 * }
				 */
				// echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
				return $this->redirect ( array (
						'controller' => 'DirectMessages',
						'action' => 'view',
						$this->DirectMessage->id 
				) );
				// echo @$_POST["select"][0]."　";
			} else {
				$this->Session->setFlash ( __ ( 'メッセージを送信できませんでした。もう一度お試しください。' ) );
			}
		} else {
			$this->DirectMessage->create ();
			// $joiner_id =$_POST["select"][0];
			$data ['send_mode'] = '企画者申請';
			$data ['joiner_id'] = $userSession ['id'];
			$student_number = $this->User->find ( 'first', array (
					'conditions' => array (
							'User.user_id' => $user_id ['User'] ['id'] 
					),
					'recursive' => 0,
					'fileds' => 'User.student_number' 
			) );
			$student_number = $student_number ['User'] ['student_number'];
			// print_r($data);
			if ($this->DirectMessage->save ( $data )) {
				/*
				 * //メール送信　宛先:企画者
				 * $student_number=$data['producer_id'];
				 * $message_text="企画者登録が承認されませんでした";
				 * // print_r( "to:".'ne'.$student_number.'@senshu-u.jp'." "."to:".$student_number." ".$message_text);
				 * if((260600<= $this->request->data['DirectMessage']['producer_id']) && ($this->request->data['DirectMessage']['producer_id'] <= 260999)){ //テスト用
				 * //print_r("true");}else{print_r("false");}
				 * $cakeemail=new CakeEmail('default');
				 * $cakeemail->to('waninaru.2015@gmail.com');
				 * $cakeemail->subject('【テスト用】メッセージ受信');
				 * $cakeemail->send($message_text);
				 * }else{
				 * $student_number=$this->request->data['DirectMessage']['producer_id'];
				 * $cakeemail=new CakeEmail('default');
				 * $cakeemail->to('ne'.$student_number.'@senshu-u.jp');
				 * $cakeemail->subject('メッセージ受信');
				 * $cakeemail->send($message_text);
				 * }
				 */
				// echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
				return $this->redirect ( array (
						'controller' => 'DirectMessages',
						'action' => 'view',
						$this->DirectMessage->id 
				) );
				// echo @$_POST["select"][0]."　";
			}
		}
	}
}