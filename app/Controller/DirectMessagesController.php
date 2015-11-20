<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 */
class DirectMessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $producers = array('DirectMessage', 'Producer', 'Activity');
	public $joiners = array('DirectMessage', 'Joiner', 'Activity');
	public $components = array('Paginator');
 	public $paginate = array(
 		'DirectMessage' => array(
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
				'DirectMessage' => array(
						'limit' => 20,
						'order' => array('created' => 'desc'),
				)
		);
		$this->DirectMessage->recursive = 1;		
		$this->set('directmessage', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DirectMessage->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('DirectMessage.' . $this->DirectMessage->primaryKey => $id), 'recursive' => 1);
		$data = $this->DirectMessage->find('first', $options);
		$this->set('directmessage', $data);

		if($data['DirectMessage']['send_mode'] == 2){
			$joiner_id = $this->DirectMessage->find('all', array('fields' => array('joiner_id'), 'conditions' => array('DirectMessage.created' => $data['DirectMessage']['created'], 'DirectMessage.project_id' => $data['DirectMessage']['project_id'], 'DirectMessage.producer_id' => $data['DirectMessage']['producer_id'])));
			$joinerAll = null;
			foreach($joiner_id as $joiner){
				$user_id = $this->Joiner->find('first', array('fields' => array('user_id'), 'conditions' => array('Joiner.id' => $joiner['DirectMessage']['joiner_id']), 'recursive' => -1));
				$student_number = $this->User->find('first', array('fields' => array('student_number'), 'conditions'=>array('User.id'=>$user_id['Joiner']['user_id']), 'recursive' => -1));
				//学生の名前を出力
				$student_name = $this->User->find('first', array('fields' => array('real_name'), 'conditions'=>array('User.id'=>$user_id['Joiner']['user_id']), 'recursive' => -1));
				if($joinerAll == null){
					$joinerAll = $student_number['User']['student_number']."　".$student_name['User']['real_name']."さん";
				}else{
					$joinerAll = $joinerAll.",  ".$student_number['User']['student_number']." ".$student_name['User']['real_name'];
				}
			}
			$this->set('joinerAll', $joinerAll);
		}
	}

/**
 * add methodroducer_id
 *
 * @return void
 */

     
	
	public function add($id=null,$id2=null) {
	  if($id2 == 1){
		 return $this->redirect(array('controller'=>'DirectMessages','action' =>'joiner_add',$id,$id2));
	  }else{
		 return $this->redirect(array('controller'=>'DirectMessages','action' =>'producer_add',$id,$id2)); 	
	  }
	}
	
	public function joiner_add($id=null,$id2=null) {//joiner(参加者)がproducer(企画者)に送る
		$userSession = $this->Auth->user();
		$number=0;
	    $this->set('num', $num);//なくてもよいかも
		$this->JoinersProject->recursive = 2;
		$producer = $this->Producer->find('first',array('conditions' => array('Producer.user_id' => $userSession['id'])));
		$project = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$this->set('project', $project);
		$producerList = $this->ProducersProject->find('all',array('conditions'=>array('ProducersProject.project_id'=>$id,'ProducersProject.producer_id'=>$producer['Producer']['id'])));
		$produser = $this->Project->find('all');   
        $project_name = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
        $project_name =$project_name[Project][project_name] ;
        $producer_name = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$producer_id = $this->ProducersProject->find('first',array('conditions' => array('ProducersProject.id' => $id)));
	    $producer_id=$producer_id  [ProducersProject]  [producer_id];//producer_idを取得
	    $my_num=$this->Auth->user();
	    $my_num=$my_num[id];//自分の学籍番号を取得
	    $this->set('producer_id', $producer_id);  
	    $this->set('project_name', $project_name);
	    $this->set('num',$id2 );//なくてもよいかも
		$options = array('conditions' => array('JoinersProject.project_id' => $id));
		$joiner_project = $this->JoinersProject->find('all', $options);
		$this->set('joiner_project', $this->JoinersProject->find('all', $options));
        $this->set('number', $number);
		$this->set('results', $message);	
	    $joiner_id = $this->Joiner->find('first', array("fields" => 'Joiner.id', "conditions" => array("Joiner.user_id" => $userSession['id'])));	
	    $delete_flag = $this->Project->find('first', array("fields" => 'Project.delete_flag', "conditions" => array("Project.id" => $id)));		 	  
        $safety_check=$this->JoinersProject->find('count', array(
        'fields' => Array('JoinersProject.joiner_id'),
        'conditions' => array( 'JoinersProject.joiner_id' => $joiner_id['Joiner']['id'],
        'JoinersProject.project_id' => $project[Project][id]
 )
    ));//参加者が自分か、プロジェクトが自分の参加するものかの判定
    
	 if($safety_check!=1|| $delete_flag[Project][delete_flag] == 1){//自分の企画が1つか。また、消されてないか
	 	return $this->redirect(array('controller'=>'Users','action' =>'view'));
	  }
	   if ($this->request->is('post')) {
                $select = $this->request->select;
        }
        $category=array(0 => '持ち物', 1 =>'遅刻・早退', 2 =>'参加費用', 3 =>'その他');
		if ($this->request->is('post')) {
			$data = $this->request->data['DirectMessage'];
			$data['category'] = $category[$data['category']];
			$data['project_id'] = $id;
			$data['text'] = nl2br($data['text']);	
			$data['producer_id'] = $producer_id;	
			unset($data['student_number']);
			$this->DirectMessage->create();
		    $data['send_mode'] = $id2;
			$joiner_id = $this->Joiner->find('first', array("fields" => 'Joiner.id', "conditions" => array("Joiner.user_id" => $userSession['id'])));
			$data['joiner_id'] = $joiner_id['Joiner']['id'];	
			if ($this->DirectMessage->save($data)) {	
			/*		//メール送信　宛先:企画者
				$student_number=$data['producer_id'];
				$message_text="企画の参加者からメッセージが届いています。";
				//	print_r( "to:".'ne'.$student_number.'@senshu-u.jp'."  "."to:".$student_number."  ".$message_text);
				if((260600<= $this->request->data['DirectMessage']['producer_id']) && ($this->request->data['DirectMessage']['producer_id'] <= 260999)){ //テスト用
					//print_r("true");}else{print_r("false");}
					$cakeemail=new CakeEmail('default');
					$cakeemail->to('waninaru.2015@gmail.com');
					$cakeemail->subject('【テスト用】メッセージ受信');
					$cakeemail->send($message_text);
				}else{
					$student_number=$this->request->data['DirectMessage']['producer_id'];
					$cakeemail=new CakeEmail('default');
					$cakeemail->to('ne'.$student_number.'@senshu-u.jp');
					$cakeemail->subject('メッセージ受信');
					$cakeemail->send($message_text);
				}
				*/
			//	echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
				return $this->redirect(array('controller'=>'DirectMessages','action' =>'view',$this->DirectMessage->id));
			} else {
				$this->Session->setFlash(__('メッセージを送信できませんでした。もう一度お試しください。'));
			}
		}
	}
	
	
	public function producer_add($id=null,$id2=null) {//producer(企画者)がjoiner(参加者)に送る
		$userSession = $this->Auth->user();
		$number=0;
	    $this->set('num', $num);//なくてもよいかも
		$this->JoinersProject->recursive = 2;
		$producer = $this->Producer->find('first',array('conditions' => array('Producer.user_id' => $userSession['id'])));
		$project = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$this->set('project', $project);
		$producerList = $this->ProducersProject->find('all',array('conditions'=>array('ProducersProject.project_id'=>$id,'ProducersProject.producer_id'=>$producer['Producer']['id'])));
		$produser = $this->Project->find('all');
	    $this->set('num',$id2 );//なくてもよいかも
		$options = array('conditions' => array('JoinersProject.project_id' => $id));
		$joiner_project = $this->JoinersProject->find('all', $options);
		$this->set('joiner_project', $this->JoinersProject->find('all', $options));//参加者のプロジェクト
        $this->set('number', $number);
		$this->set('results', $message);
	    if ($this->request->is('post')) {
          $select = $this->request->select;
        }
		$category=array(0 => '補足', 1 =>'日時の変更', 2 =>'中止', 3 =>'その他');
        $my_num=$this->Auth->user();
        $producer=$this->Auth->user();
	    $producer_id=$this->Producer->find('first', array('fields'=>'id', 'conditions'=>array('Producer.user_id'=>$producer[id])));
		$data['producer_id'] = $producer_id['Producer']['id'];  
	    $delete_flag = $this->Project->find('first', array("fields" => 'Project.delete_flag', "conditions" => array("Project.id" => $id)));		  
      //  print_r( $delete_flag[Project][delete_flag]);
    	//print_r( $delete_flag[Project][delete_flag]);
        $safety_check=$this->ProducersProject->find('count', array(
        'fields' => Array('ProducersProject.project_id'),
        'conditions' => array('ProducersProject.project_id' => $project['Project']['id'],
        'ProducersProject.producer_id' => $producer_id['Producer']['id'],
      
       
         )
      ));//企画者が自分か、プロジェクトが自分の参加するものかの判定
      
      
    	 
	  if($safety_check!=1|| $delete_flag[Project][delete_flag] == 1){//自分の企画が1つか。また、消されてないか
	   	return $this->redirect(array('controller'=>'Users','action' =>'view'));
	  }
		if ($this->request->is('post')) {		
			$data = $this->request->data['DirectMessage'];
			$data['project_id'] = $project['Project']['id'];
			$data['category'] = $category[$data['category']];
			$data['text'] = nl2br($data['text']);
		    $producer=$this->Auth->user();
	        $producer_id=$this->Producer->find('first', array('fields'=>'id', 'conditions'=>array('Producer.user_id'=>$producer[id])));
			$data['producer_id'] = $producer_id['Producer']['id'];
			unset($data['student_number']);
			$this->DirectMessage->create();
			$joiner_id =$_POST["select"][0];
			//print_r( $_POST["select"][0]);
			$JoinerAll =$joiner_id;
			$joiner = $this->User->find('first', array('fields'=>'id', 'conditions'=>array('User.student_number'=>$joiner_id)));
			$joiner = $this->Joiner->find('first', array('fields'=>'id', 'conditions'=>array('Joiner.user_id'=>$joiner[User][id])));
			$data['joiner_id'] = $joiner['Joiner']['id'];
			$data['send_mode'] = $id2;
			if ($this->DirectMessage->save($data)) {
			$message_id = $this->DirectMessage->find('first', array("fields" => 'DirectMessage.id', "order" => array("id" => "desc")));
			//メール送信　宛先:参加者
			$student_number=$data['joiner_id'];
			$message_text="参加中の企画の企画者からメッセージが届いています。";
			//print_r( "to:".'ne'.$student_number.'@senshu-u.jp'."  ".$message_text);
			if((260600<= $this->request->data['DirectMessage']['joiner_id']) && ($this->request->data['DirectMessage']['joiner_id'] <= 260999)){ //テスト用
				$cakeemail=new CakeEmail('default');
				$cakeemail->to('waninaru.2015@gmail.com');
				$cakeemail->subject('【テスト用】メッセージ受信');
				$cakeemail->send($message_text);
			}else{
				$student_number=$this->request->data['DirectMessage']['joiner_id'];
		//		$cakeemail=new CakeEmail('default');
		//		$cakeemail->to('ne'.$student_number.'@senshu-u.jp');
		//		$cakeemail->subject('メッセージ受信');
		//		$cakeemail->send($message_text);
			}
		     for ($i = 1; $i < count($_POST["select"]); $i++){ 
			 $this->DirectMessage->create();
		     $joiner_id =$_POST["select"][$i];
			 $joiner = $this->User->find('first', array('fields'=>'id', 'conditions'=>array('User.student_number'=>$joiner_id)));
			 $joiner = $this->Joiner->find('first', array('fields'=>'id', 'conditions'=>array('Joiner.user_id'=>$joiner[User][id])));	 
			 $data['joiner_id'] = $joiner['Joiner']['id'];
			 $this->DirectMessage->save($data);
			 //メール送信　宛先:参加者
			 $student_number=$data['joiner_id'];
			 $message_text="参加中の企画の企画者からメッセージが届いています。";
			 //print_r( "to:".'ne'.$student_number.'@senshu-u.jp'."  ".$message_text);
		//	 if((260600<= $this->request->data['DirectMessage']['joiner_id']) && ($this->request->data['DirectMessage']['joiner_id'] <= 260999)){ //テスト用
		//	 	$cakeemail=new CakeEmail('default');
		//	 	$cakeemail->to('waninaru.2015@gmail.com');
		//	 	$cakeemail->subject('【テスト用】メッセージ受信');
		//	 	$cakeemail->send($message_text);
		//	 }else{
		//	 	$student_number=$this->request->data['DirectMessage']['joiner_id'];
		//	 	$cakeemail=new CakeEmail('default');
		//	 	$cakeemail->to('ne'.$student_number.'@senshu-u.jp');
		//	 	$cakeemail->subject('メッセージ受信');
		//	 	$cakeemail->send($message_text);
		//	 }
                }
			//	echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
				return $this->redirect(array('controller'=>'DirectMessages','action' =>'view',$message_id['DirectMessage']['id']));
			} else {
				$this->Session->setFlash(__('メッセージを送信できませんでした。もう一度お試しください。'));
			}
		}	
	}
}
