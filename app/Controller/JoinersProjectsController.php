<?php
App::uses('AppController', 'Controller');
/**
 * JoinersProjects Controller
 *
 * @property JoinersProject $JoinersProject
 * @property PaginatorComponent $Paginator
 */
class JoinersProjectsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('Comment','Joiner','JoinersProject','Producer','ProducersProject','Project','User');
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
	public function add($project_id = null) {
		$this->autoRender = false;
	$this->JoinersProject->recursive = 5;		
		$userSession = $this->Auth->user();
		$producer_project = $this->ProducersProject->find('first',array('conditions'=>array('ProducersProject.project_id'=>$project_id)));
		$joiner_id = $this->Joiner->find('first',array('conditions'=>array('Joiner.user_id'=>$userSession['id'])));
		$producer = $this->Producer->find('first',array('conditions'=>array('Producer.id'=>$producer_project['ProducersProject']['producer_id'])));
		
		$joiners_project = $this->JoinersProject->find('first',array('conditions'=>array('JoinersProject.project_id'=>$project_id,'JoinersProject.joiner_id'=>$joiner_id['Joiner']['id'])));
		
		if(count($joiners_project)  >0){	
			$this->Session->setFlash(__('you had already taken part in this project.'));
			return $this->redirect(array('controller'=>'projects', 'action' => 'view',$project_id));
		}else{
			if(!($producer['Producer']['user_id'] == $userSession['id'])){
				$joiner = $this->Joiner->find('first',array(
				'conditions' => array('Joiner.user_id' => $userSession['id'])));
			
				$this->request->data['JoinersProject']['project_id'] = $project_id;
				if(count($joiner) <= 0){
					$this->Joiner->create();
					$this->request->data['Joiner']['user_id'] = $userSession['id'];
					if($this->Joiner->save($this->request->data)){
						$this->request->data['JoinersProject']['joiner_id'] = $this->Joiner->id;
					}else{
					}
				} else {
					$this->request->data['JoinersProject']['joiner_id'] = $joiner['Joiner']['id'];
				}
				if ($this->JoinersProject->save($this->request->data)) {
				} else {
					$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">参加登録ができませんでした。もう一度お試し下さい。</font></b></div>'));
				}
			}else{
				$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">'.'企画者は参加登録ができません。'.'</font></b></div>'));
			}
			return $this->redirect(array('controller'=>'projects', 'action' => 'view',$project_id));
		}
		
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($project_id = null) {
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$joiner = $this->Joiner->find('first',array('conditions'=>array('Joiner.user_id'=>$userSession['id'])));
		$joiners_project = $this->JoinersProject->find('first',array('conditions'=>array('JoinersProject.joiner_id'=>$joiner['Joiner']['id'],'JoinersProject.project_id'=>$project_id)));
		$this->JoinersProject->id = $joiners_project['JoinersProject']['id'];
		
		if (!$this->JoinersProject->exists()) {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">無効な取り消し操作です。</font></b></div>'));
			return $this->redirect(array('controller'=>'projects','action' => 'view',$project_id));
		}
		if ($this->JoinersProject->delete()) {
		} else {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">取り消し処理ができませんでした。もう一度お試し下さい。</font></b></div>'));
		}
		return $this->redirect(array('controller'=>'projects','action' => 'view',$project_id));
	}}