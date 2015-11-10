<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 * @property Project $Project
 * @property PaginatorComponent $Paginator
 */
class ProjectsController extends AppController {

	var $uses = array('Project','User','Producer','Comment','ProducersProject','JoinersProject','Joiner');
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
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'search', 'tempkey', 'keyword', 'projectlist');
	}
	
	public $paginate = array(
		'Project' => array(
				'limit' => 20,
				'order' => array('Project.modified' => 'desc'),
				'conditions'=>array('Project.delete_flag' => 0)
		)
	);

	public function index() {
		$this->Paginator->settings = array(
			'Project' => array(
					'limit' => 5,
					'order' => array('Project.modified' => 'desc'),
					'conditions'=>array('Project.delete_flag' => 0,
							'Project.active_date NOT BETWEEN ? AND ?' => 
							  array(date('2010-06-25 14:08:00'),date('Y-m-d H:i:s',strtotime("-1 day"))))
			)
		);
		$this->Project->recursive = 1;
		$this->set('projects', $this->Paginator->paginate());
		$top = $this->Project->find('all');
		$this->set('producer',$top);
	}
	
	public function projectlist(){
		$userSession = $this->Auth->user();
		if($userSession['mode'] == 1){
			$this->Paginator->settings = array(
				'Project' => array(
						'limit' => 20,
						'order' => array('Project.id' => 'desc')
				)
			);
			$this->Project->recursive = 1;
			$this->set('projects', $this->Paginator->paginate());
			$top = $this->Project->find('all');
			$this->set('producer',$top);
		}else{
			return $this->redirect(array('controller'=>'projects','action' => 'index'));
		}
	}


	public function search($number = null){
		$this->Project->recursive = 1;
		$userlist = $this->User->find('list', array(
			'fields' => array('User.id'),
			'conditions' => array('(User.student_number  % 10)'=>$number)
			));
		$prolist = $this->Producer->find('list',array(
			'fields' => array('Producer.id'),
			'conditions' => array('Producer.user_id'=>$userlist)
		));
		$proprolist = $this->Project->ProducersProject->find('list',array(
			'fields' => array('ProducersProject.project_id'),
			'conditions' => array('ProducersProject.producer_id'=>$prolist)
		));
		
		$this->set('projects', 
			$this->Paginator->paginate($this->Project,array(
				'Project.id'=>$proprolist,
				'Project.delete_flag'=>0
		)));
	}
	
 	public function keyword($keyword=null){
 		$this->Paginator->settings = $this->paginate;
 		$this->Project->recursive = 1;
 		$projectlist=$this->Project->find('list', array(
 				'fields' => array('Project.id'),
 				'conditions' => array(
 						'OR' => array(
 								array('Project.project_name LIKE' => '%'.$keyword.'%'),
 								array('Project.detail_text LIKE' => '%'.$keyword.'%'),
 								array('Project.active_place LIKE' => '%'.$keyword.'%'),
 						)
 				)));
 		$this->set('projects',
 				$this->Paginator->paginate($this->Project,array(
 						'Project.id'=>$projectlist,
 						'Project.delete_flag'=>0
 				)));
	}
	
	public function tempkey(){
		if($this->request->isPost()){
			return $this->redirect(array('controller'=>'projects','action' => 'keyword',$this->request->data['keyword']['search']));
		}
	}
	
	public function joinlist($id=null){
		$userSession = $this->Auth->user();
		$this->JoinersProject->recursive = 2;
		$producer = $this->Producer->find('first',array('conditions' => array('Producer.user_id' => $userSession['id'])));
		$project = $this->Project->find('first',array('conditions' => array('Project.id' => $id)));
		$this->set('project', $project);
//		print_r($project['JoinersProject']);
		$producerList = $this->ProducersProject->find('all',array('conditions'=>array('ProducersProject.project_id'=>$id,'ProducersProject.producer_id'=>$producer['Producer']['id'])));
		$prouser = $this->Project->find('all');
		
		if(count($producerList)>0){
			$options = array('conditions' => array('JoinersProject.project_id' => $id));
			$joiner_project = $this->JoinersProject->find('all', $options);
			$this->set('joiner_project', $this->JoinersProject->find('all', $options));
		} else if($userSession['mode']==1){
			$options = array('conditions' => array('JoinersProject.project_id' => $id));
			$joiner_project = $this->JoinersProject->find('all', $options);
			$this->set('joiner_project', $this->JoinersProject->find('all', $options));
		} else{
			$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">企画者のみこの企画の参加者を閲覧出来ます。</font></b></div>'));
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
		$this->Project->recursive = 3;
		$userSession = $this->Auth->user();
		
		if (!$this->Project->exists($id)) {
			return $this->redirect(array('controller'=>'projects','action' => 'index'));
		}
		$joinoptions = array('conditions'=>array('JoinersProject.project_id'=>$id));
		$active_date = $this->Project->find('first',array('fields'=>array('Project.active_date'), 'conditions'=>array('id'=>$id), 'recursive' => -1));
		$active_date = $active_date['Project']['active_date'];
		$datetime = new DateTime($active_date);
	 	$weekday = array("日", "月", "火", "水", "木", "金", "土");//漢字による曜日出力のための配列　
		$week = (int)$datetime->format('w');
		$weekjp = $weekday[$week];
		
		$producer_id = $this->Producer->find('first', array('conditions' => array('Producer.user_id' => $userSession['id']), 'recursive' => -1));
		$producer_id = $producer_id['Producer']['id'];
//		print_r($producer_id);
		$count = $this->ProducersProject->find('count', array('conditions' => array('ProducersProject.project_id' => $id, 'ProducersProject.producer_id' => $producer_id, 'ProducersProject.delete_flag' => 0), 'recursice' => -1));
//		print_r($count);
				
		$this->set('count', $count);

		if($userSession['mode']==1){
			$project = $this->Project->find('first', array('conditions'=>array('id'=>$id)));
			$project['Project']['detail_text'] = strip_tags($project['Project']['detail_text']);
//			print_r($project['Project']['detail_text']);
			$this->set('project', $project);
			if($project['Project']['delete_flag'] == 1){
				$this->Session->setFlash(__('<div align="center"><b>この企画はすでに削除されている企画です。</b></div>'));
			}
		}else{
			$project = $this->Project->find('first', array('conditions'=>array('id'=>$id,'Project.delete_flag'=>0)));
//			print_r($project);
			$project['Project']['detail_text'] = strip_tags($project['Project']['detail_text']);
//			print_r($project['Project']['detail_text']);
			if(count($project)>0){
				$this->set('project', $project);
			}else{
				return $this->redirect(array('controller'=>'projects','action' => 'index'));
			}
		}
		$com = $this->Comment->find('all', array('fields'=>array('Comment.id', 'Comment.user_id', 'Comment.comment_text', 'Comment.comment_num', 'Comment.project_id', 'User.id', 'User.nick_name'), 'conditions'=>array('Comment.project_id'=>$id, 'Comment.delete_flag' =>0), 'recursive' => 0));
//		print_r($com);
		$this->set('joinernum',count($this->JoinersProject->find('all', $joinoptions)));
		$this->set('commentnum',count($com));
		$this->set('com', $com);
		$this->set('week',$weekjp);
}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->Project->find('all');
		$userSession = $this->Auth->user();
		$producer = $this->Producer->find('all',array(
				'conditions' => array('Producer.user_id' => $userSession['id'])));
			
		if(count($producer) <= 0){
			$this->Producer->create();
			$this->request->data['Producer']['user_id'] = $userSession['id'];
			if($this->Producer->save($this->request->data)){
				$producer = $this->Producer->find('all',array(
						'conditions' => array('Producer.user_id' => $userSession['id'])));
			} else {
				return $this->redirect(array('controller'=>'projects','action' => 'index'));
			}
		}
		
		$this->set('producerid',$producer[0]['Producer']['id']);
		if ($this->request->is('post')) {
			$tmpName = $this->request->data['Project']['image_file_name']['tmp_name'];//画像
			
			$file1 = $this->request->data['Project']['image_file_name']['tmp_name'];
			$size = $this->request->data['Project']['image_file_name']['size'];
			$ty;
			switch(end(explode('.', $file1))){
				case 'jpg':
					$ty = '.jpg';
					break;
				case 'gif':
					$ty = '.gif';
					break;
				case 'png':
					$ty = '.png';
					break;
			}
			
			$this->request->data['Project']['image_file_name'] = "temp";//画像
			$this->request->data['Project']['detail_text'] = strip_tags($this->request->data['Project']['detail_text']);
			$this->request->data['Project']['detail_text'] = nl2br($this->request->data['Project']['detail_text']);
			$this->Project->create();
			if ($this->Project->save($this->request->data)) {
				$imageName = $this->Project->id.'-'.date('YmdHis').$ty;//画像
				$fileName = APP.'webroot/files/'.$imageName;//画像
				move_uploaded_file($tmpName,$fileName);//画像
				if($size <= 0) $imageName = 'noimage1.png';
				$this->request->data['Project']['image_file_name'] = $imageName;//画像
				if($this->Project->save($this->data)){
					$producer = $this->Producer->find('first',array(
							'conditions' => array('Producer.user_id' => $userSession['id'])));
					$this->request->data['ProducersProject']['project_id'] = $this->Project->id;
					$this->request->data['ProducersProject']['producer_id'] = $producer['Producer']['id'];
					if($this->ProducersProject->save($this->data)){
						return $this->redirect(array('controller'=>'projects','action' => 'view',$this->Project->id));
					}
				}
				
			} else {
				$this->Session->setFlash('<div align="center"><b><font size="3" color="#ff0000">保存に失敗しました。もう一度お試し下さい。</font></b></div>');
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
		$this->Project->recursive = 5;
		$userSession = $this->Auth->user();
		$producerid = $this->Producer->find('first',array(
			'conditions' => array('Producer.user_id' => $userSession['id'])));
		$projectid = $this->Project->find('first',array('conditions'=>array('Project.id'=>$id)));
		$producers_project=$this->ProducersProject->find('first',array('conditions'=>array('ProducersProject.project_id'=>$projectid['Project']['id'])));
		$image_temp_name;
		
		if(($producerid['Producer']['id'] == $producers_project['ProducersProject']['producer_id']) || ($userSession['mode']==1)){
			if (!$this->Project->exists($id)) {
				$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">その企画は存在しません。</font></b></div>'));
				return $this->redirect(array('action' =>'index'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				$image_temp_name = $this->request->data['Project']['image_file_name'];
				$tmpName = $this->request->data['Project']['image_file_name']['tmp_name'];//画像
					
				$file1 = $this->request->data['Project']['image_file_name']['tmp_name'];
				$ty;
				switch(end(explode('.', $file1))){
					case 'jpg':
						$ty = '.jpg';
						break;
					case 'gif':
						$ty = '.gif';
						break;
					case 'png':
						$ty = '.png';
						break;
				}
				
				$check = -1;
				if(!empty($this->request->data['Project']['image_file_name']['tmp_name'])){
					$check = 1;
				}else{
					$check = 0;
				}
				$this->request->data['Project']['image_file_name'] = "temp";//画像
				$this->Project->id = $id;
				$detail = strip_tags($this->request->data['Project']['detail_text']);
//				$this->request->data['Project']['detail_text'] = htmlspecialchars($this->request->data['Project']['detail_text']);
				$this->request->data['Project']['detail_text'] = nl2br($detail);
				if ($this->Project->save($this->request->data)) {
					$imageName = $this->Project->id.'-'.date('YmdHis').$ty;//画像
					if($check == 1){
						$fileName = APP.'webroot/files/'.$imageName;//画像
						move_uploaded_file($tmpName,$fileName);//画像
					}else{
						$imageName = $this->request->data['Project']['image_temp_name'];
					}
					$this->request->data['Project']['image_file_name'] = $imageName;//画像
					$this->Project->save($this->data);//最後に再度保存
					$this->Session->setFlash(__(''));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">企画の保存に失敗しました。もう一度お試し下さい。</font></b></div>'));
				}
			} else {
				$options = array('conditions' => array('Project.' . $this->Project->primaryKey => $id));
				$this->request->data = $this->Project->find('first', $options);
				$this->request->data['Project']['detail_text'] = strip_tags($this->request->data['Project']['detail_text']);
				$this->set('image_temp_name',$this->Project->find('first', $options));
			}
		}else{
			$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">企画者のみ企画の変更を行えます。</font></b></div>'));
			return $this->redirect(array('action' =>'view',$id));
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
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$producer = $this->Producer->find('first',array('conditions'=>array('Producer.user_id'=>$userSession['id'])));
		$producer_project = $this->ProducersProject->find('first',array('conditions'=>array('ProducersProject.project_id'=>$id)));
		if($producer['Producer']['id'] == $producer_project['ProducersProject']['producer_id']){
			$this->Project->id = $id;
			if (!$this->Project->exists()) {
				$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">この企画は存在しません。</font></b></div>'));
			}
			$this->request->data['Project']['delete_flag'] = 1;
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">企画を削除しました。</font></b></div>'));
			} else {
				$this->Session->setFlash(__('<div align="center"><b><font size="3" color="#ff0000">企画の削除ができませんでした。もう一度お試し下さい。</font></b></div>'));
			}
			return $this->redirect(array('controller'=>'users','action' => 'view',$userSession['id']));
		}else{
			$this->redirect(array('controller'=>'users','action' => 'view',$userSession['id']));
		}
	}
}
