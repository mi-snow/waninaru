<?php
App::uses('AppController', 'Controller');
/**
 * ProducersProjects Controller
 *
 * @property ProducersProject $ProducersProject
 * @property PaginatorComponent $Paginator
 */
class ProducersProjectsController extends AppController {
	var $uses= array('ProducersProject','Producer');

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
		$this->autoRender = false;
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
	}

/**
 * add method
 *
 * @return void
 */
	public function add($project_id = null) {
		$this->autoRender = false;
		$userSession = $this->Auth->user();
		$producer = $this->Producer->find('first',array('conditions'=>array('Producer.user_id'=>$userSession['id'])));
		$this->request->data['ProducersProject']['project_id'] = $project_id;
		$this->request->data['ProducersProject']['producer_id'] = $producer['Producer']['id'];
		$this->ProducersProject->create();
		if ($this->ProducersProject->save($this->request->data)) {
			return $this->redirect(array('controller'=>'projects','action' => 'view',$project_id));
		} else {
			$this->Session->setFlash(__('企画者を保存出来ませんでした。お手数ですがもう一度お試し下さい。'));
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
		$this->ProducersProject->id = $id;
		if (!$this->ProducersProject->exists()) {
			throw new NotFoundException(__('Invalid producers project'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProducersProject->delete()) {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">企画者を保存出来ませんでした。お手数ですがもう一度お試し下さい。</font></b></div>'));
		} else {
			$this->Session->setFlash(('<div align="center"><b><font size="3" color="#ff0000">企画者の作成した企画が削除できませんでした。もう一度お試し下さい。</font></b></div>'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
