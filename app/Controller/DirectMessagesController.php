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
	public function view($id = null,$JoinerAll,$id2,$project_name=null ) {
		//$JoinerAll=1;
		  $this->set('JoinerAll', $JoinerAll);
		  $this->set('num', $id2);
		   $this->set('project_name', $project_name);
		  
		if (!$this->DirectMessage->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		$options = array('conditions' => array('DirectMessage.' . $this->DirectMessage->primaryKey => $id), 'recursive' => 0);
		$this->set('directmessage', $this->DirectMessage->find('first', $options));
//		$message = $this->Message->find('first', array('recursive' => 0));
//		print_r($message);
    
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
	
	public function joiner_add($id=null,$id2=null) {
		
     //  print_r($id);
    //   print_r($id2);
		$userSession = $this->Auth->user();
		$number=0;
	    $this->set('num', $num);
		$this->JoinersProject->recursive = 2;
		$producer = $this->Producer->find('first',array('conditions' => array('Producer.user_id' => $userSession['id'])));
		$project = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$this->set('project', $project);
		$producerList = $this->ProducersProject->find('all',array('conditions'=>array('ProducersProject.project_id'=>$id,'ProducersProject.producer_id'=>$producer['Producer']['id'])));
		$prouser = $this->Project->find('all');
		
	
                
        $project_name = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
        $project_name =$project_name[Project][project_name] ;
       // print_r($project_name);
        $producer_name = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$producer_id = $this->ProducersProject->find('first',array('conditions' => array('ProducersProject.id' => $id)));
	    $producer_id=$producer_id  [ProducersProject]  [producer_id];
	    $producer_id= $this->Producer->find('first',array('conditions' => array('Producer.id' => $producer_id)));
	    $producer_id=$producer_id  [Producer]  [user_id];
	    $producer_id= $this->User->find('first',array('conditions' => array('User.id' => $producer_id)));
	    $producer_id=$producer_id[User][student_number];
	  //  $producer_id=$producer_id2[User][nick_name];
	
	    $my_num=$this->Auth->user();
	    $my_num=$my_num[student_number];
	//    print_r($a);
	    
	    $this->set('producer_id', $producer_id);
	    //    $this->set('producer_id4', $producer_id4); 
	         $this->set('project_name', $project_name);
	    //    $this->set('my_num',$my_num );
	 
	          $this->set('num',$id2 );
	
	
			$options = array('conditions' => array('JoinersProject.project_id' => $id));
			$joiner_project = $this->JoinersProject->find('all', $options);
			$this->set('joiner_project', $this->JoinersProject->find('all', $options));
         	$this->set('number', $number);
			$this->set('results', $message);
	       
	   if ($this->request->is('post')) {
                $select = $this->request->select;
        }
       
        $category=array(0 => '持ち物', 1 =>'遅刻・早退', 2 =>'参加費用', 3 =>'その他');
        
		if ($this->request->is('post')) {
			$data = $this->request->data['DirectMessage'];
			$data['category'] = $category[$data['category']];
		
			$data['text'] = nl2br($data['text']);
		
			$data['producer_id'] = $producer_id;
		
			unset($data['student_number']);
			$this->DirectMessage->create();
		//	$joiner_id =$_POST["select"][0];
			  $data['send_mode'] = $id2;
		
			  $data['joiner_id'] = $my_num;
		//print_r($data);
			if ($this->DirectMessage->save($data)) {
	
				
				
			//	echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
				return $this->redirect(array('controller'=>'DirectMessages','action' =>'view',$this->DirectMessage->id,$producer_id,$id2, $project_name ));
				//echo @$_POST["select"][0]."　";
			} else {
				$this->Session->setFlash(__('メッセージを送信できませんでした。もう一度お試しください。'));
			}
		}
		
	}
	
	
	public function producer_add($id=null,$id2=null) {
		
	
     //  print_r($id);
    //   print_r($id2);
		$userSession = $this->Auth->user();
		$number=0;
       
	
	//	$id=$this->Producer->find('all',array('conditions' => array('Producer.user_id' => $userSession['id'])),array('fields'=>'producer_id'));
    // print_r($id);
	//	$id=$id [0] ['ProducersProject'] [0] ['project_id'];
	    $this->set('num', $num);
		$this->JoinersProject->recursive = 2;
		$producer = $this->Producer->find('first',array('conditions' => array('Producer.user_id' => $userSession['id'])));
		$project = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$this->set('project', $project);
		$producerList = $this->ProducersProject->find('all',array('conditions'=>array('ProducersProject.project_id'=>$id,'ProducersProject.producer_id'=>$producer['Producer']['id'])));
		$prouser = $this->Project->find('all');
		
	 
	          $this->set('num',$id2 );
	
	
			$options = array('conditions' => array('JoinersProject.project_id' => $id));
			$joiner_project = $this->JoinersProject->find('all', $options);
			$this->set('joiner_project', $this->JoinersProject->find('all', $options));
         	$this->set('number', $number);
			$this->set('results', $message);
	       
	   if ($this->request->is('post')) {
                $select = $this->request->select;
        }
      
		$category=array(0 => '補足', 1 =>'日時の変更', 2 =>'中止', 3 =>'その他');
        
		if ($this->request->is('post')) {
			$data = $this->request->data['DirectMessage'];
			$data['category'] = $category[$data['category']];
		
			$data['text'] = nl2br($data['text']);
	
			  $producer=$this->Auth->user();
	          $producer_id=$producer[student_number];
			$data['producer_id'] = $producer_id;
			
			unset($data['student_number']);
			$this->DirectMessage->create();
			$joiner_id =$_POST["select"][0];
			  $JoinerAll =$joiner_id;
		
			  $data['joiner_id'] = $joiner_id;
			    $data['send_mode'] = $id2;
		//	 }
			if ($this->DirectMessage->save($data)) {
		//		 print_r($data);
		     for ($i = 1; $i < count($_POST["select"]); $i++){
    	 
			$this->DirectMessage->create();
			 $joiner_id =$_POST["select"][$i];
			
			 $data['joiner_id'] = $joiner_id;
			 $this->DirectMessage->save($data);
			  $JoinerAll .= ",".$joiner_id;
                }
				  $this->set('JoinerAll', $JoinerAll);
				
			//	echo $JoinerAll;//リダイレクトの前に出力させると真っ白の画面に遷移
				return $this->redirect(array('controller'=>'DirectMessages','action' =>'view',$this->DirectMessage->id,$JoinerAll,$id2,null));
				//echo @$_POST["select"][0]."　";
			} else {
				$this->Session->setFlash(__('メッセージを送信できませんでした。もう一度お試しください。'));
			}
		}
		
	}
	


}
