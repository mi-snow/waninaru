<?php
App::uses ( 'AppController', 'Controller' );
App::uses('CakeEmail', 'Network/Email');
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
	public function sub_add($project_id = null, $joiner_id = null, $result = null) { // 送る人が$producer_id、 受け取る人が$joiner_id
		$userSession = $this->Auth->user ();
		// print_r($project_id);
		// print_r($joiner_id);
		// $project_id = 0;
		// 送られる人
		$user_id = $this->Joiner->find ( 'first', array (
				'conditions' => array (
						'Joiner.id' => $joiner_id 
				),
				'recursive' => 0,
				'fileds' => 'Joiner.user_id' 
		) );
		$user_id = $user_id ['Joiner'] ['user_id'];
		// print_r($user_id);
		$producer_id = $this->Producer->find ( 'first', array (
				'conditions' => array (
						'Producer.user_id' => $user_id 
				),
				'recursive' => 0,
				'fields' => 'Producer.id' 
		) );
		// 送る人
		$producer_id2 = $this->Producer->find ( 'first', array (
				'conditions' => array (
						'Producer.user_id' => $userSession ['id'] 
				),
				'recursive' => 0,
				'fields' => 'Producer.id' 
		) );
		$project_name = $this->Project->find ( 'first', array (
				'conditions' => array (
						'Project.id' => $project_id 
				),
				'recursive' => 0,
				'fields' => 'Project.project_name' 
		) );
		// $producer_id = $producer_id['Producer']['id'];
		// print_r($producer_id);
		$result = true;
		if ($result) {
			if (count ( $producer_id ) <= 0) {
				$this->Producer->create ();
				$this->request->data ['Producer'] ['user_id'] = $user_id;
				if ($this->Producer->save ( $this->request->data )) {
					$producer_id = $this->Producer->find ( 'all', array (
							'conditions' => array (
									'Producer.user_id' => $user_id 
							) 
					) );
				} else {
					$this->Session->setFlash ( __ ( '<div align="center"><b><font size="3" color="#ff0000">企画者登録に失敗しました。</font></b></div>' ) );
				}
			}
			// print_r($producer_id);
			// print_r($user_id);
			$this->ProducersProject->create ();
			$data ['producer_id'] = $producer_id ['Producer'] ['id'];
			$data ['project_id'] = $project_id;
			$this->ProducersProject->save ( $data );
			// $this->request->data ['ProducersProject'] ['user_id'] = $producer_id ['Producer'] ['user_id'];
			// $this->request->data ['ProducersProject'] ['project_id'] = $project_id;
			// $this->ProducersProject->save($this->request->data);
			
			// DM
			$this->DirectMessage->create ();
			// $joiner_id =$_POST["select"][0];
			$data ['category'] = '企画者申請';
			$data ['text'] = '「' . $project_name ['Project'] ['project_name'] . '」の企画者として許可されました。';
			$data ['text'] = nl2br ( $data ['text'] );
			$data ['project_id'] = $project_id;
			$data ['producer_id'] = $producer_id2 ['Producer'] ['id'];
			$data ['joiner_id'] = $joiner_id;
			$data ['send_mode'] = '2';
			$student_number = $this->User->find ( 'first', array (
					'conditions' => array (
							'User.id' => $user_id 
					),
					'recursive' => 0,
					'fileds' => 'User.student_number' 
			) );
			// print_r($producer_id2);
			$student_number = $student_number ['User'] ['student_number'];
//			print_r($student_number);
			// print_r($data);
			$this->DirectMessage->save ( $data );
			if ($this->DirectMessage->save ( $data )) {
				/*
				  //メール送信　宛先:企画者
				  $student_number=$data['producer_id'];
				  $message_text="企画登録が承認されました";
				  // print_r( "to:".'ne'.$student_number.'@senshu-u.jp'." "."to:".$student_number." ".$message_text);
				  if((260600<= $student_number) && ($student_number <= 260999)){ //テスト用
				  //print_r("true");}else{print_r("false");}
				  $cakeemail=new CakeEmail('default');
				  $cakeemail->to('waninaru.2015@gmail.com');
				  $cakeemail->subject('【テスト用】メッセージ受信');
				  $cakeemail->send($message_text);
				  }else{
				  $cakeemail=new CakeEmail('default');
				  $cakeemail->to('ne'.$student_number.'@senshu-u.jp');
				  $cakeemail->subject('メッセージ受信');
				  $cakeemail->send($message_text);
				  }
				 */
				// echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
//			print_r($student_number);
			$this->Session->setFlash(__('企画者申請を承認しました。'));
			return $this->redirect(array('controller'=>'Projects', 'action' =>'view', $project_id));
				 
				// echo @$_POST["select"][0]."　";
			} else {
				$this->Session->setFlash ( __ ( 'メッセージを送信できませんでした。もう一度お試しください。' ) );
			}
		} else {
			$this->DirectMessage->create ();
			// $joiner_id =$_POST["select"][0];
			
			$data ['category'] = '企画者申請';
			$data ['text'] = '「' . $project_name ['Project'] ['project_name'] . '」に企画者として許可されませんでした。';
			$data ['text'] = nl2br ( $data ['text'] );
			$data ['project_id'] = $project_id;
			$data ['producer_id'] = $producer_id2 ['Producer'] ['id'];
			$data ['joiner_id'] = $joiner_id;
			$data ['send_mode'] = '2';
			$student_number = $this->User->find ( 'first', array (
					'conditions' => array (
							'User.id' => $user_id 
					),
					'recursive' => 0,
					'fileds' => 'User.student_number' 
			) );
			$student_number = $student_number ['User'] ['student_number'];
			// print_r($data);
			if ($this->DirectMessage->save ( $data )) {
				/*
				  //メール送信　宛先:企画者
				  $message_text="企画者登録が承認されませんでした";
				  // print_r( "to:".'ne'.$student_number.'@senshu-u.jp'." "."to:".$student_number." ".$message_text);
				  if((260600<= $student_number) && ($student_number <= 260999)){ //テスト用
				  //print_r("true");}else{print_r("false");}
				  $cakeemail=new CakeEmail('default');
				  $cakeemail->to('waninaru.2015@gmail.com');
				  $cakeemail->subject('【テスト用】メッセージ受信');
				  $cakeemail->send($message_text);
				  }else{
				  $cakeemail=new CakeEmail('default');
				  $cakeemail->to('ne'.$student_number.'@senshu-u.jp');
				  $cakeemail->subject('メッセージ受信');
				  $cakeemail->send($message_text);
				  }
				  */
//				  print_r('$student_number');
				$this->Session->setFlash(__('企画者申請を承認しませんでした。'));
				return $this->redirect(array('controller'=>'Projects', 'action' =>'view', $project_id));
			}
		}
	}
	
	public function application($project_id = null, $producer_id = null){
		$userSession = $this->Auth->user();

		$data = $this->request->data['DirectMessage'];
		$data['category'] = '企画者申請';
		$data['project_id'] = $project_id;
		
		$project_title = $this->Project->find('first', array('conditions' => array('Project.id' => $project_id), 'recursive' => '-1'));
		$project_title = $project_title['Project']['project_name'];
//		print_r($project_title);
		
		$data['text'] = '貴方の立てた '.$project_title.' に企画者追加申請がきています。
承認しますか？';
		
		$data['text'] = nl2br($data['text']);
		
		$data['producer_id'] = $producer_id;
		$data['send_mode'] = 3;
		
		$joiner_id = $this->Joiner->find('first', array("fields" => 'Joiner.id', "conditions" => array("Joiner.user_id" => $userSession['id'])));
		$data['joiner_id'] = $joiner_id['Joiner']['id'];
		
//		print_r($data);
		
		$producer = $this->Producer->find('first', array("fields" => 'Producer.user_id', "conditions" => array("Producer.id" => $data[producer_id]), 'recursive' => -1));

//		print_r($producer);
		
		$student_number=$this->User->find('first', array('fields' => 'User.student_number', 'conditions' => array("User.id" => $producer['Producer']['user_id']), 'recursive' => -1));
		
//		print_r($student_number);
		
		$student_number = $student_number['User']['student_number'];
		
//		print_r($student_number);
		
		$this->DirectMessage->create();
		
//		print_r($data);
		if ($this->DirectMessage->save($data)) {
			/*		//メール送信　宛先:企画者
			
			$message_text="企画者追加申請が届いています。";
			//	print_r( "to:".'ne'.$student_number.'@senshu-u.jp'."  "."to:".$student_number."  ".$message_text);
			if((260600<= $student_number) && ($student_number <= 260999)){ //テスト用
			//print_r("true");}else{print_r("false");}
			$cakeemail=new CakeEmail('default');
			$cakeemail->to('waninaru.2015@gmail.com');
			$cakeemail->subject('【テスト用】メッセージ受信');
			$cakeemail->send($message_text);
			}else{
			$cakeemail=new CakeEmail('default');
			$cakeemail->to('ne'.$student_number.'@senshu-u.jp');
			$cakeemail->subject('メッセージ受信');
			$cakeemail->send($message_text);
			}
			*/
			//	echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
			$this->Session->setFlash(__('企画者になるための申請しました。'));
			return $this->redirect(array('controller'=>'Projects', 'action' =>'view', $project_id));
			//echo @$_POST["select"][0]."　";
		} else {
			$this->Session->setFlash(__('メッセージを送信できませんでした。もう一度お試しください。'));
		}
				
	}
}